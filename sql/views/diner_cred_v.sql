CREATE OR REPLACE VIEW diner_cred_v AS
SELECT usr.user_name AS "Diner Name", din.cred_lvl AS "Diner Credability" FROM diner AS din, user AS usr WHERE din.user_id = usr.user_id;