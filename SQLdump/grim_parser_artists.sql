CREATE TABLE artists
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

INSERT INTO grim_parser.artists (id, title, name, location, followers, musicians, tracks) VALUES (1, 'LAKEY INSPIRED', 'LAKEY', 'Los Angeles', 187665, 49, 19);
INSERT INTO grim_parser.artists (id, title, name, location, followers, musicians, tracks) VALUES (2, 'Birocratic', 'brandon r.', 'brooklyn, ny', 55600, 852, 164);
INSERT INTO grim_parser.artists (id, title, name, location, followers, musicians, tracks) VALUES (3, 'AK', 'Aljosha Konstanty', 'Kassel, Germany', 19264, 93, 195);
INSERT INTO grim_parser.artists (id, title, name, location, followers, musicians, tracks) VALUES (4, 'Dixxy', 'Alex  Dirks', 'Hamminkeln, Germany', 18969, 136, 68);
INSERT INTO grim_parser.artists (id, title, name, location, followers, musicians, tracks) VALUES (5, 'DeKobe', 'Julian Saavedra', 'Mississauga, Canada', 8738, 244, 66);
INSERT INTO grim_parser.artists (id, title, name, location, followers, musicians, tracks) VALUES (6, '☆LiL PEEP☆', 'unknown', 'unknown', 2423146, 0, 124);
INSERT INTO grim_parser.artists (id, title, name, location, followers, musicians, tracks) VALUES (7, 'PERTURBATOR', 'unknown', 'Nocturne City, France', 54386, 214, 77);