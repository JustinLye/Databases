<?php
require_once('/home/jlye/.php/.dbc.php');
require_once('output_functs.php');
$db = new db_connection;
$link = $db->dblink();
echo util::to_html_table(array('View Name', 'View Definition'), $link->query("SELECT TABLE_NAME, VIEW_DEFINITION FROM INFORMATION_SCHEMA.VIEWS WHERE TABLE_SCHEMA = 'jlye'"));


