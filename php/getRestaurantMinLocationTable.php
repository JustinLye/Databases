<?php
require_once('dbtools.php');
require_once('output_functs.php');
if(filter_input(INPUT_SERVER,'REQUEST_METHOD',FILTER_SANITIZE_STRING)==='GET') {
    if(($minval = filter_input(INPUT_GET, 'minval', FILTER_SANITIZE_NUMBER_INT)) === FALSE) {
        echo "POST variable 'minval' failed filter";
    } elseif($minval === NULL) {
        echo "POST variable 'minval' is not set.";
    } else {
        echo util::to_html_table_chg_width(array('User Name', 'Location Count'), get_min_locs_table($minval), "35%");
    }
}