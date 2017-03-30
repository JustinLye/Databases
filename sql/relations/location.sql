/* SQL command to create location relation */
CREATE TABLE location(
	location_id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	restaurant_id INT UNSIGNED NOT NULL, /* every location is a restaurant */
	country VARCHAR(32) NOT NULL,
	state VARCHAR(32) NOT NULL,
	city VARCHAR(32) NOT NULL,
	street_addr VARCHAR(128) NOT NULL,
	zip VARCHAR(16) NOT NULL,
	phone CHAR(10));

