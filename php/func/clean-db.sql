DELETE FROM image
    WHERE image.id NOT IN 
        (SELECT DISTINCT image FROM post)
    AND image.id NOT IN
        (SELECT DISTINCT picture FROM user)
    AND image.id != 0;
VACUUM;
