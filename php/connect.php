<?php
  // Class used to interface with mysql database on CSX.
  // Previously I was including connect.php then allowing other php files to access a public mysql connection object.
  // Instead of doing this, other php files will have interface with the database via a dbconnection object.
  class dbconnection {  
    
    private $_isopen;
    private $_db_connection;
    
    function __construct() {
        $this->_isopen = false;
		echo '1';
        $db_domain = 'cs.okstate.edu';
        $db_user = 'jlye';
        $db_password = ''; //password has to be hard coded.
        $db_database = 'jlye';
        $this->_db_connection = @mysqli_connect($db_domain, $db_user, $db_password, $db_database);
        if(!$this->_db_connection) {
          echo 'Could not connect to MySQL' . mysqli_error();
        } else {
          echo 'Connection open';
        }
        if($this->_db_connection) {
			$this->_isopen = true;
		} else {
			$this->_isopen = false;
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
          return mysqli_query($this->_db_connection, "SELECT * FROM user");
          break;
        default:
          echo $table_name . ' is not a valid table name.';
          return false;
          break;
      }
    }
  }
      

  
  
  
?>