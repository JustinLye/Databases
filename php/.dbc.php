<?php
/*
	This file provides a msqli object using credentials saved in a configuration file.
	Since there is only one user of the database (I cannot create additional users on the MySQL server)
	access to this mysqli object grants all privilages to the database including the ability to create/drop
	tables, triggers, views etc. I feel like it is a bad idea the allow external scripts
	unbounded access to the database via a mysqli object; however, it will make completing
	the assigned project must easier.
*/


//error_keeper class maintains a string of errors that can be logged and flushed.
class error_keeper {
	private $errors; //string of errors appended with calls to log_error(). resets on call to flush_errors()
	private $error_count; //counts calls to log_error(). resets on call to flush_errors()
	private $log_as_html; //indicates if errors should be flushed with html tags for paragraph and break.
	
	public function __construct($html_tags = true) {
		$this->log_as_html = $html_tags;
		$this->error_count = 0;
		$this->errors = "";
	}
	
	public function log_error($file_name, $function_name, $line_num, $msg) {
		$this->error_count++;
		if($this->log_as_html) {
			$this->errors = "FILE: " . $file_name . " FUNCTION: " . $function_name . " LINE: " . $line_num . " DESC: " . $msg . "<br>" . $this->errors;
		} else {
			$this->errors = "FILE: " . $file_name . " FUNCTION: " . $function_name . " LINE: " . $line_num . " DESC: " . $msg . "\n" . $this->errors;
		}
	}
	public function flush_errors() {
		$this->log_as_html ? $err_str = "<p>" . $this->errors . "</p>" : $err_str = $this->errors;
		//$this->errors = "";
		$this->error_count = 0;
		return $err_str;
	}
	public function errors_logged() { return $this->error_count > 0; }
}

class db_connection {
	private $CONFIG_FILE = "/home/jlye/.dbconfig/.grub.config.ini"; //full path to configuration file
	private $DEFAULT_TIMEOUT = 5; //default connection timeout period
        public static $MIN_PASSWORD_LENGTH = 6;
	private $config; //array of configuration settings
	private $errlog; //simple object to log errors (for debugging)
	private $_dblink; //mysqli object
	private $config_loaded = false; //indicates configuration file has already been parsed and saved in $config
	public function __construct() {
		$errlog = new error_keeper;
		$this->_dblink = mysqli_init(); //initialize mysqli object
		$this->_dblink->options(MYSQLI_OPT_CONNECT_TIMEOUT, $this->DEFAULT_TIMEOUT); //set timeout
	}
	public function __destruct() {
		$this->_dblink->close();
	}
	public function dblink() {
		if(!$this->connect()) {
			$this->log_error(__FILE__, __FUNCTION__, __LINE__, "Link was not returned because connection to database failed.");
			return false;
		}
		return $this->_dblink;
	}
	
	public function errors() { return $this->errlog->flush_errors(); }
	
	private function load_config() {
		if(!file_exists($this->CONFIG_FILE)) {
			$this->errlog->log_error(__FILE__, __FUNCTION__, __LINE__, "Error configuration file not found.");
			$this->config_loaded = false;
			return false;
		}
		if(!$this->config = parse_ini_file($this->CONFIG_FILE)) {
			$this->errlog->log_error(__FILE__, __FUNCTION__, __LINE__, "Error parsing configuration file.");
			$this->config_loaded = false;
			return false;
		}
		$this->config_loaded = true;
		return true;
	}
	
	private function connect() {
		if($this->_dblink->ping()) { return true; } //return true if connection is active.
		if(!$this->config_loaded) {
			if(!$this->load_config()) {
				$this->errlog->log_error(__FILE__, __FUNCTION__, __LINE__, "Could not get configuration settings to connect to database.");
				return false;
			}
		}
		if(!$this->_dblink->real_connect($this->config['servername'], $this->config['username'], $this->config['password'], $this->config['dbname'])) {//Attempt to connect to server using configuration settings
			$this->errlog->log_error(__FILE__, __FUNCTION__, __LINE__, "Could not connect to database.");
			return false;
		}
		return true;
	}
}


?>