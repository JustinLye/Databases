<?php
require_once('/home/jlye/.php/.dbc.php');
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

class q1 {
    public static $PartA_InputFormString = "<h3>Query that involves one table. (1.a)</h3>
                <p>Fill out the form and click the submit button to add a user to the table</p>
                <div class=\"usr-form\">
                    <form action=\"q1.php\" method=\"post\" id=\"add_user_form\">
                        <table>
                            <tr>
                                <td>User Name:</td>
                                <td><input type=\"text\" name=\"user_name\" size=\"32\" placeholder=\"Enter User Name...\" /></td>
                            </tr>
                            <tr>
                                <td>Email:</td>
                                <td><input type=\"email\" name=\"user_email\" size=\"128\" placeholder=\"Enter Email Address...\" /></td>
                            </tr>
                            <tr>
                                <td>User Type:</td>
                                <td>
                                    <select name=\"user_type\">
                                        <option value=\"diner\">Diner</option>
                                        <option value=\"restaurant\">Restaurant</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Password:</td>
                                <td><input type=\"password\" name=\"pass_word\" placeholder=\"Enter a password...\" /></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><input type=\"submit\" name=\"submit\" value=\"Add User\" /></td>
                            </tr>
                        </table>
                    </form>
                </div>
                <p>Table before adding new user.<p>";
    private $dbc;
    public function __construct() {
        $this->dbc = new db_connection;
    }
    
    public function get_user_table() {
        return $this->dbc->dblink()->query("SELECT * FROM active_user_v");
    }    
    public function errors() {
        return $this->dbc->errors();
    }
}

?>
