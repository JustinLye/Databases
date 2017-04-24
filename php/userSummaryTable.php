<?php
require_once('dbtools.php');
require_once('output_functs.php');
echo util::to_html_table_chg_width(array('User Type', 'Total Num of Users of Same Type', 'Most Recent User to Sign Up of Same Type'), get_user_summary_table(), "50%");