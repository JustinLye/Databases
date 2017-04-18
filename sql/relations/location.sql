/* SQL command to create location relation */
CREATE TABLE location(
	location_id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	restaurant_id INT UNSIGNED NOT NULL, /* every location is a restaurant */
	name VARCHAR(128) NOT NULL,
	country_code CHAR(2) NOT NULL,
	subdivision_code VARCHAR(3) NOT NULL,
	city VARCHAR(32) NOT NULL,
	street_addr VARCHAR(128) NOT NULL,
	zip VARCHAR(16) NOT NULL,
	phone CHAR(10) NOT NULL,
	CONSTRAINT FOREIGN KEY(restaurant_id) REFERENCES restaurant(restaurant_id) ON DELETE CASCADE,
	CONSTRAINT FOREIGN KEY(country_code, subdivision_code) REFERENCES geolocations(country_code, subdivision_code) ON UPDATE CASCADE,
	CONSTRAINT UNIQUE(restaurant_id, name, country_code, subdivision_code, city, street_addr, zip));

