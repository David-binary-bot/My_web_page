<?php
// M-Pesa API credentials
$mpesa_key = '3dEyFZGc3cQGhyXapIDpiMeYEDGAg6DvPEei9wCikKef1x2t';
$mpesa_secret = 'OV84ht8WL0jTPwcH5mcdYDyV7EEGx0PIAHdTNz9yndcie4eWUEqVjSYdnFDxSfwR';

// Get phone number and amount from POST request
$phone = $_POST['phone'];
$amount = $_POST['amount'];

// M-Pesa API URL
$api_url = "https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials";

// Generate access token
$credentials = base64_encode($mpesa_key . ':' . $mpesa_secret);
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $api_url);
curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Basic ' . $credentials));
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
$response = curl_exec($curl);
$access_token = json_decode($response)->access_token;
curl_close($curl);

// Perform M-Pesa transaction
$transaction_url = "https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest";
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $transaction_url);
curl_setopt($curl, CURLOPT_HTTPHEADER, array("Authorization: Bearer $access_token"));
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POST, true);

$payload = json_encode(array(
    'BusinessShortCode' => '174379',  // Replace with your Business ShortCode
    'Password' => base64_encode('174379' . 'bfb279f9aa9bdbcf158e97b1ad6c60fc02e52e5da5b06180b1e9d9a6fe72ee89' . time()), // Use your own passkey and timestamp
    'Timestamp' => date('YmdHis'),
    'TransactionType' => 'CustomerPayBillOnline',
    'Amount' => $amount,
    'PartyA' => $phone,
    'PartyB' => '174379',  // Your Business ShortCode again
    'PhoneNumber' => $phone,
    'CallBackURL' => 'https://yourdomain.com/transactions.php',
    'AccountReference' => 'Ref001',
    'TransactionDesc' => 'Payment for Order'
));

curl_setopt($curl, CURLOPT_POSTFIELDS, $payload);
$response = curl_exec($curl);
curl_close($curl);

// Handle the response and save transaction to database (MySQL)

echo $response; // Send the response back to frontend for real-time updates
?>