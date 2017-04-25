<?php
require_once('dbtools.php');
require_once('output_functs.php');
//check if request method is post
if(filter_input(INPUT_SERVER, 'REQUEST_METHOD', FILTER_SANITIZE_STRING) === 'POST') {
    //get post variable 'table_name'
    if(($table_name = filter_input(INPUT_POST, 'table_name', FILTER_SANITIZE_STRING)) === FALSE) {
        echo "POST variable 'table_name' failed filter.";
    } elseif($table_name === NULL) {
        echo "POST variable 'table_name' is not set.";
    } else {
        echo util::to_html_table(array('Field', 'Type', 'Null', 'Key', 'Default', 'Extra'), get_table_description($table_name));
    }
}