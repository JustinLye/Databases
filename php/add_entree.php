<?php
require_once('dbtools.php');
if(filter_input(INPUT_SERVER, 'REQUEST_METHOD', FILTER_SANITIZE_STRING) == "POST") {
    //get parameters
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
    $price = filter_input(INPUT_POST, 'price', FILTER_SANITIZE_NUMBER_FLOAT);
    $loc_id = filter_input(INPUT_POST, 'locid', FILTER_SANITIZE_NUMBER_INT);
    
    echo add_entree($loc_id, $name, $description, $price);
}