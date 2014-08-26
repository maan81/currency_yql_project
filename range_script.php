<?php

/*
   - query "hour_data" table & store the following :
     - open price of the day,      (opening price at 24 hrs before)
     - heighest price of the day,  (heighest price within the last 24 hrs)
     - lowest price of the day,    (lowest price within the last 24 hrs)
     - closing price of the day    (closing price )

   - store the data into "range_data" table of db
*/

require_once('include/config.php');
require_once('include/db.php');
// require_once('include/sort_fn.php');

$db = new Database($config);


//-------------------------------------
// get all the hourly data between the ranges

	$data = $db->get($config['db']['hour_table'],'range_data',false,$config['range_start'],$config['range_end']);
	// _print_r($data,false);

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
	// _print_r($symbols_array,false);

//-------------------------------------


//-------------------------------------
// find the open, heigh, low, & closing of the range

	$data_range = array();
	foreach ($symbols_array as $key => $val) {

		$heigh_array = array();
		$low_array	 = array();

		foreach($val as $kk=>$vv){

			$heigh_array[]	 = $vv['Heigh'];
			$low_array[]	 = $vv['Low'];

		}
		// _print_r($heigh_array,false);
		// _print_r($low_array,false);

		$date = explode(' ',$val[0]['Datetime']);

		$data_range[] = array(	'Symbol'	  => $val[0]['Symbol'],
								'Open' 	 	  => $val[0]['Open'],
								'Heigh'	 	  => max($heigh_array),
								'Low'		  => min($low_array),
								'Closing'	  => $val[count($val)-1]['Closing'],
								'Datetime'	  => $val[0]['Datetime'],
								'Range_start' => $date[0].' '.$config['range_start'],
								'Range_end'	  => $date[0].' '.$config['range_end'],
							);
	}
	// _print_r($data_range,false);
	// die;
//----------------------------------



//---------------------------------------------------    
// insert into day table

    $db->insert_range($config['db']['range_table'],$data_range);

//---------------------------------------------------    


//---------------------------------------------------    
// delete data from the range table according to the settings

	$db->del($config['db']['range_table'],$config['range_table_range']);

//---------------------------------------------------    
