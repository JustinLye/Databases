CREATE TRIGGER user_add_t AFTER INSERT ON user
FOR EACH ROW
BEGIN
	IF NEW.user_type = 'diner' THEN
		INSERT INTO diner
		VALUES(NULL, NEW.user_id, 0);
	ELSEIF NEW.user_type = 'restaurant' THEN
		INSERT INTO restaurant
		VALUES (NULL, NEW.user_id);
	END IF;
END;
