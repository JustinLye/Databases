<?php
//db connection stuff
require_once('/home/jlye/.php/.dbc.php');
//store request method
$rm = filter_input(INPUT_SERVER, 'REQUEST_METHOD', FILTER_SANITIZE_STRING);
$n = "";
//get the table name from requester
switch($rm) {
    case "GET":
        $n = filter_input(INPUT_GET, 'tableName', FILTER_SANITIZE_STRING);
        break;
    case "POST":
        $n = filter_input(INPUT_POST, 'tableName', FILTER_SANITIZE_STRING);
        break;
}

//db connection stuff
$db = new db_connection;
$link = $db->dblink();

//escape table name
$table_name = $link->real_escape_string($n);
$r = 0; //result we will bind to

//prepare and execute statement
$stmt = $link->prepare("SELECT TableExists(?)");
$stmt->bind_param('s',$table_name);
$stmt->execute();
$stmt->bind_result($r);
$stmt->fetch();
echo $r;

