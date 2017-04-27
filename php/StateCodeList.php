<?php
require_once('/home/jlye/.php/.dbc.php');
$db = new db_connection;
$link = $db->dblink();
$q = $link->query("SELECT subdivision_code, description FROM geolocations");
$str = "<select>";
while($r = $q->fetch_array(MYSQLI_NUM)) {
    $str .= "<option value=" . $r[0] . ">" . $r[1] . "</option>";
}
echo $str . "</select>";

