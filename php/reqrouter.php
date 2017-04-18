<?php
require_once('dbtools.php');
define('SELOPT_LOCATION',1);
define('SELOPT_RESTAURANT', 2);
define('SELOPT_USERTYPE', 3);
define('ASSOCARRAY_LOCATION', 4);
define('GETID_USER_TO_REST', 5);
define('SELOPT_RESTAURANT_USE_COOKIE', 6);
define('TASK_ADD_ENTREE', 8);
define('USE_COOKIE', 7);
//switch on request method
switch(filter_input(INPUT_SERVER, 'REQUEST_METHOD', FILTER_SANITIZE_STRING)) {
    case "POST":
        switch(filter_input(INPUT_POST, 'task', FILTER_SANITIZE_NUMBER_INT)) { //switch on requested task
            case SELOPT_LOCATION:
                //output location select list options for given restaurant id and name
                echo get_location_select_list_options(filter_input(INPUT_COOKIE,'rest_id', FILTER_SANITIZE_NUMBER_INT),filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING));
                break;
            case SELOPT_RESTAURANT:
                //output restaurant select list options for given restaurant id
                echo get_restaurant_select_options(filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT));
                break;
            case SELOPT_RESTAURANT_USE_COOKIE:
                //output restaurant select list options for given restaurant id stored in cookie 'rest_id'
                echo get_restaurant_select_options(filter_input(INPUT_COOKIE, 'rest_id', FILTER_SANITIZE_NUMBER_INT));
                break;
            case SELOPT_USERTYPE:
                //output user type select list options
                echo get_user_types_select_options();
                break;
            case TASK_ADD_ENTREE:
                echo add_entree(filter_input(INPUT_COOKIE,'rest_id', FILTER_SANITIZE_NUMBER_INT),
                        filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING),
                        filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING),
                        filter_input(INPUT_POST, 'price', FILTER_SANITIZE_NUMBER_FLOAT));
                break;
        }
        break;
    case "GET":
        switch(filter_input(INPUT_GET, 'task', FILTER_SANITIZE_NUMBER_INT)) {
            case GETID_USER_TO_REST:
                set_rest_id_cookie();
                break;
            case SELOPT_RESTAURANT_USE_COOKIE:
                //output restaurant select list options for given restaurant id stored in cookie 'rest_id'
                echo get_restaurant_select_options(filter_input(INPUT_COOKIE, 'rest_id', FILTER_SANITIZE_NUMBER_INT));   
                break;
        }
}