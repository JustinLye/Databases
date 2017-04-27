<?php
require_once('/home/jlye/.php/.dbc.php');
$db = new db_connection;
$link = $db->dblink();
$q = $link->query("SELECT COUNT(TABLE_NAME) FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'jlye' AND TABLE_NAME = 'entree_class'");
$tcount = $q->fetch_array(MYSQLI_NUM);
if($tcount[0] <= 0) {
    $link->query("CREATE TABLE jlye.entree_class(
        id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(32) NOT NULL,
        CONSTRAINT UNIQUE(name));");
}


