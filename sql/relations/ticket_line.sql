/* SQL command to create ticket_line relation */
/* NOTE - will need to use triggers or some other mechanism to ensure referential integrity.
   Mainly, will need make sure (entree_id, ticket.location_id) exists in entree_table
*/
CREATE TABLE ticket_line(
	ticket_line_id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	ticket_id INT UNSIGNED NOT NULL,
	line_num SHORTINT UNSIGNED NOT NULL,
	
	quantity SHORTINT UNSIGNED NOT NULL DEFAULT 1)

