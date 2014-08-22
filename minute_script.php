<?php

/*
- grab data from yahoo currency api for list of symbols (?) every minute

  http://query.yahooapis.com/v1/public/yql?q=select * from yahoo.finance.xchange where pair in ("GBPUSD", "USDCHF", "EURUSD", "GBPJPY", "EURJPY", "GBPEUR", "USDCAD", "USDJPY", "AUDUSD", "NZDUSD", "EURAUD", "EURCHF", "GBPCHF", "CADJPY", "AUDNZD", "GBPCAD", "EURNZD", "EURCAD", "CHFJPY", "AUDJPY")&env=store://datatables.org/alltableswithkeys

- insert collected data into db table
- table name (minute_data ?)

- columns 
  - symbol          (rate id)
  - price           (rate)
  - time            (date)  
  - date            (time)
  - ask             (ask ?)
  - bid             (bid ?)
*/

require_once('include/config.php');
require_once('include/simple_html_dom.php');
// =====================================
// http://codular.com/curl-with-php
// =====================================
// // Get cURL resource
// $curl = curl_init();

// // Set some options - we are passing in a useragent too here
// curl_setopt_array($curl, array(
//     CURLOPT_RETURNTRANSFER => 1,
//     CURLOPT_URL => $config['yql_url'],
//     CURLOPT_USERAGENT => 'Codular Sample cURL Request'
// ));

// // Send the request & save response to $resp
// $resp = curl_exec($curl);


// // Close request to clear up some resources
// curl_close($curl);

//---------------------------------------
// for using stored data
	$myfile = fopen('include/current_data_json', "r") or die("Unable to open file!");
	$resp= fread($myfile,filesize('include/current_data_json'));
	fclose($myfile);
//---------------------------------------

//current data in array
$data = json_decode($resp,true);



$created = $data['query']['created'];
$data = $data['query']['results']['rate'];

_print_r($data);


$db->insert($config['db']['minute_table'],$data);