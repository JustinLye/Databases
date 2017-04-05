<?php

/*
	General Purpose of the grub_db class:
	
	The grub_db class acts as an interface for all interaction with the
	mysql database jlye. All other php functions and classes in this file
	or other files must use methods defined in grub_db to access and manipulate
	data stored within jlye.
	
	For example if there is a class 'user' with a method login() that takes a
	username and password as arguments, the user::login() method will need to call
	grub_db::login(). Not all methods names will be an exact match, but the primary
	point is users will have to interact with the database through a predefined
	set of functions.
	
	grub_db usage , policy, assumptions, and other notes:
	
	Errors:
		1.	All errors from public and private functions are output using the private log_error() method.
			This means functions will not report an error using the echo statement (unless debugging).
			Also, the die or exit methods will not be used. It is up to the users (of grub_db) to decide
			what actions to take when errors occur (and also to check if errors have occurred).
		2.	Users of grub_db can get error information using the get_error_log() method.
		3.	It is the responsiblity of the user to check for errors. The majority of grub_db functions
			will return false if something failed or an error was encountered.
		4. 	Critical errors are counted when logged (warnings can be logged but are not counted or otherwise.
			tracked. A user can check if any error have been logged (since the last call to get_error_log())
			using the errors_encountered() method.
	
	Connection:
		1.	The grub_db class is solely responsible for maintaining connections to the database; however,
			it is up to the user to check if a critical error has occurred.
		2. 	Critcal errors and failure_state. If an error is encountered for which a connection to the
			database is not likely to happen (i.e. the configuration file is missing) the property
			connection_state will be set to FAILURE_STATE. Users can check for failure state using the
			failure_state() method which returns ($this->connection_state == $this->FAILURE_STATE).
		3.  grub_db will not check if it has entered a failure state. This is up to users of grub_db.
			Functions will continue to be called and likey log errors if a failure state has been entered.
			Failure state is a means of notifying the user if there has been some critcal error that has
			rendered the current instance of grub_db useless.
			
	Repeated Opening and Closing of Connections:
		1. 	Connections will be opened and closed as needed. By default any connection opened will timeout
			after the DEFAULT_TIMEOUT_PERIOD as expired. The purpose of opening and closing connections and
			setting a timeout is reduce the possiblity of many idle connections, sitting open, taking up
			resources.
			
	User input and public->private member function inputs
		1. 	It is the responsibility of public member functions to inspect, validate, and/or escape any input.
		2. 	Private member functions are under no obligation to check or verify the appropriatness of input.
		3.	Private functions can assume any input validation has already occurred before the function call.
		4.  The reason for establishing responsibility is an attempt to avoid redundant checking of input. So,
			any private functions that do not check input will have public member functions that do prior to
			calling private functions.
		5.  Users of grub_db can validate input before calling grub_db functions; however, the
			public functions available to users will also assume the user making to function call has not
			performed any check or valiation of the input it (the user) is providing. So some checking, by external
			users, may be redundant. 
			
	
	
*/

class grub_db {
	//properties
	private const CONFIG_FILE_PATH = "../../../.dbconfig/.grub.config.ini"; //location of connection configuration files
	private const DEFAULT_TIMEOUT_PERIOD = 5;//timeout period is set so idle connections do not remain open taking up resources
	private const MIN_PASSWORD_LENGTH = 6; //minimum password length (this is the only restriction on passwords)
	private const DEFAULT_IMAGE_SOURCE_ID = 1;
	private const MAX_IMAGE_SIZE = 750000; //maximum size of file for image uploads
	private const VALID_USER_TYPE = array("diner", "restaurant"); //array of valid user types
	private const VALID_IMAGE_EXTENSIONS = array("jpg","jpeg", "png", "gif"); //array of valid extensions for image uploads
	private const UNKNOWN_STATE = 0; //default connection state meaning it is the status of a connection to the MySQL database is unknown because no attempt to connect to the database has been made.
	private const STABLE_STATE = 1; //this connection state means connections have been made without encountering any critical errors.
	private const FAILURE_STATE = 2; //this connection state means some critical error was encountered when connecting to the database and it is not likely a connection will be possible without changing some external values or conditions. Examples of conditions that would cause a critcal state are non-existent configuration file or invalid connection settings, password, etc.
	
