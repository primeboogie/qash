<?php
/**
 * SoPay API (Functional Style)
 * ----------------------------
 * Plain functions you can call directly.
 * Works with your existing send_post_request().
 */

// ---- Helper GET function ----

include dirname(__DIR__) . '/config/func.php';



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

// ---- API Functions ----

/**
 * Init new wallet
 */
function init_wallet($apiKey, $email, $phone, $phoneCountry)
{
    $url = "https://soleaspay.com/api/agent/link/new?email=" . urlencode($email)
         . "&phone=" . urlencode($phone)
         . "&phoneCountry=" . urlencode($phoneCountry);

    $headers = ["x-api-key" => $apiKey];
    return send_get_request($url, $headers);
}

/**
 * Init new transaction
 */
function init_transaction($apiKey, $paymentReceiver, $paymentId, $amount, $distribution)
{
    $url = "https://soleaspay.com/api/agent/link/init";

    $headers = ["x-api-key" => $apiKey];
    $data = [
        "payment_receiver" => $paymentReceiver,
        "payment_id"       => $paymentId,
        "amount"           => $amount,
        "distribution"     => $distribution
    ];

    return send_post_request($url, $data, null, $headers, true);
}

/**
 * Fiat Payment Distribution
 */
function fiat_distribution($apiKey, $payer, $amount, $currency, $distribution)
{
    $url = "https://soleaspay.com/api/agent/link/fiat-distribution";

    $headers = ["x-api-key" => $apiKey];
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

// ---- Example Usage ----
$apiKey = "Ip5a8thsvmQZ7yCLoLpKZrYAxwwNnJm35oE3h7NQDes"; // Replace with your real API key

// 1. Create Wallet
$responseWallet = init_wallet($apiKey, "contact@mysoleas.com", "699999999", "+237");
print_r($responseWallet);

// 2. Init Transaction
$distribution = [
    ["matricule" => "SP20231M", "rate" => 15],
    ["matricule" => "SP202116A", "rate" => 10]
];
$responseTransaction = init_transaction($apiKey, "SP20208U", "20000553G", 10000, $distribution);
print_r($responseTransaction);

// 3. Fiat Distribution
$responseFiat = fiat_distribution($apiKey, "SP202116A", 10000, "XAF", [
    ["matricule" => "SP20231M", "rate" => 15]
]);
print_r($responseFiat);
