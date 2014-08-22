<?php

// require_once('include/config.php');

// $curl = curl_init();

// // Set some options - we are passing in a useragent too here
// curl_setopt_array($curl, array(
//     CURLOPT_RETURNTRANSFER => 1,
//     CURLOPT_URL => $config['yql_url'],
//     CURLOPT_USERAGENT => 'Codular Sample cURL Request'
// ));

// // Send the request & save response to $resp
// $resp = curl_exec($curl);
// var_dump($resp);

// // Close request to clear up some resources
// curl_close($curl);



// echo $resp;







// require_once('include/simple_html_dom.php');

// $html = file_get_html('http://query.yahooapis.com/v1/public/yql?q=select * from yahoo.finance.xchange where pair in ("GBPUSD", "USDCHF", "EURUSD", "GBPJPY", "EURJPY", "GBPEUR", "USDCAD", "USDJPY", "AUDUSD", "NZDUSD", "EURAUD", "EURCHF", "GBPCHF", "CADJPY", "AUDNZD", "GBPCAD", "EURNZD", "EURCAD", "CHFJPY", "AUDJPY")&env=store://datatables.org/alltableswithkeys');

// echo $html;





// // Get cURL resource
// $curl = curl_init();
// // Set some options - we are passing in a useragent too here
// curl_setopt_array($curl, array(
//     CURLOPT_RETURNTRANSFER => 1,
//     CURLOPT_URL => 'http://query.yahooapis.com/v1/public/yql?q=select * from yahoo.finance.xchange where pair in ("GBPUSD", "USDCHF", "EURUSD", "GBPJPY", "EURJPY", "GBPEUR", "USDCAD", "USDJPY", "AUDUSD", "NZDUSD", "EURAUD", "EURCHF", "GBPCHF", "CADJPY", "AUDNZD", "GBPCAD", "EURNZD", "EURCAD", "CHFJPY", "AUDJPY")&env=store://datatables.org/alltableswithkeys',
//     CURLOPT_USERAGENT => 'Codular Sample cURL Request'
// ));
// // Send the request & save response to $resp
// $resp = curl_exec($curl);
// // Close request to clear up some resources
// curl_close($curl);

// print_r($resp);









$curl = curl_init();
$url = 'http://query.yahooapis.com/v1/public/yql?q=select * from yahoo.finance.xchange where pair in ("GBPUSD", "USDCHF", "EURUSD", "GBPJPY", "EURJPY", "GBPEUR", "USDCAD", "USDJPY", "AUDUSD", "NZDUSD", "EURAUD", "EURCHF", "GBPCHF", "CADJPY", "AUDNZD", "GBPCAD", "EURNZD", "EURCAD", "CHFJPY", "AUDJPY")&env=store://datatables.org/alltableswithkeys';

curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; rv:1.7.3) Gecko/20041001 Firefox/0.10.1" );   
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 0);

$resp = curl_exec($curl);

curl_close($curl);