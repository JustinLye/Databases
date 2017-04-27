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
//Returns view of active users
function get_user_table() {
    $db = new db_connection;
    return $db->dblink()->query("SELECT * FROM active_user_v ORDER BY user_id DESC");
}
//Returns diner table
function get_diner_table() {
    $db = new db_connection;
    return $db->dblink()->query("SELECT din.user_id, din.diner_id, usr.user_name FROM diner AS din, user AS usr WHERE din.user_id = usr.user_id");
}
//Returns restaurant table
function get_restaurant_table() {
    $db = new db_connection;
    return $db->dblink()->query("SELECT rest.user_id, rest.restaurant_id, usr.user_name FROM restaurant AS rest, user as usr WHERE rest.user_id = usr.user_id");
}


//Obsolete -- Make sure nothing is using this method then delete it
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

//Returns string containing html select list options for states
function get_us_state_select_options() {
    $s0 = "<option value=\"";
    $s1 = "\">";
    $s2 = "</option>";
    $options = "";
    $db = new db_connection; //init database connection obj.
    $link = $db->dblink(); //get copy of connected mysqli object.
    if(!$q = $link->query("SELECT subdivision_code, description FROM geolocations WHERE country_code = 'US';")) { //query database for united states ISO state codes
        echo "<p>Geolocation query failed</p>";
        return "";
    }   
    while($row = $q->fetch_array(MYSQLI_NUM)) { //loop through query result appending each row as an html select list option.
        $options .= $s0 . $row[0] . $s1 . $row[1] . $s2;
    }
    return $options;
}

//Returns html select list options for user_types
function get_user_types_select_options() {
    $s0 = "<option value=\"";
    $s1 = "\">";
    $s2 = "</option>";
    $options = "";
    $db = new db_connection; //init database connection obj.
    $link = $db->dblink(); //get copy of connected mysqli object.
    if(!$q = $link->query("SELECT description FROM user_types")) { //query database for user types
        echo "<p>User type query failed</p>";
        return "";
    }
    while($row = $q->fetch_array(MYSQLI_NUM)) { //loop through query result appending each row as an html select list option.
        $options .= $s0 . $row[0] . $s1 . $row[0] . $s2;
    }
    return $options;    
}

//creates new user, assumes calling function has not filtered input or 
function sign_up($name, $type, $email, $password) {
    $db = new db_connection; //init database connection obj.
    $link = $db->dblink(); //get copy of connected mysqli object.
    //filter and escape input
    $n = $link->real_escape_string(
            filter_var($name, FILTER_SANITIZE_STRING));
    $t = $link->real_escape_string(
            filter_var($type, FILTER_SANITIZE_STRING));
    $e = $link->real_escape_string(
            filter_var($email, FILTER_SANITIZE_STRING));
    $hash = password_hash(filter_var($password, FILTER_SANITIZE_STRING), PASSWORD_DEFAULT); //create password hash key for db storage
    //prepare sql statment and return result of execute()
    $stmt = $link->prepare("INSERT INTO user VALUES(
        NULL, TRUE, NOW(), NOW(), ?, ?, ?, ?)");
    $stmt->bind_param('ssss', $t, $n, $e, $hash);
    if(!$result = $stmt->execute()) {
        echo $link->error;
    }
    return $result;
}

//Validates username password combination. Returns true if vaild, false otherwise.
function valid_user_login_credentials($username, $password) {
    $db = new db_connection; //init database connection obj.
    $link = $db->dblink(); //get copy of connected mysqli object.
    
    //filter and escape input
    $n = $link->real_escape_string(
            filter_var($username, FILTER_SANITIZE_STRING));
    $p = filter_var($password, FILTER_SANITIZE_STRING); //password is filtered when stored so I think it's best to filter it when retreived
    
    //prepare sql statment to get hash key for username.
    $stmt = $link->prepare("SELECT password FROM user WHERE user_name = ?");
    $stmt->bind_param('s', $n);
    $stmt->execute();
    $stmt->bind_result($hash); //store resulting hash key in var
    $stmt->fetch(); //get result of query
    
    //return result of password_verify()
    return password_verify($p, $hash);
}

