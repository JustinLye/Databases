<?php
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
            $str = "<div class=\"tbl_data\">
                        <table>
                            <tr> ";
            foreach($headings as $h) {
                $str .= "<th>" . $h . "</th>";
            }
            $str .= "       </tr>";
            while($r = mysqli_fetch_array($data, MYSQLI_ASSOC)) {
                $str .= "       <tr>
                    ";
                foreach($r as $info) {
                    $str .= "           <td>$info</td>
                            ";
                }
                $str .= "       </tr>
                        ";
            }
            $str .= "   </table>
                    </div>
                    ";
            return $str;
	}
        public static function to_html_table_chg_width($headings, $data, $width) {
            $str = "<div class=\"tbl_data\">
                        <table style=\"width:$width;\">
                            <tr> ";
            foreach($headings as $h) {
                $str .= "<th>" . $h . "</th>";
            }
            $str .= "       </tr>";
            while($r = mysqli_fetch_array($data, MYSQLI_ASSOC)) {
                $str .= "       <tr>
                    ";
                foreach($r as $info) {
                    $str .= "           <td>$info</td>
                            ";
                }
                $str .= "       </tr>
                        ";
            }
            $str .= "   </table>
                    </div>
                    ";
            return $str;
	}
}
?>