<?php
  // Class used to interface with mysql database on CSX.
  // Previously I was including connect.php then allowing other php files to access a public mysql connection object.
  // Instead of doing this, other php files will have interface with the database via a dbconnection object.
  class dbconnection {  
    
		private $_isopen;
		private $_db_connection;
    
		function __construct() {
			$this->_isopen = false;
			$db_domain = 'cs.okstate.edu';
			$db_user = 'jlye';
			$db_password = ''; //password has to be hard coded.
			$db_database = 'jlye';
			$this->_db_connection = @mysqli_connect($db_domain, $db_user, $db_password, $db_database);
			if(!$this->_db_connection) {
				echo 'Could not connect to MySQL ' . mysqli_error();
				$this->_isopen = false;
			} else {
				$this->_isopen = true;
			}
		}
		function __destruct() {
			if($this->_isopen) {
				mysqli_close($this->_db_connection);
			}
		}
    
		public function get_table($table_name) {
			if(!$this->_isopen) {
				echo 'database connection is not open.';
				return false;
			}
			switch($table_name) {
			case "user":
				return mysqli_query($this->_db_connection, "SELECT * FROM active_user_v");
				break;
			case "diner":
				return mysqli_query($this->_db_connection, "SELECT * FROM active_diner_v");
				break;
			default:
				echo $table_name . ' is not a valid table name.';
				return false;
				break;
			}
		}
		
		public function add_user($name, $email, $password, $type) {
			if(!$this->_isopen) {
				echo ' database connection is not open';
				return false;
			}
			
			$sql_str = "INSERT INTO user VALUES(NULL, TRUE, NOW(), NOW(), '$type', '$name', '$email', '$password')";
			if(mysqli_query($this->_db_connection, $sql_str)) {
				return true;
			} else {
				return false;
			}
		}
		
		public function user_search($target, $target_type, $exact_match) {
			if(!$this->_isopen) {
				echo ' database connection is not open';
				return false;
			}
			switch($target_type) {
				case "name":
					if($exact_match) {
						return mysqli_query($this->_db_connection, "SELECT * FROM active_user_v WHERE user_name = '$target'");
					} else {
						return mysqli_query($this->_db_connection, "SELECT * FROM active_user_v WHERE user_name LIKE '%$target%'");
					}
					break;
				default:
					echo ' Invalid target type' . "\n";
					return false;
					break;
			}
		}
		
		public function get_error() {
			if($this->_isopen) {
				return mysqli_error($this->_db_connection);
			} else {
				return "";
			}
		}
  }
      

  
  
  
?>