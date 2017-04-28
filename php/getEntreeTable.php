<?php
require_once('/home/jlye/.php/.dbc.php');
require_once('output_functs.php');
$db = new db_connection;
$link = $db->dblink();
$sql_str = "SELECT * FROM entree";
$h = array('Entree ID', 'Location ID', 'Entree Name', 'Entree Description', 'Price', 'Image ID');
$q = $link->query($sql_str);
echo $link->error;
if($q->field_count == 7) {
    array_push($h, 'Entree Class');
}
echo $link->error;
echo util::to_html_table($h,$q);