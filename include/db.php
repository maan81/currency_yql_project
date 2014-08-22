<?php

/**
* Database access & handling
*/
class db{
	
	// $server   = '';
	// $database = '';
	// $username = 'root';
	// $password = 'password';


	function __construct(/*argument*/){

		require_once('config.php');

		$this->server   = $config['db']['server'];
		$this->database = $config['db']['database'];
		$this->username = $config['db']['username'];
		$this->password = $config['db']['password'];

	}


	function connect(){

		$$this->con=mysqli_connect($this->server,$this->username,$this->password,$this->database);
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

	function insert($table,$data){

		self::connect();

		$keys = array_keys($data[0]);

		$sql = 'INSERT INTO '.$table.' ( '.implode(',',$keys).' ) VALUES ';


		foreach($data as $key=>$val){
			foreach($val as $kk=>$vv){
				$sql .= '"'.$vv.'"';
			}
		}

		$sql .= ');';

		_print_r($sql,false);

		mysqli_query($this->con,$sql);


		//===============================
			// $con=mysqli_connect("localhost","my_user","my_password","my_db");
			// // Check connection
			// if (mysqli_connect_errno())
			//   {
			//   echo "Failed to connect to MySQL: " . mysqli_connect_error();
			//   }

			// // Perform queries
			// mysqli_query($con,"SELECT * FROM Persons");
			// mysqli_query($con,"INSERT INTO Persons (FirstName,LastName,Age)
			// VALUES ('Glenn','Quagmire',33)");

			// mysqli_close($con);
	}

}


