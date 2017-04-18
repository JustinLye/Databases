CREATE TABLE geolocations(
	geoloc_id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	country_code CHAR(2) NOT NULL,
	subdivision_code VARCHAR(3) NOT NULL,
	description VARCHAR(32) NOT NULL,
	CONSTRAINT UNIQUE(country_code, subdivision_code));