CREATE TRIGGER user_insert_check_t BEFORE INSERT ON user
FOR EACH ROW
BEGIN
	IF CHAR_LENGTH(NEW.user_name) <= 0 OR CHAR_LENGTH(NEW.email) <= 0 OR CHAR_LENGTH(NEW.password) < 60 THEN
		SET NEW.user_name = NULL;
	ELSE
		IF NEW.reg_date <= 0 THEN
			SET NEW.reg_date = NOW();
		END IF;
		IF NEW.last_login <= 0 THEN
			SET NEW.last_login = NOW();
		END IF;
	END IF;
END;