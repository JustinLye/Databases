<?php
require_once('/home/jlye/.php/.dbc.php');
require_once('output_functs.php');
$db = new db_connection;
$link = $db->dblink();
echo util::to_html_table(array('Table Name'), $link->query("SHOW TABLES"));