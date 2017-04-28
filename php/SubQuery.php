<?php

require_once('/home/jlye/.php/.dbc.php');
require_once('output_functs.php');
$db = new db_connection();
$link = $db->dblink();

$sql_str = "SELECT USR.user_name FROM user AS USR WHERE USR.user_id IN (SELECT REST.user_id FROM restaurant AS REST WHERE REST.restaurant_id NOT IN (SELECT LOC.restaurant_id FROM location AS LOC))";
$q = $link->query($sql_str);
echo util::to_html_table(array('Restaurant User W/O a Location'), $link->query($sql_str)) . '|' . $sql_str;


            
