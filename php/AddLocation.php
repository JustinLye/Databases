<?php
require_once('/home/jlye/.php/.dbc.php');
if(filter_input(INPUT_SERVER,'REQUEST_METHOD',FILTER_SANITIZE_STRING) === 'POST') {
    //obj. that provides connected mysqli obj.
    $db = new db_connection;
    $link = $db->dblink();
    //filter and escape post variables
    $restid = $link->real_escape_string(filter_input(INPUT_POST, 'restid',  FILTER_SANITIZE_NUMBER_INT));
    $name = $link->real_escape_string(filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING));
    $c = $link->real_escape_string(filter_input(INPUT_POST, 'country', FILTER_SANITIZE_STRING));
    $s = $link->real_escape_string(filter_input(INPUT_POST, 'state', FILTER_SANITIZE_STRING));
    $city = $link->real_escape_string(filter_input(INPUT_POST, 'city', FILTER_SANITIZE_STRING));
    $ad = $link->real_escape_string(filter_input(INPUT_POST, 'addr', FILTER_SANITIZE_STRING));
    $zip = $link->real_escape_string(filter_input(INPUT_POST, 'zip', FILTER_SANITIZE_STRING));
    $phone = $link->real_escape_string(filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING));
    //prepare and execute statement
    $stmt = $link->prepare("INSERT INTO location VALUES(NULL, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param('isssssss', $restid, $name, $c, $s, $city, $ad, $zip, $phone);
    $stmt->execute();
    echo $link->error;
}
