<?php
require_once('/home/jlye/.php/.grub_connect.php');
class util {
	// arrays for data table/output column headings
	private static $_active_user_v_headings = array(
		'User ID',
		'Name',
		'Email',
		'Type',
		'Reg. Date',
		'Last Login');
		
	private static $_active_diner_v_headings = array(
		'Name',
		'Email',
		'Credability');
	public static function active_user_v_headings() { return self::$_active_user_v_headings; }
	public static function active_diner_v_headings() { return self::$_active_diner_v_headings; }
	public static function to_html_table($headings, $data) { 
		echo '<div class="tbl_data">' . "\n";
		echo "\t" . '<table>' . "\n";
		echo "\t\t" . '<tr>' . "\n";
		foreach($headings as $h) {
			echo "\t\t\t" . '<th>' . $h . '</th>' . "\n";
		}
		echo "\t\t" . '</tr>' . "\n";
		while($r = mysqli_fetch_array($data, MYSQLI_ASSOC)) {
			echo "\t\t" . '<tr>' . "\n";
			foreach($r as $info) {
				echo "\t\t\t" . '<td>' . $info . '</td>' . "\n";
			}
			echo "\t\t" . '</tr>' . "\n";
		}
		echo "\t" . '</table>' . "\n";
		echo '</div>' . "\n";
	}
}

class diner {
	private $name;
	private $id;
	
	public function __construct($username, $userid) {
		$this->name = $username;
		$this->id = $userid;
	}
	
	public function get_name() {
		return $this->name;
	}
	public function set_name($username) {
		$this->name = $username;
	}
	public function get_id() {
		return $this->id;
	}
	public function set_id($userid) {
		$this->id = $userid;
	}
}

/*
class entree {
	private $_id;
	private $_description;
	private $_img_src;
	private $_img_name;
	private $_location_id;
	
	public function __construct($init_id) {
		
	}
}
*/
?>