	private dblink; //mysqli connection
	private error_msg_log = array(); //errors are added to this log using the log_error() method.
	private error_count = 0; //errors logged via the log_error() message with the msg_type == "ERROR" will increment this property.
	private connection_state; //the value of the currrent connection_state
	
/* -- CONSTRUCTOR and DESTRUCTOR -- */
	
	//	grub_db constructor.
	public function __construct() {
		$this->connection_state = $this->UNKNOWN_STATE; //initilize connection state
		//check if configuration file does not exist
		if(!file_exists($this->CONFIG_FILE_PATH)) { //ERROR encountered
			$this->connection_state = $this->FAILURE_STATE; //set state to failure.
			$this->log_error("__construct()", "Configuration file does not exist or given path is not valid.","ERROR"); //log error message
		}		
		$this->dblink = mysqli_init();//initilize mysqli object
		if($this->dblink->errno) { //check for any errors on initalization
			$this->connection_state = $this->FAILURE_STATE; //set state to failure
			$this->log_error("__construct()", "Error with code $this->dblink->errno was encountered following call the mysqli_init()", "ERROR"); //log error message
		}
		if(!$this->dblink->options(MYSQLI_OPT_CONNECT_TIMEOUT, $this->DEFAULT_TIMEOUT_PERIOD)) { //set timeout to default
			$this->log_error("__construct()", "Failed to set timeout for MySQL connection.", "WARNING");//log warning if timeout fails to be set
		}
	}
	
	//	grub_db destructor. Ensures connection is closed when object goes out of scope.
	public function __destruct() {
		$this->dblink->close();
	}
	
/*	=========================================================== */
//	START -- ERROR LOG RELATED FUNCTIONS


/*  -----------------------------------------------------------
	Method 	-	log_error()
	Summary -	Logs an error and the method that logged the
				error in the error_msg_log.
																*/
	
	private function log_error($method_name, $error_message, $msg_type = "ERROR") {
		if($msg_type == "ERROR") {
			$this->error_count += 1;
		}
		$this->error_msg_log[] = "METHOD: $method_name $msg_type: $error_message";
	}
	
/*  -----------------------------------------------------------
	Method 	- 	get_error_log()
	Summary -	Returns all errors currently recorded to the 
				error_msg_log array as a string,unsets 
				the error_msg_log array, and sets error_count 
				equal to zero.
																*/
	
	public function get_error_log() {
		//Initialize error log string with simple heading.
		$errlog = "Logged Errors:\n";
		//loop through the error log concatenating each message to the error string + a newline.
		foreach($this->error_msg_log as $msg) {
			$errlog .= $msg . "\n";
		}
		//clear the error_msg_log array
		unset($this->error_msg_log);
		//set error_count back to 0
		$this->error_count = 0;
		//return the error log as a string
		return $errlog;
	}
	
/*	-----------------------------------------------------------
	Method 	- 	errors_encountered()
	Summary - 	Returns true if error_count is greater than 0
																*/

