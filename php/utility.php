<?php

function to_html_table($headings, $data) {
	echo '<div class="tbl_data">';
	echo '<table>';
	echo '<tr>';
	foreach($headings as $h) {
		echo '<th>' . $h . '</th>';
	}
	echo '</tr>';
	while($r = mysqli_fetch_array($data, MYSQLI_ASSOC)) {
		echo '<tr>';
		foreach($r as $info) {
			echo '<td>' . $info . '</td>';
		}
		echo '</tr>';
	}
	echo '</table>';
	echo '</div>';
}

?>