<?php
require_once('dbtools.php');
require_once('output_functs.php');
if(filter_input(INPUT_SERVER, 'REQUEST_METHOD', FILTER_SANITIZE_STRING) === 'POST') {
    if(($locID = filter_input(INPUT_POST, 'locID', FILTER_SANITIZE_NUMBER_INT)) === FALSE) {
        echo "POST variable 'locID' failed filter.";
    } elseif($locID === NULL) {
        echo "POST variable 'locID' is not set.";
    } else {
        echo util::to_html_table(array('Entree ID', 'Location ID', 'Entree Name', 'Entree Description', 'Price', 'Image ID'), create_entree_view($locID));
    }
}