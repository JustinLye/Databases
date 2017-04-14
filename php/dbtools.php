<?php
require_once('/home/jlye/.php/.dbc.php');

define('USER_TO_REST', 1);
define('REST_TO_USER', 2);
define('USER_TO_DINER', 3);
define('DINER_TO_USER', 4);

class msg {
    public static $last_error = "";
}

function get_id($id, $lookup_type) {
    $ret_id = 0; //result
    $db = new db_connection; //create new connection object
    $link = $db->dblink(); //get copy of connected mysqli object 
    
    $_id = $link->real_escape_string($id); //escape the user input
    $sql_str = ""; //init string
    switch ($lookup_type) { //switch on the type of lookup we are performing
        case USER_TO_REST:
            $sql_str = "SELECT restaurant_id FROM restaurant WHERE user_id = ?";
            break;
        case REST_TO_USER:
            $sql_str = "SELECT user_id FROM restaurant WHERE restaurant_id = ?";
            break;
        case USER_TO_DINER:
            $sql_str = "SELECT diner_id FROM diner WHERE user_id = ?";
            break;
        case DINER_TO_USER:
            $sql_str = "SELECT user_id FROM diner WHERE diner_id = ?";
            break;
        default:
            msg::$last_error = "lookup_type was not valid.";
            break;
    }
    if($sql_str == "") { //if the lookup passed was not vaild then just return false
        return false;
    }
    
    $stmt = $link->prepare($sql_str); //prepare the statement
    $stmt->bind_param('i', $_id); //bind parameter
    $stmt->execute(); //execute query
    $stmt->bind_result($ret_id); //bind the result variable
    $stmt->fetch(); //fetch the query result
    return $ret_id; //return id or NULL
}

function get_user_table() {
    $db = new db_connection;
    $link = $db->dblink();
    return $link->query("SELECT * FROM active_user_v");
}
function add_user($name, $email, $password, $type) {
    $db = new db_connection;
    $link = $db->dblink();
    $esc_name = $link->real_escape_string(filter_var($name, FILTER_SANITIZE_STRING));
    $esc_email = $link->real_escape_string(filter_var($email,FILTER_SANITIZE_STRING));
    $esc_type = $link->real_escape_string(filter_var($type, FILTER_SANITIZE_STRING));
    $flt_password = filter_var($password, FILTER_SANITIZE_STRING);
    if(strlen($esc_name) <= 0 or strlen($esc_email) <=0 or ($esc_type != 'diner' and $esc_type != 'restaurant') or strlen($flt_password) <= 0) {
        msg::$last_error = "Invalid input. Make sure all input is not blank.";
        return false;
    } else {
        $hash = password_hash($flt_password, PASSWORD_DEFAULT);
        $stmt = $link->prepare("INSERT INTO user VALUES(NULL,TRUE, NOW(), NOW(), ?, ?, ?, ?)");
        $stmt->bind_param('ssss', $esc_type, $esc_name, $esc_email, $hash);
        return $stmt->execute();
    }
}


?>