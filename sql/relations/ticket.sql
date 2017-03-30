/* SQL command to create ticket relation */
/* ticket == order (in ER diagram) */
CREATE TABLE ticket(
	ticket_id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	diner_id INT UNSIGNED NOT NULL, /* every order has a diner who created the order */
	location_id INT UNSIGNED NOT NULL, /* every order has a location that will fullfill the order */
	delivery_type ENUM('delivery','carryout') NOT NULL, /* every order is either delivery or carry out */
	creation_date DATETIME NOT NULL, /* date the diner created the order */
	requested_date DATETIME NOT NULL, /* date and time by which the diner would like to take delivery of the order */
	status ENUM('pending','accepted','completed', 'rejected') NOT NULL DEFAULT 'pending', /* every instance of a ticket will trigger creation of a pending_ticket. the location must accept or reject pending_tickets. The only valid update to status is from pending to accepted | rejected. */
	CONSTRAINT FOREIGN KEY(diner_id) REFERENCES diner(diner_id),
	CONSTRAINT FOREIGN KEY(location_id) REFERENCES location(location_id));

/* A ticket represnts an diner's request for food from a restaurant location. After a ticket is
   created it will trigger the creation of a pending_ticket. The location has the option to accept or reject a ticket.
   If accepted an accepted_ticket will be created, the pending_ticket is dropped, and the status is updated
   to accepted. If rejected the pending_ticket is dropped and the status is updated to rejected. */
