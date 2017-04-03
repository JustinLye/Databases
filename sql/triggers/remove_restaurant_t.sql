CREATE TRIGGER remove_restaurant_t AFTER DELETE ON restaurant
FOR EACH ROW
BEGIN
	DELETE FROM user WHERE user_id = OLD.user_id;
END;
