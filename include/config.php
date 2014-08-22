<?php

/**
 * Database connections
 */
$config['db']['server']   = 'localhost';
$config['db']['database'] = 'currency_yql';
$config['db']['username'] = 'root';
$config['db']['password'] = 'password';


/**
 * Database tables
 */
$config['db']['minute_table'] = 'minute_table';
$config['db']['hour_table']   = 'hour_table';
$config['db']['day_table']    = 'day_table';



/**
 * Data obtained external url
 */
$config['yql'] = 'select * from yahoo.finance.xchange where pair in ("GBPUSD", "USDCHF", "EURUSD", "GBPJPY", "EURJPY", "GBPEUR", "USDCAD", "USDJPY", "AUDUSD", "NZDUSD", "EURAUD", "EURCHF", "GBPCHF", "CADJPY", "AUDNZD", "GBPCAD", "EURNZD", "EURCAD", "CHFJPY", "AUDJPY")';
$config['env'] = 'store://datatables.org/alltableswithkeys';
$config['url'] = 'http://query.yahooapis.com/v1/public/yql?q='.urlencode($config['yql']).'&env='.urlencode($config['env']).'&format=json';


/**
 * Data obtained from static file
 */
$config['use_filedata'] = false;  // true = uses data from file; false = used data from url, ie yahoo finance
$config['filepath'] = 'include/';
$config['filename'] = 'current_data_json.';




/**
 * Print_r fn customized for debugging.
 * should not be necessary for production
 *
 */
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
