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

echo 'asdfasdf';

echo '<br/>';

print_r($_REQUEST);

echo '<br/>';

print_r($_POST);

echo '<br/>';

print_r($_GET);