	public function errors_encountered() {
		if($this->error_count > 0) {
			return true;
		} else {
			return false;
		}

/*  -----------------------------------------------------------
	Method	-	failure_state()
	Summary -	Returns true if grub_db has entered a failure
				state (i.e. a connection cannot be established). */
	
	public function failure_state() {
		return ($this->connection_state == $this->FAILURE_STATE);
	}
	
	
// END -- ERROR LOG RELATED FUNCTIONS
/* ============================================================= */


		
/* ============================================================= */
// START -- DATABASE CONNECTION RELATED FUNCTIONS


/*	-----------------------------------------------------------
	Method	-	is_connected()
	Summary - 	Check if mysqli connection property is set
				and connected. Returns true if connection is
				successfully pinged and false otherwise.
																  */
																  
	private function is_connected() {
		//check if dblink property is not set.
		if(!isset($this->dblink)) {
			$this->log_error("is_connected()", "Property dblink is not set.", "WARNING");//if dblink is not set log a warning and return false
			return false;
		}
		//ping the connection to test if it is active.
		if(!$this->dblink->ping()) {
			$this->log_error("is_connected()", "Property dblink is not connected.", "WARNING");//if connection is not active then log a warning and return false
			return false;
		} else {
			return true;//if the connection is active the return true
		}
	}
	
	
/*	-----------------------------------------------------------
	Method 	-	get_config_info()
	Summary -	Check if config file exists, if so parse the file
				and return map otherwise return false
																*/
	
	private function get_config_info() {
		//Check if file exists.
		if(!file_exists($this->CONFIG_FILE_PATH)) { //ERROR encountered
			$this->log_error("get_config_info()", "Configuration file does not exists and/or the file path provided is not valid.", "ERROR"); //if the file does not exist log the error and return false.
			return false;
		}
		//set local variable equal to configuration map/array and check if parse failed.
		if(!$config = parse_ini_file($this->CONFIG_FILE_PATH)) { //ERROR encountered
			$this->log_error("get_config_info()", "Configuration file exist, but it failed to be parsed.", "ERROR"); //if the configuration file cannot be parsed then a connection cannot be established and the grub_db object is useless.
			return false;
		}
		return $config;
	}
	
	
/*	-----------------------------------------------------------	
	Method	-	connect()
	Summary - 	Connects to mysql database if not already
				connected. Additional note, mysqli::init and
				options should have been set in the constructor
				before this is called. 

																*/	
	private function connect() {
		if(!$this->is_connected()) { //check if connection is inactive.
			if(!$config = $this->get_config_info()) {//Get configuration information map/array.
				$this->log_error("connect()", "Cannot connect without configuration info.", "ERROR");//ERROR encountered
				return false;
			}
			if(!$this->dblink->real_connect($config['servername'], $config['username'], $config['password'], $config['dbname'])) {//Attempt to connect to server using configuration settings
				$this->log_error("connect()", "Attempt to connect to MySQL database failed for the given configuration settings. Error encountered: $this->dblink->connect_error", "ERROR");//ERROR encountered				
				return false;
			}
			return true;
		} else {
			return true;//Connection is already active so return true.
		}
	}

/*	-----------------------------------------------------------	
	Method	-	disconnect()
	Summary	-	Disconnects connection to mysql database if not
				already disconnected.
																*/
	private function disconnect() {
		//Check if a connection is active.
		if($this->is_connected()) {
			if(!$this->dblink->close) { //attempt to close connection
				$this->log_error("disconnect()", "Connection failed to close. Error encountered: $this->dblink->error.", "ERROR");
				return false;
			} else {
				return true;
			}
			$this->log_error("disconnect()", "No action take. Current grub_db instance indicates no connection is currently active.", "WARNING");
		}
	}
	
// END -- DATABASE CONNECTION RELATED FUNCTIONS
/* ============================================================= */


/* ============================================================= */
// START -- INPUT CHECKING FUNCTIONS

/*	-----------------------------------------------------------	
	Method	-	escape_str()
	Summary	-	Checks if dblink is set and returns escaped
				string.
																*/

	private function escape_str($input_str) {
		if(!isset($this->dblink)) {
			$this->log_error("escape_str()","Could not escape string because dblink is not set.", "ERROR");
			return false;
		}
		return $this->dblink->real_escape_string($input_str);
	}
																
/*	-----------------------------------------------------------	
	Method 	-	escape_strings()
	Summary -	Checks if dblink is set and returns an array
				of escaped strings
																*/
																
	private function escape_strings($input_strings) {
		if(!isset($this->dblink)) {
			$this->log_error("escape_strings()", "Could not escape strings because dblink is not set.", "ERROR");
			return false;
		}
		$return_str = array();
		foreach($input_strings as $str) {
			$return_str[] = $this->dblink->real_escape_string($str);
		}
		return $return_str;
	}

// END -- INPUT CHECKING FUNCTIONS
/* ============================================================= */



/* ============================================================= */
// START -- USER RELATED FUNCTIONS FOR LOGIN AND SIGN-UP

/*	-----------------------------------------------------------	
	Method	-	get_password_hash()
	Summary -	Returns stored hash for given username if found
				in user table and false otherwise.
																*/

	private function get_password_hash($username) {
		//attempt to connect to MySQL database
		if(!$this->connect()) {
			$this->log_error("get_password_hash()", "Failed to retreive password hash.", "ERROR");
			return false;
		}
		//prepare SQL statement to retrieve password hash.
		if(!$stmt = $this->dblink->prepare("SELECT password FROM user WHERE username = ?")) {
			$this->log_error("get_password_hash()", "Failed to retrieve password hash. Error occurred preparing SQL statement. Error encountered: $stmt->error", "ERROR");
			$this->disconnect();
			return false;
		}
		//bind username to prepared statement
		if(!$stmt->bind_param('s', $username)) {
			$this->log_error("get_password_hash()", "Failed to retrieve password hash. Error occurred binding parameters to prepared statement. Error encountered: $stmt->error", "ERROR");
			$this->disconnect();
			return false;
		}
		//execute prepared statement
		if(!$stmt->execute()) {
			$this->log_error("get_password_hash()", "Failed to retrieve password hash. Error encountered execute prepared query. Error encountered: $stmt->error", "ERROR");
			$this->disconnect();
			return false;
		}
		//bind result variables
		if(!$stmt->bind_result($hash)) {
			$this->log_error("get_password_hash()", "Failed to retrieve password hash. Error occurred while trying to bind result variables. Error encountered: $stmt->error", "ERROR");
			$this->disconnect();
			return false;
		}
		//fetch result
		if(!$result = $stmt->fetch()) {
			//check if the user does not exist or some other error was found.
			if($result === false) {
				$this->log_error("get_password_hash()", "Failed to retrieve password hash. Error encountered fetching result. Error encountered: $stmt->error", "ERROR");
			} else {
				$this->log_error("get_password_hash()", "Failed to retrieve password hash. No record of $username was found. Error encountered: $stmt->error", "ERROR");
			}
			$this->disconnect();
		}
		return $hash;
	}

/*	-----------------------------------------------------------	
	Method 	-	valid_user()
	Summary	-	Returns user_verify object if hash is
				successfully verified for give username and
				password. Calls grub_db::get_password_hash()
				and verifies username and password.
																*/
																
	public function valid_user($username, $password) {
		//Open connection
		if(!$this->connect()) {
			$this->log_error("valid_user()", "Could not validate user because connect to database failed.","ERROR");
			return false;
		}
		//Escape username
		if(!$uname = $this->escape_str($username)) {
			$this->log_error("valid_user()", "Could not validate user because $username string escape failed.", "ERROR");
			return false;
		}
		//Get password hash. Return false if password hash retrieval fails.
		if(!$hash = $this->get_password_hash($uname)) {
			$this->log_error("vaild_user()","Could not validate user because password hash was not successfully retrieved", "WARNING");
			return false;
		}
		if(!password_verify($uname, $password)) {
			$this->log_error("valid_user()", "Invalid username and password.", "WARNING");
			return false;
		}
		return true;
	}

	
/*	-----------------------------------------------------------	
	Method	-	get_user_info()
	Summary	-	Returns user info from active table if valid.
	
/*	-----------------------------------------------------------	
	Method 	-	active_user()
	Summary -	Checks if a given username is active
																*/
	public function active_user($username) {
		//Open connection
		if(!$this->connect()) {
			$this->log_error("active_user()", "Could not determine if user is active because connect to database failed.","ERROR");
			return false;
		}
		//Escape username
		if(!$uname = $this->escape_str($username)) {
			$this->log_error("active_user()", "Could not determine if user is active because $username string escape failed.", "ERROR");
			return false;
		}
		
		//Prepare SQL statement
		if(!$stmt = $this->dblink->prepare("SELECT is_active FROM user WHERE username = ?")) {
			$this->log_error("active_user()", "Could not determine if user is active because failure to prepare SQL statement.", "ERROR");
			return false;
		}
		//
	}
	
// END -- USER RELATED FUNCTIONS FOR LOGIN AND SIGN-UP
/* ============================================================= */
}



?>