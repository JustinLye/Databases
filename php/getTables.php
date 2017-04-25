<?php
require_once('dbtools.php');
require_once('output_functs.php');
echo util::to_html_table_chg_width(array('Table Name'), get_tables(), "30%");