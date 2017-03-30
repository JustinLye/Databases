/* SQL command to create diner relation */
CREATE TABLE diner(
	diner_id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	user_id INT UNSIGNED NOT NULL,
	cred_lvl INT UNSIGNED NOT NULL DEFAULT 0 /* every diner has a credit level that is related to a rating multiplier in the cred relation */,
	CONSTRAINT FOREIGN KEY(user_id) REFERENCES user(user_id)); /* every diner is an existing user */
