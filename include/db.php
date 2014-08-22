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

	function get(){}

	function insert_batch($table,$data){

		self::connect();

		$keys = array('Symbol','Name','Rate','Date','Time','Ask','Bid');

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


