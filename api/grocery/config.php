<?php
	class Config
	{
		static $token = "1234";

		public function __construct()
		{
			$this->__init();
		}

		public function __init()
		{
			if($_SERVER['HTTP_HOST']=='localhost')
			{
				$server = 'localhost';
				$login = 'root'; 
				$password = ''; 
				$db = 'indiashop'; 
			}else{
				// you can change the following details as per your database configuration
				$server = 'localhost';	
				$login = 'wwwindia_main'; 
				$password = 'india@1234'; 
				$db = 'wwwindia_grocery'; 
			}

			// establish database connection

			$conn = mysql_connect($server, $login, $password) or die(mysql_error());

			mysql_select_db($db, $conn) or die(mysql_error($conn));
			date_default_timezone_set("Asia/Kolkata");
		}

		public function executeQuery( $sql )
		{
			return mysql_query( $sql );
		}
	
		public function getRow( $sql  )
		{
			$result = mysql_query( $sql ) or die(mysql_error());
			$row = mysql_fetch_assoc( $result );
			return $row;
		}

		public function getRowObj( $sql  )
		{
			$result = mysql_query( $sql ) or die(mysql_error());
			$row = mysql_fetch_object( $result );
			return $row;
		}
	
		public function getAllRows( $sql )
		{
			$list = array();
			$result = mysql_query( $sql );
			
			while( $row = mysql_fetch_assoc( $result ) )
			{
				$list[] = $row;
			}
	
			return $list;
		}

		public function totalRows( $sql )
		{
			$result = $this->executeQuery( $sql );
			return mysql_num_rows( $result );
		}
	
		public function getTotalRows( $table )
		{
			$sql = "SELECT * FROM $table";
			$result = $this->executeQuery( $sql );
			return mysql_num_rows( $result );
		}
	}

	function input( $key )
	{
		return @$_REQUEST[$key];
	}

	function __autoload( $class )
	{
		$class_dir = dirname(__FILE__)."/classes/";

		if( file_exists( $class_dir.$class.".php" ) )
		{
			include_once( $class_dir.$class.".php" );
		}
	}
?>