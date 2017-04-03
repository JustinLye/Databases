/* SQL command to create restaurant relation */
CREATE TABLE restaurant(
	restaurant_id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	user_id INT UNSIGNED NOT NULL,
	CONSTRAINT FOREIGN KEY(user_id) REFERENCES user(user_id) ON DELETE CASCADE); /* every restaurant is a user */
