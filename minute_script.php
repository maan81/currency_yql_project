<?php

/*
    - grab data from yahoo currency api for list of symbols (?) every minute

    http://query.yahooapis.com/v1/public/yql?q=select * from yahoo.finance.xchange where pair in ("GBPUSD", "USDCHF", "EURUSD", "GBPJPY", "EURJPY", "GBPEUR", "USDCAD", "USDJPY", "AUDUSD", "NZDUSD", "EURAUD", "EURCHF", "GBPCHF", "CADJPY", "AUDNZD", "GBPCAD", "EURNZD", "EURCAD", "CHFJPY", "AUDJPY")&env=store://datatables.org/alltableswithkeys

    - insert collected data into db table
    - table name (minute_data ?)

    - columns 

        YQL Cols   |  Table Cols
        -----------|--------------
                   |    id
        id         |    Symbol
        Name       |    Name
        Rate       |    Rate
        Date       |    Date
        Time       |    Time
        Ask        |    Ask
        Bid        |    Bid

*/

require_once('include/config.php');
// require_once('include/simple_html_dom.php');
require_once('include/db.php');


// use stored data
if($config['use_filedata']){
    $myfile = fopen('include/current_data_json', "r") or die("Unable to open file!");
    $resp= fread($myfile,filesize('include/current_data_json'));
    fclose($myfile);

// use live online data
}else{

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_URL            => $config['url'],
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_SSL_VERIFYHOST => false
    ));

    $resp = curl_exec($curl);

    curl_close($curl);
}



//current data in array
$data = json_decode($resp,true);


//---------------------------------------------------    
//getting the datetime & converting to to UT & setting it in the array
    $datetime = explode('T', $data['query']['created']);


    $date =  $datetime[0];
    $time =  explode('Z', $datetime[1]);
    $time = $time[0];

    $created = $data['query']['created'];
    $data = $data['query']['results']['rate'];

    for ($i=0;$i<count($data);$i++){ 
        $data[$i]['Date'] = $date;
        $data[$i]['Time'] = $time;
    }

    // foreach($data as $key=>$val){
    //     $val['Date'] = $date;
    //     $val['Time'] = $time;
    // }
//---------------------------------------------------    

// _print_r($data);




//---------------------------------------------------    
// insert into db
    $db = new Database($config);

    $db->insert_batch($config['db']['minute_table'],$data);
//---------------------------------------------------    