//Returns a string that contains html source for a standard sign-up form.
function get_signup_form($action = "add_user.php") {
    $frm ="<div class=\"usr-form\">
            <form action=\"" . $action . "\" method=\"post\" id=\"add_user_form\">
                <table>
                    <tr>
                        <td>User Name:</td>
                        <td><input type=\"text\" name=\"name\" size=\"32\" placeholder=\"Enter User Name...\" /></td>
                    </tr>
                    <tr>
                        <td>Email:</td>
                        <td><input type=\"email\" name=\"email\" size=\"128\" placeholder=\"Enter Email Address...\" /></td>
                    </tr>
                    <tr>
                        <td>User Type:</td>
                        <td>
                            <select name=\"type\"> " .
                            get_user_types_select_options() .
                                /*<option value=\"diner\">Diner</option>
                                <option value=\"restaurant\">Restaurant</option>*/
                            " </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Password:</td>
                        <td><input type=\"password\" name=\"password\" placeholder=\"Enter a password...\" /></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><input type=\"submit\" name=\"submit\" value=\"Add User\" /></td>
                    </tr>
                </table>
            </form>
        </div>";
    return $frm;
}

function add_location_form($action = "add_location.php") {
    $frm = "<div class=\"usr-form\">
		<form action=\"". $action . "\" method=\"post\" id=\"add_location_form\">
			<table>
				<tr>
					<td>Name</td>
					<td><input type=\"text\" name=\"name\" placeholder=\"Enter location name...\" /></td>
				</tr>
				<tr>
					<td>Country</td>
					<td><input type=\"text\" name=\"country\" placeholder=\"Enter Country...\" /></td>
				</tr>
                                <tr>
                                        <td>State</td>
                                        <td>
                                            <select name =\"state\">
                                            " . get_us_state_select_options() . "
                                            </select>
                                        </td>" 
				. "<tr>
					<td>City</td>
					<td><input type=\"text\" name=\"city\" placeholder=\"Enter City...\" /></td>
				</tr>
				<tr>
					<td>Street</td>
					<td><input type=\"text\" name=\"street\" placeholder=\"Enter Street...\" /></td>
				</tr>
				<tr>
					<td>Zip</td>
					<td><input type=\"text\" name=\"zip\" placeholder=\"Enter Zip Code...\" /></td>
				</tr>
				<tr>
					<td>Phone</td>
					<td><input type=\"tel\" name=\"phone\" placeholder=\"Enter Phone Number...\" /></td>
				</tr>
				<tr>
					<td></td>
					<td><input type=\"submit\" name=\"submit\" value=\"Add Location\" /></td>
				</tr>
			</table>
                    </div>
                    ";
    return $frm;
}

function get_location_id($rest_id, $location_name, $location_addr) {
    $db = new db_connection; //init database connection obj.
    $link = $db->dblink(); //get copy of connected mysqli object.    
    
    //filter and escape input
    $id = $link->real_escape_string(filter_var($rest_id, FILTER_SANITIZE_NUMBER_INT));
    $name = $link->real_escape_string(filter_var($location_name, FILTER_SANITIZE_STRING));
    $addr = $link->real_escape_string(filter_var($location_addr, FILTER_SANITIZE_STRING));
    //prepare and execute sql statement
    $stmt = $link->prepare("SELECT location_id FROM location WHERE restaurant_id = ? AND name = ? AND CONCAT(street_addr, ' ', city, ', ', subdivision_code, ' ', zip) = ?");
    $stmt->bind_param('iss',$id,$name, $addr);
    $stmt->execute();
    $stmt->bind_result($loc_id);
    $stmt->fetch();
    return $loc_id;
}

function add_entree($loc_id, $name, $description, $price) {
    $db = new db_connection; //init database connection obj.
    $link = $db->dblink(); //get copy of connected mysqli object.    
    
    //filter and escape input
    $id = $link->real_escape_string(filter_var($loc_id, FILTER_SANITIZE_NUMBER_INT));
    $n = $link->real_escape_string(filter_var($name, FILTER_SANITIZE_STRING));    
    $desc = $link->real_escape_string(filter_var($description, FILTER_SANITIZE_STRING));    
    $p = $link->real_escape_string(filter_var($price, FILTER_SANITIZE_STRING));
    
    //prepare and execute sql statement
    $stmt = $link->prepare("INSERT INTO entree VALUES(NULL, ?, ?, ?, ?, NULL)");
    $stmt->bind_param('issd',$id, $n, $desc, $p);
    return $stmt->execute();
}

