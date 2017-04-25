<?php
require_once('dbtools.php');
require_once('output_functs.php');
echo util::to_html_table(array('Location ID', 'Location', 'Entree Count', 'Avg. Entree Price'), get_loc_entree_summary_table());