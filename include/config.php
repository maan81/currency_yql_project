<?php

/**
 * Database connections
 *
 */
$config['db']['server']   = 'localhost';
$config['db']['database'] = 'currency_yql';
$config['db']['username'] = 'root';
$config['db']['password'] = 'password';


$config['db']['minute_table'] = 'minute_table';
$config['db']['hour_table']   = 'hour_table';
$config['db']['day_table']    = 'day_table';


$config['use_filedata'] = false;
$config['filepath'] = 'include/';
$config['filename'] = 'current_data_json.';


$config['yql'] = 'select * from yahoo.finance.xchange where pair in ("GBPUSD", "USDCHF", "EURUSD", "GBPJPY", "EURJPY", "GBPEUR", "USDCAD", "USDJPY", "AUDUSD", "NZDUSD", "EURAUD", "EURCHF", "GBPCHF", "CADJPY", "AUDNZD", "GBPCAD", "EURNZD", "EURCAD", "CHFJPY", "AUDJPY")';
$config['env'] = 'store://datatables.org/alltableswithkeys';
$config['url'] = 'http://query.yahooapis.com/v1/public/yql?q='.urlencode($config['yql']).'&env='.urlencode($config['env']).'&format=json';










function _print_r($data,$end=true,$return=false){

	$str = '';

	if(!$return){

		$t = debug_backtrace();

		$str .= PHP_EOL.'<hr/>';
		$str .= '<pre>';
		$str .= print_r('file : '.$t[0]['file'],true);
		$str .= '</pre>';
		$str .= PHP_EOL.'<pre>';
		$str .= print_r('line : '.$t[0]['line'],true);
		$str .= '</pre>';
		$str .= PHP_EOL.'<pre>';
		$str .= print_r('data :'.print_r($data,true),true);
		$str .= '</pre>';
		$str .= PHP_EOL.'<hr/>';
	}


	if(!$end){
		echo $str;
		return;
	}

	echo $str;
	die;
}
