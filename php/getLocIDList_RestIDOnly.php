<?php
require_once('dbtools.php');
require_once('output_functs.php');
if(filter_input(INPUT_SERVER, 'REQUEST_METHOD', FILTER_SANITIZE_STRING) === 'POST') {
    if(($rid = filter_input(INPUT_POST, 'restID', FILTER_SANITIZE_NUMBER_INT)) === FALSE) {
        echo "POST variable 'restID' failed filter.";
    } elseif($rid === NULL) {
        echo "POST variable 'restID' is not set.";
    } else {
        $result = get_loc_id_list_rest_id_only($rid);
        $str = "";
        while($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
            $str .= "<option value=" . $row[0] . ">" . $row[0] . "</option>";
        }
        echo $str;
    }
}