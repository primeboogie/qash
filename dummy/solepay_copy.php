<?php
/**
 * SoPay API Wrapper
 * ------------------
 * This class helps to interact with the SoleasPay (SoPay) API.
 * It supports:
 *   - Init new wallet
 *   - Init new transaction
 *   - Fiat payment distribution
 *
 * Requirements:
 *   - Your SoPay API key from the SoleasPay dashboard
 *   - cURL enabled in PHP
 *
 * Author: Boogie 😉
 */

// ---------- Helper Function for GET ----------

require "../config/func.php";


function send_get_request($url, $extraHeaders = [])
{
    $ch = curl_init($url);

    $headers = ['Content-Type: application/json'];
    foreach ($extraHeaders as $key => $value) {
        if (is_string($key)) {
            $headers[] = "$key: $value";
        } else {
            $headers[] = $value;
        }
    }

    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER     => $headers,
        CURLOPT_CONNECTTIMEOUT => 10,
        CURLOPT_TIMEOUT        => 30,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_SSL_VERIFYHOST => false
    ]);

    $response = curl_exec($ch);

    if ($response === false) {
        $error_message = 'cURL Error: ' . curl_error($ch);
        curl_close($ch);
        return ["success" => false, "message" => $error_message];
    }

    curl_close($ch);

    $result = json_decode($response, true);
    return $result ?: $response;
}

// ---------- SoPay API Wrapper ----------
class SoPayAPI
{
    private $baseUrl = "https://soleaspay.com";
    private $apiKey;

    public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
    }

    /**
     * Init a new wallet for a user.
     * @param string $email User email
     * @param string $phone User phone number
     * @param string $phoneCountry Phone country code (e.g. +237)
     */
    public function initWallet($email, $phone, $phoneCountry)
    {
        $url = $this->baseUrl . "/api/agent/link/new?email=" . urlencode($email)
             . "&phone=" . urlencode($phone)
             . "&phoneCountry=" . urlencode($phoneCountry);

        $headers = ["x-api-key" => $this->apiKey];
        return send_get_request($url, $headers);
    }

    /**
     * Init a new transaction.
     * @param string $paymentReceiver SoPay ID of the receiver
     * @param string $paymentId Your order/payment ID
     * @param float $amount Payment amount
     * @param array $distribution Distribution of payment
     */
    public function initTransaction($paymentReceiver, $paymentId, $amount, $distribution)
    {
        $url = $this->baseUrl . "/api/agent/link/init";

        $headers = ["x-api-key" => $this->apiKey];
        $data = [
            "payment_receiver" => $paymentReceiver,
            "payment_id"       => $paymentId,
            "amount"           => $amount,
            "distribution"     => $distribution
        ];

        return send_post_request($url, $data, null, $headers, true);
    }

    /**
     * Fiat payment distribution.
     * @param string $payer SoPay ID of the payer
     * @param float $amount Amount paid
     * @param string $currency Currency (e.g. XAF, USD)
     * @param array $distribution Distribution of payment
     */
    public function fiatDistribution($payer, $amount, $currency, $distribution)
    {
        $url = $this->baseUrl . "/api/agent/link/fiat-distribution";

        $headers = ["x-api-key" => $this->apiKey];
        $data = [
            "data" => [
                "payer"       => $payer,
                "amount"      => $amount,
                "currency"    => $currency,
                "distribution"=> $distribution
            ]
        ];

        return send_post_request($url, $data, null, $headers, true);
    }
}

// ---------- Example Usage ----------
$apiKey = "YOUR_API_KEY_HERE"; // Replace with your real API key
$sopay = new SoPayAPI($apiKey);

// 1. Create Wallet
$responseWallet = $sopay->initWallet("contact@mysoleas.com", "699999999", "+237");
print_r($responseWallet);

// 2. Init Transaction
$distribution = [
    ["matricule" => "SP20231M", "rate" => 15],
    ["matricule" => "SP202116A", "rate" => 10]
];
$responseTransaction = $sopay->initTransaction("SP20208U", "20000553G", 10000, $distribution);
print_r($responseTransaction);

// 3. Fiat Distribution
$responseFiat = $sopay->fiatDistribution("SP202116A", 10000, "XAF", [
    ["matricule" => "SP20231M", "rate" => 15]
]);
print_r($responseFiat);
