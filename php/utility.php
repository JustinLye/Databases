<?php
<<<<<<< HEAD
namespace grub;
function to_html_table($headings, $data) {

	echo '<div class="tbl_data">' . "\n";
	echo "\t" . '<table>' . "\n";
	echo "\t\t" . '<tr>' . "\n";
	foreach($headings as $h) {
		echo "\t\t\t" . '<th>' . $h . '</th>' . "\n";
	}
	echo "\t\t" . '</tr>' . "\n";
	while($r = mysqli_fetch_array($data, MYSQLI_ASSOC)) {
		echo "\t\t" . '<tr>' . "\n";
		foreach($r as $info) {
			echo "\t\t\t" . '<td>' . $info . '</td>' . "\n";
		}
		echo "\t\t" . '</tr>' . "\n";
	}
	echo "\t" . '</table>' . "\n";
	echo '</div>' . "\n";
}

require_once('../../../php/connect.php');

=======

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

>>>>>>> 51d7a810bd049918835a7f77a4eb791693f83f92
?>