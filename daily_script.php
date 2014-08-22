<?php

/*
   - run daily at 00:00GMT, by cron
   - query "hour_data" table & store the following :
     - open price of the day,      (opening price at 24 hrs before)
     - heighest price of the day,  (heighest price within the last 24 hrs)
     - lowest price of the day,    (lowest price within the last 24 hrs)
     - closing price of the day    (closing price )

   - store the data into "daily_data" table of db
*/

require_once('include/config.php');
require_once('include/db.php');
// require_once('include/sort_fn.php');

$db = new Database($config);


//-------------------------------------
// get all the hourly data

	$data = $db->get($config['db']['hour_table'],'1_day_earlier');
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
	_print_r($symbols_array,false);

//-------------------------------------


//-------------------------------------
// find the open, heigh, low, & closing of the day

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
// insert into day table

    $db->insert_day($config['db']['day_table'],$data_hourly);

//---------------------------------------------------    


//---------------------------------------------------    
// deletes 2 days before data from hour table

	$db->del_hour($config['db']['hour_table'],'2_day_earlier');

//---------------------------------------------------    
