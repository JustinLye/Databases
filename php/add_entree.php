<?php
require_once('dbtools.php');
if(filter_input(INPUT_SERVER, 'REQUEST_METHOD', FILTER_SANITIZE_STRING) == "POST") {
    //need to get the location id
    $rest_id = filter_input(INPUT_COOKIE, 'rest_id', FILTER_SANITIZE_NUMBER_INT);
    $locaddr = filter_input(INPUT_POST, 'locaddr', FILTER_SANITIZE_STRING);
    $locname = filter_input(INPUT_POST, 'locname', FILTER_SANITIZE_STRING);
    $loc_id = get_location_id($rest_id, $locname, $locaddr); //lookup location id
    
    //get the remaining parameters
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
    $price = filter_input(INPUT_POST, 'price', FILTER_SANITIZE_NUMBER_FLOAT);
    
    echo add_entree($loc_id, $name, $description, $price);
}