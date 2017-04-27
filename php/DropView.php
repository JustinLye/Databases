<?php
require_once('/home/jlye/.php/.dbc.php');
if(filter_input(INPUT_SERVER, 'REQUEST_METHOD', FILTER_SANITIZE_STRING) === 'POST') {
    $db = new db_connection;
    $link = $db->dblink();
    $v = $link->real_escape_string(filter_input(INPUT_POST, 'viewName', FILTER_SANITIZE_STRING));
    $q = $link->prepare("SELECT COUNT(TABLE_NAME) FROM INFORMATION_SCHEMA.VIEWS WHERE TABLE_SCHEMA = 'jlye' AND TABLE_NAME = ?");
    
    $q->bind_param('s',$v);
    $q->execute();
    $result = $q->get_result();
    $r = $result->fetch_array(MYSQLI_NUM);
    
    if($r[0] > 0) {
        $link->query("DROP VIEW " . $v);
    }
}
