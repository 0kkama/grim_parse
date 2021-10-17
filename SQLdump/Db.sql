CREATE SCHEMA grim_parser COLLATE utf8mb4_0900_ai_ci;

CREATE TABLE IF NOT EXISTS artists
(
    id        int UNSIGNED AUTO_INCREMENT
        PRIMARY KEY,
    title     varchar(256) NOT NULL,
    name      varchar(256) NULL,
    location  varchar(256) NULL,
    followers int          NOT NULL,
    musicians int          NOT NULL,
    tracks    int          NOT NULL,
    CONSTRAINT artist_title_uindex
        UNIQUE (title)
)
    COLLATE = utf8mb4_0900_as_cs;

CREATE TABLE IF NOT EXISTS tracks
(
    id        int UNSIGNED AUTO_INCREMENT
        PRIMARY KEY,
    title     varchar(256) NOT NULL,
    tag       varchar(256) NULL,
    plays     int          NOT NULL,
    comments  int          NOT NULL,
    duration  varchar(256) NULL,
    artist_id int UNSIGNED NOT NULL
)
    COLLATE = utf8mb4_0900_as_cs;

CREATE INDEX tracks__index
    ON tracks (title);