<?php
//db connection stuff
require_once('/home/jlye/.php/.dbc.php');
require_once('output_functs.php');
$db = new db_connection;
$link = $db->dblink();

echo util::to_html_table(array('Restaurant ID','User ID'), $link->query("SELECT * FROM restaurant ORDER BY restaurant_id DESC"));