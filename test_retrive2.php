<?php

$url = 'http://sms2.cdyne.com/sms.svc/SimpleSMSsendWithPostback?PhoneNumber=18887477474&Message=test&LicenseKey=619c1c9d-9ed4-43f1-9110-484e0c1dcf47';

$yql = urlencode('select * from yahoo.finance.xchange where pair in ("GBPUSD", "USDCHF", "EURUSD", "GBPJPY", "EURJPY", "GBPEUR", "USDCAD", "USDJPY", "AUDUSD", "NZDUSD", "EURAUD", "EURCHF", "GBPCHF", "CADJPY", "AUDNZD", "GBPCAD", "EURNZD", "EURCAD", "CHFJPY", "AUDJPY")');

$url = 'http://query.yahooapis.com/v1/public/yql?q='.$yql.'&env=store://datatables.org/alltableswithkeys&format=json';
// $url = 'http://yahoo.com';


// $cURL = curl_init();

// curl_setopt($cURL, CURLOPT_URL, $url);
// curl_setopt($cURL, CURLOPT_HTTPGET, true);

// curl_setopt($cURL, CURLOPT_HTTPHEADER, array(
//     'Content-Type: application/json',
//     'Accept: application/json'
// ));

// $result = curl_exec($cURL);

// curl_close($cURL);



// // http://stackoverflow.com/questions/15617512/get-json-object-from-url
// $result = json_decode( file_get_contents($url) );






$context = stream_context_create(array('http'=>array('protocol_version'=>'1.1')));
$result = file_get_contents($url, false, $context);

print_r($result);
var_dump($result);
echo $result;
die;