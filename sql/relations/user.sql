/* SQL command to create user relation */
CREATE TABLE user(
	user_id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	is_active BOOLEAN NOT NULL DEFAULT TRUE, /* this attribute was not in original ER diagram */
	reg_date DATETIME NOT NULL,
	last_login DATETIME NOT NULL,
	user_type ENUM('diner', 'restaurant') NOT NULL,
	user_name VARCHAR(32) NOT NULL,
	email VARCHAR(128) NOT NULL,
	password VARCHAR(32) NOT NULL, /* password attribute is more for illustration purposes only it is not intended to provide any real security. If I choose to make the password more secure I will likely use a high-level language */
	CONSTRAINT UNIQUE(user_name, email)); /* force unique combinations of user_name and email */