//Returns html select list option of restaurnt names for a given restaurant id
function get_restaurant_select_options($rest_id) {
    $db = new db_connection; //init database connection obj.
    $link = $db->dblink(); //get copy of connected mysqli object.
    
    //filter and escape input
    $id = $link->real_escape_string(filter_var($rest_id, FILTER_SANITIZE_STRING));
    
    //prepare and execute sql statement
    $stmt = $link->prepare("SELECT DISTINCT name FROM location WHERE restaurant_id = ?");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $qresult = $stmt->get_result();
    
    $s0 = "<option value=\"";
    $s1 = "\">";
    $s2 = "</option>";
    $options = "";
    
    while($row = $qresult->fetch_array(MYSQLI_NUM)) {
        $options .= $s0 . $row[0] . $s1 . $row[0] . $s2;
    }
    return $options;
}

//Returns html select list options for locations of a given restaurant id and name
function get_location_select_list_options($rest_id, $rest_name) {
    $db = new db_connection; //init database connection obj.
    $link = $db->dblink(); //get copy of connected mysqli object.
    
    //filter and escape input
    $id = $link->real_escape_string(filter_var($rest_id, FILTER_SANITIZE_STRING));    
    $name = $link->real_escape_string(filter_var($rest_name, FILTER_SANITIZE_STRING));
    
    //prepare and execute sql statement
    $stmt = $link->prepare("SELECT location_id, CONCAT(street_addr, ' ', city, ', ', subdivision_code, ' ', zip) FROM location WHERE restaurant_id = ? AND name = ?");
    $stmt->bind_param('is',$id, $name);
    $stmt->execute();
    $qresult = $stmt->get_result();
    
    $s0 = "<option value=\"";
    $s1 = "\">";
    $s2 = "</option>";
    $options = "";
    
    while($row = $qresult->fetch_array(MYSQLI_NUM)) {
        $options .= $s0 . $row[0] . $s1 . $row[1] . $s2;
    }
    return $options;    
}

function set_rest_id_cookie() {
    $id = get_id(filter_input(INPUT_COOKIE, 'user_id', FILTER_SANITIZE_NUMBER_INT), USER_TO_REST);
    return setcookie('rest_id', $id);    
}

//Returns an array of location addresses for a give restaurant id and name
function get_location_array($rest_id, $rest_name) {
    $db = new db_connection; //init database connection obj.
    $link = $db->dblink(); //get copy of connected mysqli object.
    
    //filter and escape input
    $id = $link->real_escape_string(filter_var($rest_id, FILTER_SANITIZE_NUMBER_INT));    
    $name = $link->real_escape_string(filter_var($rest_name, FILTER_SANITIZE_STRING));
    
    //prepare and execute sql statement
    $stmt = $link->prepare("SELECT * FROM location WHERE restaurant_id = ? AND name = ?");
    $stmt->bind_param('is',$id, $name);
    $stmt->execute();
    $qresult = $stmt->get_result();
    
    return $qresult->fetch_all(MYSQLI_ASSOC);
}

function get_menu_all_locs($rest_id) {
    $db = new db_connection; //init database connection obj.
    $link = $db->dblink(); //get copy of connected mysqli object.
    
    //filter and escape input
    $id = $link->real_escape_string(filter_var($rest_id, FILTER_SANITIZE_NUMBER_INT));
	
	//prepare and execute sql statement
	$stmt = $link->prepare("SELECT b.name as locname, a.name, a.description, a.price FROM entree AS a, location AS b WHERE a.location_id = b.location_id AND b.restaurant_id = ?");
	$stmt->bind_param('i',$id);
	$stmt->execute();
	return $stmt->get_result();
}
function get_user_info($username, $password) {
    $u = filter_var($username, FILTER_SANITIZE_STRING);
    $p = filter_var($password, FILTER_SANITIZE_STRING);
    if(!valid_user_login_credentials($u, $p)) {
        echo "Invalid user credentials. ";
        return FALSE;
    } else {
        $db = new db_connection;
        $link = $db->dblink();
        
        //escape input
        $uesc = $link->real_escape_string($u);
        
        //prepare and execute sql statement
        $stmt = $link->prepare("SELECT * FROM active_user_v WHERE user_name = ?");
        $stmt->bind_param('s',$uesc);
        if(!$stmt->execute()) {
            return FALSE;
        } else {
            $result = $stmt->get_result();
            return $result->fetch_array(MYSQLI_ASSOC);
        }
    }
}

