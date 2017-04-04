CREATE VIEW image_v AS
SELECT a.image_id, b.image_source_dir, a.image_name
FROM image a, image_source b
WHERE a.image_source_id = b.image_source_id;