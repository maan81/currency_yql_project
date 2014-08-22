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
	function get($table,$param){

		self::connect();

		$sql = '';

// select * from minute_table
// where date 
// and time 

		$sql .= ';';

		self::disconnect();
	}

	/**
	 * Insert data as a batch, ie multiple rows at once
	 * @param string -- table name
	 * @param array --- array of arrays of data
	 */
	function insert_batch($table,$data){

		self::connect();

		$keys = array('Symbol','Name','Rate','Date','Time','DateTime','Ask','Bid');

		$sql = 'INSERT INTO '.$table.' ( '.implode(',',$keys).' ) VALUES ';

		$first=true;

		foreach($data as $key=>$val){
			if(!$first){
				$sql .= ',';
			}

			// $sql .= '("'.implode('","', $val).'")';
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

		// _print_r($sql,false);

		mysqli_query($this->con,$sql);

		self::disconnect();
	}

}


