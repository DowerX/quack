--
-- Text encoding used: UTF-8
--
PRAGMA foreign_keys = off;
BEGIN TRANSACTION;

-- Table: auth
CREATE TABLE auth (
    user_id INTEGER REFERENCES login (id) 
                    UNIQUE
                    NOT NULL,
    cookie  STRING  UNIQUE
                    NOT NULL
);

-- Table: follow
CREATE TABLE follow (
    user_id   INTEGER REFERENCES login (id) 
                      NOT NULL,
    target_id INTEGER NOT NULL
                      REFERENCES login (id) 
);

-- Table: image
CREATE TABLE image (
    id   INTEGER PRIMARY KEY AUTOINCREMENT
                 NOT NULL
                 UNIQUE,
    data STRING  NOT NULL
);

-- Default profile picture
INSERT INTO image (
                      id,
                      data
                  )
                  VALUES (
                      0,
                      ' data:image/png;base64,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'
                  );

-- Table: likes
CREATE TABLE likes (
    post_id INTEGER REFERENCES post (id) 
                    NOT NULL,
    user_id INTEGER REFERENCES login (id) 
                    NOT NULL
);

-- Table: login
CREATE TABLE login (
    username STRING  UNIQUE
                     NOT NULL,
    password         NOT NULL,
    id       INTEGER PRIMARY KEY AUTOINCREMENT
                     UNIQUE
);

-- Table: post
CREATE TABLE post (
    id      INTEGER PRIMARY KEY AUTOINCREMENT
                    UNIQUE
                    NOT NULL,
    user_id INTEGER REFERENCES login (id) 
                    NOT NULL,
    content STRING,
    image   INTEGER REFERENCES image (id) 
);

-- Table: reply
CREATE TABLE reply (
    id      INTEGER PRIMARY KEY AUTOINCREMENT
                    UNIQUE
                    NOT NULL,
    user_id INTEGER REFERENCES login (id) 
                    NOT NULL,
    post_id INTEGER REFERENCES post (id) 
                    NOT NULL,
    content STRING  NOT NULL
);

-- Table: user
CREATE TABLE user (
    user_id INTEGER REFERENCES login (id) 
                    UNIQUE
                    NOT NULL,
    bio     STRING,
    name    STRING  NOT NULL,
    picture INTEGER NOT NULL
                    REFERENCES image (id) 
);

COMMIT TRANSACTION;
PRAGMA foreign_keys = on;