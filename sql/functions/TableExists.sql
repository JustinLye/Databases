CREATE FUNCTION TableExists (n VARCHAR(64))
	RETURNS INT
	BEGIN
		DECLARE c INT;
		SET c = (SELECT COUNT(TABLE_NAME) FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_NAME=n AND TABLE_SCHEMA = 'jlye');
		IF c <= 0 THEN
			RETURN 0;
		ELSE
			RETURN 1;
		END IF;
	END;
