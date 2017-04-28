<?php
//stuff for connecting to db
require_once('/home/jlye/.php/.dbc.php');
$db = new db_connection;
$link = $db->dblink();

//check if column exists
$q = $link->query("SELECT COUNT(COLUMN_NAME) FROM INFORMATION_SCHEMA.COLUMNS
    WHERE TABLE_SCHEMA = 'jlye' AND TABLE_NAME = 'entree' AND COLUMN_NAME = 'entree_class'");
$ccount = $q->fetch_array(MYSQLI_NUM);

//remove the entree_class column if it exist
if($ccount[0] > 0) {
    $link->query("ALTER TABLE entree DROP COLUMN entree_class");
}