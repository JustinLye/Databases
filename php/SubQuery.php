<?php

require_once('/home/jlye/.php/.dbc.php');
require_once('output_functs.php');
$db = new db_connection();
$link = $db->dblink();

$sql_str = "SELECT USR.user_name
            FROM user AS USR,(
                SELECT REST.user_id
                FROM restaurant AS REST
                WHERE REST.restaurant_id NOT IN (
                    SELECT LOC.restaurant_id
                    FROM location AS LOC
                    )
                ) AS NOLOC
            WHERE USR.user_id = NOLOC.user_id";
$sql_std = "SELECT USR.user_name\nFROM user AS USR,(\n    SELECT REST.user_id\n    FROM restaurant AS REST\n    WHERE REST.restaurant_id NOT IN (\n        SELECT LOC.restaurant_id\n        FROM location AS LOC\n        )\n    ) AS NOLOC\nWHERE USR.user_id = NOLOC.user_id";
$q = $link->query($sql_str);
echo util::to_html_table(array('Restaurant User W/O a Location'), $link->query($sql_str)) . '|' . $sql_std;


            
