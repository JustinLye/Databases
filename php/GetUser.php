<?php
//include some utility files
require_once('/home/jlye/.php/.dbc.php');
require_once('output_functs.php');

//echo if method is POST
if(filter_input(INPUT_SERVER, 'REQUEST_METHOD', FILTER_SANITIZE_STRING) === "POST") {
    //db connection stuff
    $db = new db_connection;
    $link = $db->dblink();
    
    //escape input -- no time for further input eval.
    $name = $link->real_escape_string("%" . filter_input(INPUT_POST,'name',FILTER_SANITIZE_STRING) . "%");
            //prepare and execute
    $sql_str = "SELECT user_id, is_active, reg_date, last_login, user_type, user_name, email FROM user WHERE user_name LIKE ?";
    $stmt = $link->prepare($sql_str);
    $stmt->bind_param('s',$name);
    $stmt->execute();
    $r = $stmt->get_result();
    echo util::to_html_table(array('User ID', 'Is Active', 'Registration Date', 'Last Login', 'Type', 'Name', 'Email'), $r);
}