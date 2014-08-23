<?php

/**
* Database access & handling
*/
class Database{
	
	private $server;
	private $database;
	private $username;
	private $password;


	function __construct($config){

		$this->server   = $config['db']['server'];
		$this->database = $config['db']['database'];
		$this->username = $config['db']['username'];
		$this->password = $config['db']['password'];
	}
	function connect(){

		$this->con=mysqli_connect($this->server,$this->username,$this->password,$this->database);
		// Check connection
		if (mysqli_connect_errno()){
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
			die;
		}
	}
	function disconnect(){

		mysqli_close($this->con);
	}


	/**
	 * Get Table by parameters
	 */
	function get($table,$param,$symbol=false){
		// _print_r($symbol);
		self::connect();

		$sql = 'SELECT * FROM '.$table.' WHERE 1 ';

		
		// 'Datetime'=> '1_hour_earlier'
		if( $param=='1_hour_earlier'){
			$datetime = new DateTime(null, new DateTimeZone('UTC'));
			$datetime->modify('-1 hour');
			$earlier =  $datetime->format('Y-m-d H:i:s');

			// // $sql .= ' AND Datetime 	>= '.gmdate("Y-m-d H:i:s").' - INTERVAL 1 HOUR ';
			$sql .= ' AND Datetime 	>= "'.$earlier.'"';
		}


		// 1_day_earlier
		else if( $param=='1_hour_earlier'){
			$datetime = new DateTime(null, new DateTimeZone('UTC'));
			$datetime->modify('-1 day');
			$earlier =  $datetime->format('Y-m-d H:i:s');

			// // $sql .= ' AND Datetime 	>= '.gmdate("Y-m-d H:i:s").' - INTERVAL 1 HOUR ';
			$sql .= ' AND Datetime 	>= "'.$earlier.'"';
		}


		// get data of a symbol only
		if(!empty($symbol)){

			// latest_minute
			if( $param=='latest_minute') {

				// to get the latest minute's data of the 20 symbols
				$sql .= ' AND Symbol = "'.strtoupper($symbol).'" ORDER BY Datetime DESC LIMIT 1 ';

			}

			// latest_minute
			else if( $param=='latest_hour') {

				// to get the latest minute's data of the 20 symbols
				$sql .= ' AND Symbol = "'.strtoupper($symbol).'" ORDER BY Datetime DESC LIMIT 1 ';

			}

			// latest_minute
			else if( $param=='latest_day') {

				// to get the latest minute's data of the 20 symbols
				$sql .= ' AND Symbol = "'.strtoupper($symbol).'" ORDER BY Datetime DESC LIMIT 1 ';

			}
		}



		$sql .= ';';

		_print_r($sql,false);

		$res = mysqli_query($this->con,$sql);

		$data = array();
		while($val = mysqli_fetch_assoc($res)){
			$data[] = $val;
		}

		self::disconnect();

		return $data;
	}


	function insert_minute($table,$data){

		self::connect();

		$keys = array('Symbol','Name','Rate','Date','Time','DateTime','Ask','Bid');

		$sql = 'INSERT INTO '.$table.' ( '.implode(',',$keys).' ) VALUES ';

		$first=true;

		foreach($data as $key=>$val){
			if(!$first){
				$sql .= ',';
			}

			$sql .= '('.
						'"'.$val['id']  .'",'.
						'"'.$val['Name'].'",'.
							$val['Rate'].','.
						'"'.date('Y-m-d',strtotime($val['Date'])).'",'.
						'"'.date('H:i',strtotime($val['Time'])).'",'.
						'"'.$val['Datetime'].'",'.
							$val['Ask']	.','.
							$val['Bid']	.
					')';

			$first = false;	
		}
		$sql .= ';';

		mysqli_query($this->con,$sql);

		self::disconnect();
	}


	function insert_hour($table,$data){

		self::connect();

		$keys = array('Symbol','Open','Heigh','Low','Closing','Datetime');

		$sql = 'INSERT INTO '.$table.' ( '.implode(',',$keys).' ) VALUES ';

		$first=true;

		foreach($data as $key=>$val){
			if(!$first){
				$sql .= ',';
			}

			$sql .= '('.
						'"'.$val['Symbol'].'",'.
							$val['Open'].','.
							$val['Heigh'].','.
							$val['Low'].','.
							$val['Closing'].','.
						'"'.$val['Datetime'].'"'.
					')';

			$first = false;	
		}
		$sql .= ';';
		// _print_r($sql);
		mysqli_query($this->con,$sql);

		self::disconnect();
	}


	function del($table,$cond){
		self::connect();

		$sql = 'DELETE FROM '.$table.' WHERE 1 ';

		// 'Datetime'=> '2_hour_earlier'
		if( $cond=='2_hour_earlier'){
			$datetime = new DateTime(null, new DateTimeZone('UTC'));
			$datetime->modify('-2 hours');
			$earlier =  $datetime->format('Y-m-d H:i:s');

			$sql .= ' AND Datetime 	<= "'.$earlier.'"';
		}

		// 'Datetime'=> '2_day_earlier'
		else if( $cond=='2_day_earlier'){
			$datetime = new DateTime(null, new DateTimeZone('UTC'));
			$datetime->modify('-2 days');
			$earlier =  $datetime->format('Y-m-d H:i:s');

			$sql .= ' AND Datetime 	<= "'.$earlier.'"';
		}

		// 'Datetime'=> '2_weeks_earlier'
		else if( $cond=='2_weeks_earlier'){
			$datetime = new DateTime(null, new DateTimeZone('UTC'));
			$datetime->modify('-2 weeks');
			$earlier =  $datetime->format('Y-m-d H:i:s');

			$sql .= ' AND Datetime 	<= "'.$earlier.'"';
		}

		$sql .= ';';

		_print_r($sql);

		mysqli_query($this->con,$sql);

		self::disconnect();
	}



	// function del_minute($table,$cond){
	// 	self::connect();

	// 	$sql = 'DELETE FROM '.$table.' WHERE 1 ';

	// 	// 'Datetime'=> '2_hour_earlier'
	// 	if( $cond=='2_hour_earlier'){
	// 		$datetime = new DateTime(null, new DateTimeZone('UTC'));
	// 		$datetime->modify('-2 hours');
	// 		$earlier =  $datetime->format('Y-m-d H:i:s');

	// 		$sql .= ' AND Datetime 	<= "'.$earlier.'"';
	// 	}
	// 	$sql .= ';';

	// 	_print_r($sql);

	// 	mysqli_query($this->con,$sql);

	// 	self::disconnect();
	// }


	// function del_hour($table,$cond){
	// 	self::connect();

	// 	$sql = 'DELETE FROM '.$table.' WHERE 1 ';

	// 	// 'Datetime'=> '2_day_earlier'
	// 	if( $cond=='2_day_earlier'){
	// 		$datetime = new DateTime(null, new DateTimeZone('UTC'));
	// 		$datetime->modify('-2 days');
	// 		$earlier =  $datetime->format('Y-m-d H:i:s');

	// 		$sql .= ' AND Datetime 	<= "'.$earlier.'"';
	// 	}
	// 	$sql .= ';';

	// 	_print_r($sql);

	// 	mysqli_query($this->con,$sql);

	// 	self::disconnect();
	// }

}


