<?php

// $query = 'select * from flickr.photos.interestingness(20)';
$yql = 'select * from yahoo.finance.xchange where pair in ("GBPUSD", "USDCHF", "EURUSD", "GBPJPY", "EURJPY", "GBPEUR", "USDCAD", "USDJPY", "AUDUSD", "NZDUSD", "EURAUD", "EURCHF", "GBPCHF", "CADJPY", "AUDNZD", "GBPCAD", "EURNZD", "EURCAD", "CHFJPY", "AUDJPY")';
$env = 'store://datatables.org/alltableswithkeys';


// insert the query into the full URL

$url = 'http://query.yahooapis.com/v1/public/yql?format=json'.
												'&q='.urlencode($yql).
												'&env='.urlencode($env);


// $url = 'http://query.yahooapis.com/v1/public/yql?q='.$yql.'&env=store://datatables.org/alltableswithkeys&format=json';


   
// set up the cURL
$c = curl_init();
curl_setopt($c, CURLOPT_URL, $url);
curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($c, CURLOPT_SSL_VERIFYHOST, false);
   
// execute the cURL
$rawdata = curl_exec($c);
curl_close($c);
   
// Convert the returned JSON to a PHP object
$data = json_decode($rawdata);
   
// Show us the data
echo '<pre>';
print_r($data);
echo '</pre>';