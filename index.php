<?php
/*
  - create "connect.php" as include to connect to db
  - create "index.php" script (?)
  - from url "domainname.com/symbol/" (ie, http://example.com/EURUSD  ?), get :
    - currency price (1 minute ago)
    - last hour OHLC prices  	
    - last day's OHLC prices
    - yesterday’s range (?) OHLC prices
  
  - display on provided template the data obtained 
*/

require_once('include/config.php');
require_once('include/db.php');

//==============================
	// echo 'asdfasdf';

	// echo '<br/>';

	// print_r($_REQUEST);

	// echo '<br/>';

	// print_r($_POST);

	// echo '<br/>';

	// print_r($_GET);



$db = new Database($config);


//-------------------------------------
// test the symbol called

	// _print_r($_GET);

//-------------------------------------



//-------------------------------------
// execute the range script

	include('range_script.php');

//-------------------------------------



//-------------------------------------
// get the current prices of the selected symbol

	//here ,$symbol will be the currency identifier, eg, eurusd
	$symbol = $_GET['symbol'];

// _print_r(strtoupper($symbol),false);
// _print_r($config['symbols']);


	//using symbols limited to the 20 specified symbols
	if(!in_array(strtoupper($symbol), $config['symbols'])){
	  echo 'Invalid symbol';
	  die;
	}

	//uppercase coz. it is used a lot.
	$symbol_upper = strtoupper($symbol);

	// current minute data
	$last_minute = $db->get($config['db']['minute_table'],'latest_minute',$symbol);
	// echo 'Current minute data';
	// _print_r($last_minute,false);


	// current hour detail data
	$current_hour_detail = $db->get($config['db']['minute_table'],'1_hour_earlier',$symbol);
	// echo 'Current hour data';
	// _print_r($current_hour_detail,false);


	// last hour data
	$last_hour = $db->get($config['db']['hour_table'],'latest_hour',$symbol);
	// echo 'Last hour data';
	// _print_r($last_hour,false);


	// last day's prices
	$last_day = $db->get($config['db']['day_table'],'latest_day',$symbol);
	// echo 'Last day data';
	// _print_r($last_day,false);


	// last days' ohlc prices
	$last_day_ohlc = $db->get($config['db']['range_table'],'range_data',$symbol,$config['range_start'],$config['range_end']);
	// _print_r($last_day_ohlc,false);
//-------------------------------------

//-------------------------------------
// find the open, heigh, low, & closing of the day

	$data_range = array();

	$heigh_array = array();
	$low_array	 = array();

	foreach($last_day_ohlc as $kk=>$vv){

		$heigh_array[]	 = $vv['Heigh'];
		$low_array[]	 = $vv['Low'];

	}
	// _print_r($heigh_array,false);
	// _print_r($low_array,false);

	$date = explode(' ',$last_day_ohlc[0]['Datetime']);

	$data_range[] = array(	'Symbol'	  => $last_day_ohlc[0]['Symbol'],
							'Open' 	 	  => $last_day_ohlc[0]['Open'],
							'Heigh'	 	  => max($heigh_array),
							'Low'		  => min($low_array),
							'Closing'	  => $last_day_ohlc[count($val)-1]['Closing'],
							'Datetime'	  => $last_day_ohlc[0]['Datetime'],
							'Range_start' => $date[0].' '.$config['range_start'],
							'Range_end'	  => $date[0].' '.$config['range_end'],
						);
	// _print_r($data_range,false);
//----------------------------------





// Include the template for display 
include($config['template']['path'].'rates.tpl.php');