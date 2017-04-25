<?php
require_once('dbtools.php');
require_once('output_functs.php');

$result = get_restaurant_id_list_has_locations();
$str = "";
while($row = mysqli_fetch_array($result,MYSQLI_NUM)) {   
    $str .= "<option value=" . $row[0] . ">" . $row[0] . "</option>";
}
echo $str;