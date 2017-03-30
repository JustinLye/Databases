/* SQL command to create entree table */
CREATE TABLE entree(
	entree_id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	location_id INT UNSIGNED NOT NULL, /* Every entree has a location. If a restaurant has 3 locations that serve the same entree, then 3 instances of that entree are needed, one for each location */
	description VARCHAR(255) NOT NULL,
	CONSTRAINT FOREIGN KEY(location_id) REFERENCES location(location_id),
	CONSTRAINT UNIQUE(location_id, description)); /* the same location can not have two instances of the same entree */
