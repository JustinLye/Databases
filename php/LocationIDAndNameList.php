<?php
require_once('/home/jlye/.php/.dbc.php');
$db = new db_connection;
$link = $db->dblink();

$q = $link->query("SELECT restaurant_id, location_id, CONCAT(name,' - ', street_addr, ' ', city, ', ', subdivision_code, ' ', zip) FROM location ORDER BY restaurant_id, name, subdivision_code, city, zip, street_addr");
echo $link->error;
$str = "<select>";
while($r = $q->fetch_array(MYSQLI_NUM)) {
    $str .= "<option value=\"" . ($r[0] . ', ' . $r[1]) . "\">" . $r[2] . "</option>";
}
echo $str . "</select>";