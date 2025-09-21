<?php
header("Content-Type: application/json");

$stkCallbackResponse = file_get_contents('php://input');
$logFile = "flutter.json";
$log = fopen($logFile, "a");
fwrite($log, $stkCallbackResponse);
fclose($log);

$response = json_decode($stkCallbackResponse, true);

// require_once '/home/seosblog/earnempire.seosblog.com/config/func.php';
require "../config/func.php";


if(isset($response['data'])){
    $ref_id = $response['data']['tx_ref'] ?? null;

        if($ref_id){
            updates("tra", "tstatus = '1'","tid = '$ref_id'");
        }
    
}



