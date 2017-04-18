CREATE OR REPLACE VIEW diner_v AS
SELECT user_id AS "User ID", user_name AS "Diner Name" FROM user WHERE user_type = 'diner' AND email <> '';