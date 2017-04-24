<?php
if(filter_input(INPUT_SERVER, 'REQUEST_METHOD', FILTER_SANITIZE_STRING) === "POST") { //make sure request was post method
    require_once('dbtools.php');
    $response_string = ""; //string used to responsed to the requester. Will be blank if successfull, otherwise will contain error message
    //Filter input variables
    if(($username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING)) === FALSE) {
        $response_string .= "POST variable 'username' failed filter. ";
    } elseif ($username === NULL) {
        $response_string .= "POST variable 'username' is not set. ";
    }
    if(($password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING)) === FALSE) {
        $response_string .= "POST variable 'password' failed filter. ";
    } elseif ($password === NULL) {
        $response_string .= "POST variable 'password' is not set. ";        
    }
    
    //Next check if the credentials provided are valid
    if(($ui = get_user_info($username, $password)) === FALSE) {
        $response_string .= " Failed to get user info. ";
    } else {
        //if the credentials provided are valid then set cookies
        setcookie('user_id', $ui['user_id']);
        setcookie('user_type', $ui['user_type']);
        setcookie('logged_out', "", time()-1);
        if($ui['user_type'] === 'diner') {
            setcookie('diner_id', get_id($ui['user_id'], USER_TO_DINER));
        } elseif($ui['user_type'] === 'restaurant') {
            setcookie('rest_id', get_id($ui['user_id'], USER_TO_REST));
        }
    }
}


