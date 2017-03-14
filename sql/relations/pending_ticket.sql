/* SQL command to create pending_ticket relation */
CREATE TABLE pending_ticket(
	pending_ticket_id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	ticket_id INT UNSIGNED NOT NULL,
	CONSTRAINT FOREIGN KEY(ticket_id) REFERENCES ticket(ticket_id));

