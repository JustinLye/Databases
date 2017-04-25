<?php
require_once('dbtools.php');
require_once('output_functs.php');
echo util::to_html_table(array('Location ID','Restaurant ID','Location Name', 'Country', 'State', 'City', 'Street', 'Zip', 'Phone'), get_location_table());