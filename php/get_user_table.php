
<?php
//This script returns a formatted user table

require_once('output_functs.php'); //For util functions
require_once('dbtools.php'); //Has connection and other utility functions
echo util::to_html_table(util::active_user_v_headings(), get_user_table());
?>