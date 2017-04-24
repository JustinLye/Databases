<?php
require_once("dbtools.php"); //includes connection to database and other functions
//The first step will be to check if the request was made in post mode
if(filter_input(INPUT_SERVER, 'REQUEST_METHOD', FILTER_SANITIZE_STRING) === "POST") {
    $response_string = ""; //This string is sent back to the requester. If blank everything went ok. If not the string will have info related to the error.
    //Next we will ensure all input is valid
    //filter name
    if(($name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING)) === FALSE) {
        $response_string .= "ERROR: POST variable 'name' failed filter.\n";
    } elseif($name === NULL) {
        $response_string .= "ERROR: POST variable 'name' is not set.\n";
    }
    //filter type
    if(($type = filter_input(INPUT_POST, 'type', FILTER_SANITIZE_STRING)) === FALSE) {
        $response_string .= "ERROR: POST variable 'type' failed filter.\n";
    } elseif($type === NULL) {
        $response_string .= "ERROR: POST variable 'type' is not set.\n";
    }
    //filter email (as string not concerned with validity of addresses)
    if(($email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING)) === FALSE) {
        $response_string .= "ERROR: POST variable 'email' failed filter.\n";
    } elseif($email === NULL) {
        $response_string .= "ERROR: POST variable 'email' is not set.\n";
    }
    //filter password
    if(($password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING)) === FALSE) {
        $response_string .= "ERROR: POST variable 'password' failed filter.\n";
    } elseif($password === NULL) {
        $response_string .= "ERROR: POST variable 'password' is not set.\n";
    }
    
    //after we have filter the input, check the response string. If it is not blank the some problem has
    //been detected in the input.
    if($response_string !== "") {
        //at this point we can go ahead and send a response to the requester
        echo $response_string;
    } else {
        //if no problems are encountered then we can attempt to sign-up using the function sign_up() in dbtools.php 
        if(!sign_up($name, $type, $email, $password)) {
            $response_string .= "ERROR: User could not be inserted.";
        }
        //send the final response to the requester. If no problems or failures occurred then the response should be blank
        echo $response_string;
    }
}
?>