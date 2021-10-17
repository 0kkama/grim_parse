CREATE TABLE tracks
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

INSERT INTO grim_parser.tracks (id, title, tag, plays, comments, duration, artist_id) VALUES (1, 'Arcade', 'Electronic', 1286316, 996, null, 1);
INSERT INTO grim_parser.tracks (id, title, tag, plays, comments, duration, artist_id) VALUES (2, 'By The Pool', 'Electronic', 913387, 543, null, 1);
INSERT INTO grim_parser.tracks (id, title, tag, plays, comments, duration, artist_id) VALUES (3, 'Overjoyed', 'unknown', 1712386, 1171, null, 1);
INSERT INTO grim_parser.tracks (id, title, tag, plays, comments, duration, artist_id) VALUES (4, 'In My Clouds', 'Electronic', 944156, 1150, null, 1);
INSERT INTO grim_parser.tracks (id, title, tag, plays, comments, duration, artist_id) VALUES (5, 'Visions', 'Electronic', 608032, 264, null, 1);
INSERT INTO grim_parser.tracks (id, title, tag, plays, comments, duration, artist_id) VALUES (6, 'This Feeling', 'Electronic', 1124625, 906, null, 1);
INSERT INTO grim_parser.tracks (id, title, tag, plays, comments, duration, artist_id) VALUES (7, 'Blue Boi', 'unknown', 2471512, 2069, null, 1);
INSERT INTO grim_parser.tracks (id, title, tag, plays, comments, duration, artist_id) VALUES (8, 'Doing Just Fine', 'Electronic', 725958, 881, null, 1);
INSERT INTO grim_parser.tracks (id, title, tag, plays, comments, duration, artist_id) VALUES (9, 'Me 2 (Feat. Julian Avila)', 'Electronic', 1238050, 591, null, 1);
INSERT INTO grim_parser.tracks (id, title, tag, plays, comments, duration, artist_id) VALUES (10, 'I Found Me', 'Hip-hop & Rap', 991591, 677, null, 1);
INSERT INTO grim_parser.tracks (id, title, tag, plays, comments, duration, artist_id) VALUES (11, 'Theme from Dissect S8', 'Hip Hop/Rap', 2549, 6, null, 2);
INSERT INTO grim_parser.tracks (id, title, tag, plays, comments, duration, artist_id) VALUES (12, 'Theme from Dissect S6', 'Dance', 4996, 5, null, 2);
INSERT INTO grim_parser.tracks (id, title, tag, plays, comments, duration, artist_id) VALUES (13, 'Theme from Dissect S5', 'Dance', 4027, 2, null, 2);
INSERT INTO grim_parser.tracks (id, title, tag, plays, comments, duration, artist_id) VALUES (14, 'birocratic''s ingredients - splice sample pack (out now)', 'spice', 20032, 12, null, 2);
INSERT INTO grim_parser.tracks (id, title, tag, plays, comments, duration, artist_id) VALUES (15, 'belly breathing', 'chillhop', 189637, 69, null, 2);
INSERT INTO grim_parser.tracks (id, title, tag, plays, comments, duration, artist_id) VALUES (16, 'birocratic band - live at brooklyn bowl 9-15-2018', 'fresh bops', 18508, 33, null, 2);
INSERT INTO grim_parser.tracks (id, title, tag, plays, comments, duration, artist_id) VALUES (17, 'keep me satisfied', 'futurefunk', 69224, 33, null, 2);
INSERT INTO grim_parser.tracks (id, title, tag, plays, comments, duration, artist_id) VALUES (18, 'Akinyemi & Birocratic - Dream On', 'alternative rap', 42191, 25, null, 2);
INSERT INTO grim_parser.tracks (id, title, tag, plays, comments, duration, artist_id) VALUES (19, 'Birocratic - Shakedown', 'chillhop', 132255, 49, null, 2);
INSERT INTO grim_parser.tracks (id, title, tag, plays, comments, duration, artist_id) VALUES (20, 'Akinyemi & Birocratic - Time', 'Hip-hop & Rap', 46055, 38, null, 2);
INSERT INTO grim_parser.tracks (id, title, tag, plays, comments, duration, artist_id) VALUES (21, 'Zesty Surprise', 'Less Gunk, More Funk', 359852, 147, null, 2);
INSERT INTO grim_parser.tracks (id, title, tag, plays, comments, duration, artist_id) VALUES (22, 'Birocratic - Handsome People', 'chillhop', 197721, 80, null, 2);
INSERT INTO grim_parser.tracks (id, title, tag, plays, comments, duration, artist_id) VALUES (23, 'Extra Fresh', 'Earhole Cleanse', 418033, 145, null, 2);
INSERT INTO grim_parser.tracks (id, title, tag, plays, comments, duration, artist_id) VALUES (24, 'At Most', 'chillhop', 154353, 32, null, 2);
INSERT INTO grim_parser.tracks (id, title, tag, plays, comments, duration, artist_id) VALUES (25, 'Birocratic - Boys'' Bop', 'bop', 150371, 63, null, 2);
INSERT INTO grim_parser.tracks (id, title, tag, plays, comments, duration, artist_id) VALUES (26, 'GriZ - Driftin'' (Birocratic Remix)', 'slap', 56397, 13, null, 2);
INSERT INTO grim_parser.tracks (id, title, tag, plays, comments, duration, artist_id) VALUES (27, 'chloe [flipped from a fan suggestion]', 'Hip-hop & Rap', 32910, 16, null, 2);
INSERT INTO grim_parser.tracks (id, title, tag, plays, comments, duration, artist_id) VALUES (28, 'Hackeysack', 'Funk', 92467, 33, null, 2);
INSERT INTO grim_parser.tracks (id, title, tag, plays, comments, duration, artist_id) VALUES (29, 'Bleary Eyes', 'lofi hip hop', 40739, 8, null, 2);
INSERT INTO grim_parser.tracks (id, title, tag, plays, comments, duration, artist_id) VALUES (30, 'Lovely Rita', 'chillhop', 73446, 15, null, 2);
INSERT INTO grim_parser.tracks (id, title, tag, plays, comments, duration, artist_id) VALUES (31, 'Sophisticated Gentleman', 'chillhop', 60639, 7, null, 2);
INSERT INTO grim_parser.tracks (id, title, tag, plays, comments, duration, artist_id) VALUES (32, 'AK & Dario Lessing - No More Worries', 'Ambient', 4743, 5, null, 3);
INSERT INTO grim_parser.tracks (id, title, tag, plays, comments, duration, artist_id) VALUES (33, 'AK & Dario Lessing - Again And Again', 'Ambient', 4961, 5, null, 3);
INSERT INTO grim_parser.tracks (id, title, tag, plays, comments, duration, artist_id) VALUES (34, 'AK & Dario Lessing - All You Need Is Time', 'Ambient', 7742, 5, null, 3);
INSERT INTO grim_parser.tracks (id, title, tag, plays, comments, duration, artist_id) VALUES (35, 'AK & Liam Thomas - Neuanfang', 'Ambient', 15273, 48, null, 3);
INSERT INTO grim_parser.tracks (id, title, tag, plays, comments, duration, artist_id) VALUES (36, 'AK - Just A Dream', 'Ambient', 7642, 12, null, 3);
INSERT INTO grim_parser.tracks (id, title, tag, plays, comments, duration, artist_id) VALUES (37, 'AK - Come Together', 'Ambient', 5330, 9, null, 3);
INSERT INTO grim_parser.tracks (id, title, tag, plays, comments, duration, artist_id) VALUES (38, 'keep moving', 'dixxy', 558, 1, null, 4);
INSERT INTO grim_parser.tracks (id, title, tag, plays, comments, duration, artist_id) VALUES (39, 'Wonder', 'dixxy', 3154, 6, null, 4);
INSERT INTO grim_parser.tracks (id, title, tag, plays, comments, duration, artist_id) VALUES (40, 'give me an answer', 'dixxy', 3432, 1, null, 4);
INSERT INTO grim_parser.tracks (id, title, tag, plays, comments, duration, artist_id) VALUES (41, 'space taxi', 'dixxy', 12554, 12, null, 4);
INSERT INTO grim_parser.tracks (id, title, tag, plays, comments, duration, artist_id) VALUES (42, 'wanderlust', 'dixxy', 16625, 7, null, 4);
INSERT INTO grim_parser.tracks (id, title, tag, plays, comments, duration, artist_id) VALUES (43, 'evening stroll', 'dixxy', 9362, 5, null, 4);
INSERT INTO grim_parser.tracks (id, title, tag, plays, comments, duration, artist_id) VALUES (44, 'sorry baby', 'dixxy', 16082, 5, null, 4);
INSERT INTO grim_parser.tracks (id, title, tag, plays, comments, duration, artist_id) VALUES (45, 'bumpin''', 'dixxy', 8166, 1, null, 4);
INSERT INTO grim_parser.tracks (id, title, tag, plays, comments, duration, artist_id) VALUES (46, 'fly away (w juju b. goode)', 'fly', 11455, 7, null, 4);
INSERT INTO grim_parser.tracks (id, title, tag, plays, comments, duration, artist_id) VALUES (47, 'lose control', 'dixxy', 4871, 3, null, 4);
INSERT INTO grim_parser.tracks (id, title, tag, plays, comments, duration, artist_id) VALUES (48, 'Besame', 'Beats', 6762, 19, null, 5);
INSERT INTO grim_parser.tracks (id, title, tag, plays, comments, duration, artist_id) VALUES (49, 'Dindi', 'Beats', 8410, 25, null, 5);
INSERT INTO grim_parser.tracks (id, title, tag, plays, comments, duration, artist_id) VALUES (50, 'Cicada', 'Hip-hop & Rap', 8008, 15, null, 5);
INSERT INTO grim_parser.tracks (id, title, tag, plays, comments, duration, artist_id) VALUES (51, 'Foreigner', 'Beats', 17463, 19, null, 5);
INSERT INTO grim_parser.tracks (id, title, tag, plays, comments, duration, artist_id) VALUES (52, 'Sunset in Batanes', 'DeKobe', 13762, 14, null, 5);
INSERT INTO grim_parser.tracks (id, title, tag, plays, comments, duration, artist_id) VALUES (53, 'Travelling', 'DeKobe', 23359, 12, null, 5);
INSERT INTO grim_parser.tracks (id, title, tag, plays, comments, duration, artist_id) VALUES (54, 'Dream', 'Beats', 19013, 13, null, 5);
INSERT INTO grim_parser.tracks (id, title, tag, plays, comments, duration, artist_id) VALUES (55, 'Concentrate', 'Beats', 8494, 4, null, 5);
INSERT INTO grim_parser.tracks (id, title, tag, plays, comments, duration, artist_id) VALUES (56, 'Autumn In New York', 'Beats', 18636, 6, null, 5);
INSERT INTO grim_parser.tracks (id, title, tag, plays, comments, duration, artist_id) VALUES (57, 'Night Drive', 'Beats', 7512, 2, null, 5);
INSERT INTO grim_parser.tracks (id, title, tag, plays, comments, duration, artist_id) VALUES (58, 'your favorite dress (w/ Lil Tracy)', 'Hip-hop & Rap', 1168299, 880, null, 6);
INSERT INTO grim_parser.tracks (id, title, tag, plays, comments, duration, artist_id) VALUES (59, 'past the castle walls(w/ Lil Tracy)', 'Hip-hop & Rap', 647990, 463, null, 6);
INSERT INTO grim_parser.tracks (id, title, tag, plays, comments, duration, artist_id) VALUES (60, 'dying out west  (w/ Lil Tracy)', 'Hip-hop & Rap', 680508, 413, null, 6);
INSERT INTO grim_parser.tracks (id, title, tag, plays, comments, duration, artist_id) VALUES (61, 'never eat, never sleep (w/ Lil Tracy)', 'Hip-hop & Rap', 560090, 508, null, 6);
INSERT INTO grim_parser.tracks (id, title, tag, plays, comments, duration, artist_id) VALUES (62, 'california world (feat. craig xen)', 'Hip-hop & Rap', 2645196, 2908, null, 6);
INSERT INTO grim_parser.tracks (id, title, tag, plays, comments, duration, artist_id) VALUES (63, 'lil kennedy', 'Hip-hop & Rap', 2345476, 2099, null, 6);
INSERT INTO grim_parser.tracks (id, title, tag, plays, comments, duration, artist_id) VALUES (64, 'drive by w/ xavier wulf [2020] (prod. nedarb)', 'Hip-hop & Rap', 2578962, 4248, null, 6);
INSERT INTO grim_parser.tracks (id, title, tag, plays, comments, duration, artist_id) VALUES (65, 'drugz', 'Hip-hop & Rap', 6423811, 4015, null, 6);
INSERT INTO grim_parser.tracks (id, title, tag, plays, comments, duration, artist_id) VALUES (66, 'M.O.S. [battery Full]', 'Hip-hop & Rap', 3532188, 2258, null, 6);
INSERT INTO grim_parser.tracks (id, title, tag, plays, comments, duration, artist_id) VALUES (67, 'shiver', 'Hip-hop & Rap', 3747572, 2359, null, 6);
INSERT INTO grim_parser.tracks (id, title, tag, plays, comments, duration, artist_id) VALUES (68, '01 - Reaching Xanadu', 'unknown', 8999, 5, null, 7);
INSERT INTO grim_parser.tracks (id, title, tag, plays, comments, duration, artist_id) VALUES (69, '02 - Lustful Sacraments', 'unknown', 16067, 11, null, 7);
INSERT INTO grim_parser.tracks (id, title, tag, plays, comments, duration, artist_id) VALUES (70, '03 - Excess', 'unknown', 11034, 7, null, 7);
INSERT INTO grim_parser.tracks (id, title, tag, plays, comments, duration, artist_id) VALUES (71, '04 - Secret Devotion (ft. True Body)', 'unknown', 8581, 4, null, 7);
INSERT INTO grim_parser.tracks (id, title, tag, plays, comments, duration, artist_id) VALUES (72, '05 - Death Of The Soul', 'unknown', 10381, 7, null, 7);
INSERT INTO grim_parser.tracks (id, title, tag, plays, comments, duration, artist_id) VALUES (73, '06 - The Other Place', 'unknown', 9065, 3, null, 7);
INSERT INTO grim_parser.tracks (id, title, tag, plays, comments, duration, artist_id) VALUES (74, '07 - Dethroned Under A Funeral Haze', 'unknown', 6530, 7, null, 7);
INSERT INTO grim_parser.tracks (id, title, tag, plays, comments, duration, artist_id) VALUES (75, '08 - Messalina, Messalina', 'unknown', 7264, 6, null, 7);