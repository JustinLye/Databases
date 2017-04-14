<?php
    require_once('/home/jlye/.php/.dbc.php');
    require_once('output_functs.php');
       
    function restaurants_table() {
        $user_id = filter_input(INPUT_COOKIE, 'user_id', FILTER_SANITIZE_NUMBER_INT);
        if(!$user_id) {
            return false;
        }
        
        $db = new db_connection;
        $link = $db->dblink();
        $stmt = $link->prepare("SELECT loc.name, count(loc.name) FROM location as loc, restaurant as rest WHERE loc.restaurant_id = rest.restaurant_id AND rest.user_id = ? GROUP BY loc.name");
        $stmt->bind_param('i',$user_id);
        $stmt->execute();
        return util::to_html_table_chg_width(array('Restaurant Name', 'Locations (count)'), $stmt->get_result(), "35.0%");
    }
    
    function locations_table() {
        $user_id = filter_input(INPUT_COOKIE, 'user_id', FILTER_SANITIZE_NUMBER_INT);
        if(!$user_id) {
            return false;
        }
        $db = new db_connection();
        $link = $db->dblink();
        $stmt = $link->prepare("SELECT loc.name AS \"Restaurant Name\", CONCAT(loc.street_addr, ' ', loc.city, ', ', loc.state, ' ', loc.zip) AS \"Address\", loc.phone AS \"Phone\" from location AS loc, restaurant AS rest WHERE loc.restaurant_id = rest.restaurant_id AND rest.user_id = ? ORDER BY name, country, state, city, zip");
        $stmt->bind_param('i',$user_id);
        $stmt->execute();
        return util::to_html_table_chg_width(array('Restaurant Name', 'Address', 'Phone'), $stmt->get_result(), "35.0%");        
    }
?>