<?php
//db connection stuff
require_once('/home/jlye/.php/.dbc.php');
require_once('output_functs.php');
$db = new db_connection;
$link = $db->dblink();

echo util::to_html_table(array('Diner ID','User ID', 'Cred-Lvl'), $link->query("SELECT * FROM diner ORDER BY diner_id DESC"));