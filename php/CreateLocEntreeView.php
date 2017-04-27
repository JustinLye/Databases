<?php
require_once('/home/jlye/.php/.dbc.php');
require_once('output_functs.php');
if(filter_input(INPUT_SERVER, 'REQUEST_METHOD', FILTER_SANITIZE_STRING) === 'POST') {
    if(($locID = filter_input(INPUT_POST, 'locID', FILTER_SANITIZE_STRING)) === FALSE) {
        echo "POST variable 'locID' failed filter.";
    } elseif($locID === NULL) {
        echo "POST variable 'locID' is not set.";
    } else {
        $db = new db_connection;
        $link = $db->dblink();
        $lid = $link->real_escape_string($locID);
        $str = "CREATE OR REPLACE VIEW user_generate2_v AS 
            SELECT ENTR.location_id, LOC.name AS locname, ENTR.name AS entrname, ENTR.description, ENTR.price FROM entree AS ENTR, location AS LOC 
            WHERE ENTR.location_id = LOC.location_id AND ENTR.location_id = " . $lid;
        $link->query($str);
        echo $link->error;
        echo util::to_html_table(array('Location ID', 'Location Name', 'Entree Name', 'Entree Description', 'Price'), $link->query("SELECT * FROM user_generate2_v"));
    }
}