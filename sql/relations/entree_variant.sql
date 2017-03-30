/* SQL command to created entree_variant */
CREATE TABLE entree_variant(
	entree_variant_id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	entree_id INT UNSIGNED NOT NULL,
	entree_size VARCHAR(20) NOT NULL,
	price DECIMAL(6,2) NOT NULL,
	delivery_time_estimate SMALLINT UNSIGNED NULL,
	CONSTRAINT FOREIGN KEY(entree_id) REFERENCES entree(entree_id));
