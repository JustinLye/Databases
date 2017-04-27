<?php
require_once('dbtools.php');
$q = restaurant_id_name_list();
$str = "<select>";
while($r = $q->fetch_array(MYSQLI_NUM)) {
    $str .= "<option value=" . $r[0] . ">" . $r[1] . "</option>";
}
echo $str . "</select>";