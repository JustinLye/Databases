<?php

class dbc  {
	
	protected function connect($config_filepath) {
		$config = parse_ini_file($config_filepath);
		if(!$connection = mysqli_connect(
			$config['servername'],
			$config['username'],
			$config['password'],
			$config['dbname'])) {
			return false;
		}
		return $connection;		
	}
	
}

?>