function get_user_summary_table() {
    $db = new db_connection;
    $link = $db->dblink();
    
    $sql_str = "SELECT user_type AS Type, COUNT(user_name), MAX(reg_date) FROM user GROUP BY user_type";
    return $link->query($sql_str);
}

function get_entree_table() {
    $db = new db_connection;
    $link = $db->dblink();
    $sql_str = "SELECT * FROM entree";
    return $link->query($sql_str);
}
function get_location_table() {
    $db = new db_connection;
    $link = $db->dblink();
    $sql_str = "SELECT * FROM location";
    return $link->query($sql_str);    
}

function get_loc_entree_summary_table() {
    $db = new db_connection;
    $link = $db->dblink();
    $sql_str = "SELECT B.location_id, CONCAT(B.name,' - ', B.street_addr, ' ', B.city, ', ', B.subdivision_code, ' ', B.zip), COUNT(A.entree_id), AVG(A.price) FROM entree AS A, location AS B WHERE A.location_id = B.location_id GROUP BY B.location_id ORDER BY B.name";
    return $link->query($sql_str);    
}

function get_table_description($table_name) {
    $db = new db_connection;
    $link = $db->dblink();
    switch(filter_var($table_name, FILTER_SANITIZE_STRING)) {
        case 'location':
            return $link->query("DESCRIBE location");
        case 'entree':
            return $link->query("DESCRIBE entree");
    }
}
function get_min_locs_table($minval) {

    $v = filter_var($minval, FILTER_SANITIZE_STRING);
    if($v < 0) {
        echo "Minval cannot be less than 0.";
    } elseif($v > 99) {
        echo "Minval cannot be greater than 99.";
    } else {
        $db = new db_connection;
        $link = $db->dblink();
        $stmt = $link->prepare("SELECT USR.user_name, COUNT(LOC.location_id) FROM restaurant AS REST LEFT OUTER JOIN user as USR ON REST.user_id = USR.user_id LEFT OUTER JOIN location AS LOC ON LOC.restaurant_id = REST.restaurant_id GROUP BY REST.restaurant_id HAVING COUNT(LOC.location_id) >= ? ORDER BY COUNT(LOC.location_id) DESC");
        $vesc = $link->real_escape_string($v);
        $stmt->bind_param('i',$vesc);
        $stmt->execute();
        return $stmt->get_result();
    }   
}

function get_restaurant_id_list_has_locations() {
    $db = new db_connection;
    $link = $db->dblink();
    return $link->query("SELECT REST.restaurant_id FROM restaurant AS REST WHERE REST.restaurant_id IN (SELECT LOC.restaurant_id FROM location AS LOC)");
}

function get_loc_id_list_rest_id_only($restID) {
    $db = new db_connection;
    $link = $db->dblink();
    $rid = $link->real_escape_string(filter_var($restID, FILTER_SANITIZE_NUMBER_INT));
    $stmt = $link->prepare("SELECT LOC.location_id FROM location AS LOC, restaurant AS REST WHERE LOC.restaurant_id = REST.restaurant_id AND LOC.restaurant_id = ?");
    $stmt->bind_param('i',$rid);
    $stmt->execute();
    return $stmt->get_result();
}

function restaurant_id_name_list() {
    $db = new db_connection;
    $link = $db->dblink();
    return $link->query("SELECT REST.restaurant_id, USR.user_name FROM restaurant AS REST, user AS USR WHERE REST.user_id = USR.user_id");
}

function create_entree_view($locID) {
    $db = new db_connection;
    $link = $db->dblink();
    $loc_id = $link->real_escape_string(filter_var($locID, FILTER_SANITIZE_NUMBER_INT));
    $link->query("CREATE OR REPLACE VIEW user_generated_v AS SELECT * FROM entree WHERE location_id = " . $loc_id);
    return $link->query("SELECT * FROM user_generated_v");
}

function showCreateViewSQL() {
    $db = new db_connection;
    $link = $db->dblink();
    return $link->query("SHOW CREATE TABLE user_generated_v");
}
function get_tables() {
   $db = new db_connection;
    $link = $db->dblink();
    return $link->query("SHOW tables");    
}