<?php
require_once('/home/jlye/.php/.dbc.php');
$db = new db_connection;
$link = $db->dblink();
$q = $link->query("SELECT COUNT(TABLE_NAME) FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'jlye' AND TABLE_NAME = 'entree_class'");
$tcount = $q->fetch_array(MYSQLI_NUM);
if($tcount[0] > 0) {
    $link->query("DROP TABLE entree_class");
}


