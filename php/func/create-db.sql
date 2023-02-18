CREATE TABLE login (
    username STRING  UNIQUE
                     NOT NULL,
    password         NOT NULL,
    id       INTEGER PRIMARY KEY AUTOINCREMENT
                     UNIQUE
);

CREATE TABLE auth (
    user_id INTEGER REFERENCES login (id) 
                    UNIQUE
                    NOT NULL,
    cookie  STRING  UNIQUE
                    NOT NULL
);

CREATE TABLE follow (
    user_id   INTEGER REFERENCES login (id) 
                      NOT NULL,
    target_id INTEGER NOT NULL
                      REFERENCES login (id) 
);

CREATE TABLE post (
    id      INTEGER PRIMARY KEY AUTOINCREMENT
                    UNIQUE
                    NOT NULL,
    user_id INTEGER REFERENCES login (id) 
                    NOT NULL,
    content STRING,
    image   STRING
);

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

CREATE TABLE likes (
    post_id INTEGER REFERENCES post (id) 
                    NOT NULL,
    user_id INTEGER REFERENCES login (id) 
                    NOT NULL
);

CREATE TABLE user (
    user_id INTEGER REFERENCES login (id) 
                    UNIQUE
                    NOT NULL,
    bio     STRING,
    name    STRING  NOT NULL
);