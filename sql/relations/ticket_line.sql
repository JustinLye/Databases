/* SQL command to create ticket_line relation */
/* NOTE - will need to use triggers or some other mechanism to ensure referential integrity.
   Mainly, will need make sure (entree_id, ticket.location_id) exists in entree_table
*/
CREATE TABLE ticket_line(
	ticket_line_id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	ticket_id INT UNSIGNED NOT NULL,
	line_num INT UNSIGNED NOT NULL,
	entree_id INT UNSIGNED NOT NULL,
	quantity INT UNSIGNED NOT NULL DEFAULT 1,
	CONSTRAINT FOREIGN KEY(ticket_id) REFERENCES ticket(ticket_id) ON DELETE CASCADE,
	CONSTRAINT FOREIGN KEY(entree_id) REFERENCES entree(entree_id) ON DELETE CASCADE);

