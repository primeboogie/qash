<?php

$tariff = [
    [
        "wid" => "80B9976375949A0D",
        "wcid" => "KEST",
        "min_brackets" => "500.00",
        "max_brackets" => "1999.00",
        "tariff" => "40.00"
    ],
    [
        "wid" => "E6160CA630622E55",
        "wcid" => "KEST",
        "min_brackets" => "2000.00",
        "max_brackets" => "4999.00",
        "tariff" => "50.00"
    ],
    [
        "wid" => "ED3A85E47355029D",
        "wcid" => "KEST",
        "min_brackets" => "5000.00",
        "max_brackets" => "9999.00",
        "tariff" => "70.00"
    ],
    [
        "wid" => "CD6B17AE5BF2D883",
        "wcid" => "KEST",
        "min_brackets" => "10000.00",
        "max_brackets" => "14999.00",
        "tariff" => "130.00"
    ],
    [
        "wid" => "0C6ECE72C7C264A5",
        "wcid" => "KEST",
        "min_brackets" => "15000.00",
        "max_brackets" => "15000.00",
        "tariff" => "150.00"
    ]
];

// function getWithdrawalTariff($amount, $tariffList) {
//     // Check if amount is below the first bracket
//     $firstMin = floatval($tariffList[0]['min_brackets']);
//     if ($amount < $firstMin) {
//         return 0; // or return "Amount too low";
//     }

//     foreach ($tariffList as $tariff) {
//         $min = floatval($tariff['min_brackets']);
//         $max = floatval($tariff['max_brackets']);
//         if ($amount >= $min && $amount <= $max) {
//             return floatval($tariff['tariff']);
//         }
//     }

//     // If amount exceeds all brackets, return the maximum tariff
//     $lastTariff = end($tariffList);
//     return floatval($lastTariff['tariff']);
// }

// // Example usage:
// $amount = 20000;
// $charge = getWithdrawalTariff($amount, $tariff);
// echo "Withdrawal charge for $amount is: $charge";

// ?>
