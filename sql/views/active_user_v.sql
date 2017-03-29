CREATE VIEW active_user_v AS
SELECT user_id, user_name, email, user_type, reg_date, last_login
FROM user
WHERE is_active = TRUE;