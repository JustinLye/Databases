/* SQL Command to create accepted_ticket relation */
CREATE TABLE accepted_ticket(
	accepted_ticket_id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	ticket_id INT UNSIGNED NOT NULL,
	accepted_date DATETIME NOT NULL, /* date the location accepted the ticket */
	promised_date DATETIME NOT NULL, /* date the location promises to delivery the ticket */
	delivered_date DATETIME NULL, /* date and time the food was delivered. */
	CONSTRAINT FOREIGN KEY(ticket_id) REFERENCES ticket(ticket_id));

/* Accepted (active/open) tickets are created after a location accepts a diners ticket. */
