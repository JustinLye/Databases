CREATE OR REPLACE VIEW active_diner_v AS
SELECT b.user_name, b.email, a.cred_lvl
FROM diner AS a, user AS b
WHERE a.user_id = b.user_id AND b.is_active = TRUE;