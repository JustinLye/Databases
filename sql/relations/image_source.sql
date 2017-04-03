CREATE TABLE image_source (
	image_source_id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	image_source_dir VARCHAR(255) NOT NULL,
	CONSTRAINT UNIQUE(image_source_dir));