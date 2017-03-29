<?php

class util {
require_once('../../../php/connect.php');	
	private static $_active_user_v_headings = array(
		'User ID',
		'Name',
		'Email',
		'Type',
		'Reg. Date',
		'Last Login');
	public static function active_user_v_headings() { return self::$_active_user_v_headings; }
	
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

?>
