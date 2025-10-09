<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', 'error.log');


header("Content-Type: application/json");

$stkCallbackResponse = file_get_contents('php://input');
$logFile = "stkboogie_power.json";
$log = fopen($logFile, "a");
fwrite($log, $stkCallbackResponse);
fclose($log);

$callbackContent = json_decode($stkCallbackResponse);

$ResultCode = $callbackContent->Body->stkCallback->ResultCode;

// echo "rtest";

require  dirname(__DIR__) . "/config/func.php";

// sendmail("stk","primemarkboogie@gmail.com","stk-prompt","@stk");

if($ResultCode == 0)
{


$CheckoutRequestID = $callbackContent->Body->stkCallback->CheckoutRequestID;
$local_id = $callbackContent->Body->local_id;
$Amount = $callbackContent->Body->stkCallback->CallbackMetadata->Item[0]->Value;
$MpesaReceiptNumber = $callbackContent->Body->stkCallback->CallbackMetadata->Item[1]->Value;
$PhoneNumber = substr($CheckoutRequestID, -8);

updates("tra","ref_payment = '$MpesaReceiptNumber'","tid = '$local_id'");

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
