<?php
//db connection stuff
require_once('/home/jlye/.php/.dbc.php');
require_once('output_functs.php');
$db = new db_connection;
$link = $db->dblink();
$sql_str = "SELECT ACTION_STATEMENT FROM INFORMATION_SCHEMA.TRIGGERS WHERE TRIGGER_SCHEMA = 'jlye' AND TRIGGER_NAME = 'user_add_t'";
echo util::to_html_table(array('Trigger Action Statement'), $link->query($sql_str));