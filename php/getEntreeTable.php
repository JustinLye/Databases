<?php
require_once('dbtools.php');
require_once('output_functs.php');
echo util::to_html_table_chg_width(array('Entree ID', 'Location ID', 'Entree Name', 'Entree Description', 'Price', 'Image ID'), get_entree_table());