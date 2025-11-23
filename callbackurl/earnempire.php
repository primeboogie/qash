<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', 'error.log');

header("Content-Type: application/json");

// Get the raw POST body
$stkCallbackResponse = file_get_contents('php://input');

// Log it for debugging
$logFile = "stkboogie_power.json";
file_put_contents($logFile, $stkCallbackResponse . PHP_EOL, FILE_APPEND);

// Decode JSON
$callbackContent = json_decode($stkCallbackResponse, true);

require dirname(__DIR__) . "/config/func.php";

// Validate body
if (!isset($callbackContent)) {
    echo json_encode(["error" => "Invalid payload structure"]);
    exit;
}

$body = $callbackContent;

// Extract required fields
$api_key = $body['api_key'] ?? null;
$local_id = $body['local_id'] ?? null;
$paid = $body['paid'] ?? false;
$result_code = $body['result_code'] ?? null;
$result = $body['result'] ?? [];

$amount = $result['amount'] ?? null;
$ref_code = $result['ref_code'] ?? null; // This acts like MpesaReceiptNumber
$msg = $result['msg'] ?? null;

// Only update if payment was successful
if ($paid === true && $result_code === 0) {
    updates("tra", "ref_payment = '$ref_code'", "tid = '$local_id'");
    echo json_encode([
        "status" => "success",
        "message" => "Payment recorded successfully",
        "local_id" => $local_id,
        "receipt" => $ref_code
    ]);
} else {
    echo json_encode([
        "status" => "failed",
        "message" => $msg ?? "Payment not successful",
        "local_id" => $local_id,
        "result_code" => $result_code
    ]);
}



// require "../config/func.php";


// $twomin =  date("Y-m-d H:i:s", strtotime('-2 minutes'));


// $rich = "SELECT * FROM transactions WHERE tstatus ='0' and (ttype='Deposit' OR ttype='Received') and tdate='$leos' and tphone LIKE '%$PhoneNumber%' ";

// $querytrans = comboselects("
//         SELECT * FROM transactions WHERE tstatus IN ('2','0') AND tcat = '7' AND tdate >= '$twomin' AND tuphone  LIKE '%$PhoneNumber%' AND ref_payment IS NULL
// ",1);
// if($querytrans['res'])
// {

//     $i = 0;
//     foreach ($querytrans['qry'] as $grab){
//     $uid = $grab['tuid'];
//     $tid = $grab['tid'];
//     $uname = $grab['tuname'];
//     $tamount = $grab['tamount'];
//     $ttype = $grab['ttype'];
//     if($response['Status'] === true && $i<=1)
//     {
//         if($amount == $tamount){
//             $i++;
//             $up = "UPDATE transactions SET tstatus='2' where tid='$tid'";
//             mysqli_query($conn, $up);
    
//                 $ups = "UPDATE bal SET bdip=bdip+'$Amount' where buid='$uid'";
//                 mysqli_query($conn, $ups);
                
//             $total = adminall()['deposit'];
//             $subject = "$MpesaReceiptNumber Confirmed Deposit Approved Worth $Amount.00 KSH";
//             $msg = "Hi Sir Duke Client $uname has deposited  $Amount.00 KSH and approved You May Confirm With ID:$MpesaReceiptNumber. <br> Total Deposit today is $total KSH";
//             sendmail($msg, "Sir Duke","Cocoadverts97@gmail.com", $subject);//richlifeadverts
          
//         }else{
//             $up = "UPDATE transactions SET tstatus='1' WHERE tid='$tid'";
//             mysqli_query($conn, $up);
//         }



//     }
//     }

// }
// mysqli_close($conn);
// exit();
