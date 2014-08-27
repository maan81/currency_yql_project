<?php
/*
   - query "minute_data" end of every hour (ie, 10:59), monday to friday

   - for every symbol (the listed 20 symbols ?) get :
     - open price of the hour (ie. price at the start of the hr)
     - heighest price of the hour
     - lowest price of the hour
     - closing price of the hour (ie, price at the end of the hr)
     - time of the hour (ie, if 9:00-9:59, then 9:00am)

   - store on "hour_data" table of db
   - delete data from "minute_data" having the time 2 hours before current time

*/


require_once('include/config.php');
require_once('include/db.php');
// require_once('include/sort_fn.php');

$db = new Database($config);



//-------------------------------------
// get all the minute data

	$data = $db->get($config['db']['minute_table'],'1_hour_earlier');
	// _print_r($data);
//-------------------------------------



//-------------------------------------
// rearrange the data according to symbols

	$symbols_array = array();

	foreach($data as $key=>$val){

		$cur_symbol = $val['Symbol'];

		$symbols_array[$cur_symbol] = array();

	}


	foreach($data as $key=>$val){
	
		$cur_symbol = $val['Symbol'];

		array_push($symbols_array[$cur_symbol], $val);
	}
	//_print_r($symbols_array,false);

//-------------------------------------


//-------------------------------------
// find the open, heigh, low, & closing of the hour

	$data_hourly = array();
	foreach ($symbols_array as $key => $val) {
		$rates_array	 = array();
		$starting_array	 = array();

		foreach($val as $kk=>$vv){

			$rates_array[]	 = $vv['Rate'];
			$starting_array[]= $vv['Datetime'];
		}
		// _print_r($rates_array,false);
		// _print_r($starting_array,false);

		$data_hourly[] = array('Symbol'	  => $val[0]['Symbol'],
								'Open' 	  => $rates_array[0],
								'Heigh'	  => max($rates_array),
								'Low'	  => min($rates_array),
								'Closing' => $rates_array[count($rates_array)-1],
								'Datetime'=> $starting_array[0]
							);
	}
	_print_r($data_hourly,false);
//----------------------------------



//---------------------------------------------------    
// insert into hour table

    $db->insert_hour($config['db']['hour_table'],$data_hourly);

//---------------------------------------------------    


//---------------------------------------------------    
// delete data from the hour table according to the settings

	$db->del($config['db']['hour_table'],$config['hour_table_range']);

//---------------------------------------------------    
