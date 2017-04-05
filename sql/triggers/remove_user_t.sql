CREATE TRIGGER remove_user_t BEFORE DELETE ON user
FOR EACH ROW
BEGIN
	IF OLD.user_type = 'diner' THEN
		DELETE FROM diner WHERE user_id = OLD.user_id;
	ELSEIF OLD.user_type = 'restaurant' THEN
		DELETE FROM restaurant WHERE user_id = OLD.user_id;
	END IF;
END;