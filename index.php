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


// _print_r($_GET);


//-------------------------------------
// get the current prices of the selected symbol

	//here ,$symbol will be the currency identifier, eg, eurusd
	$symbol = $_GET['symbol'];

	// current minute data
	$last_minute = $db->get($config['db']['minute_table'],'latest_minute',$symbol);
	echo 'Current minute data';
	_print_r($last_minute,false);


	// last hour data
	$last_hour = $db->get($config['db']['hour_table'],'latest_hour',$symbol);
	echo 'Last hour data';
	_print_r($last_hour,false);


	// last day's prices
	$last_day = $db->get($config['db']['day_table'],'latest_day',$symbol);
	echo 'Last day data';
	_print_r($last_day,false);

//-------------------------------------
