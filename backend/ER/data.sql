INSERT INTO actor (ds_name) VALUES
('Steven Spielberg'),		-- 1
('Sam Neill'),				-- 2
('Laura Dern'),				-- 3
('Richard Attenborough'),	-- 4
('Jeff Goldblum'),			-- 5

('Leonardo DiCaprio'),		-- 6
('Tom Hanks'),				-- 7
('Christopher Walken'),		-- 8
('Ryan Hurst'),				-- 9
('Tim Burton'),				-- 10

('Johnny Depp'),			-- 11
('Christina Ricci'),		-- 12
('Martin Scorsese'),		-- 13
('Jonah Hill'),				-- 14
('Margot Robbie'),			-- 15
('Matthew McConaughey'),	-- 16
('Kyle Chandler');			-- 17


INSERT INTO movie(ds_title, n0_year, cd_director) VALUES
('Jurassic Park', 1993, 1),
('Catch Me If You Can', 2002, 1),
('Saving Private Ryan', 1998, 1),

('Sleepy Hollow', 1999, 10),

('Wolf of Wall Street', 2013, 13);


INSERT INTO movie_actor(cd_movie, cd_actor, n0_order) VALUES
(1, 2, 1),
(1, 3, 2),
(1, 4, 4),
(1, 5, 3),

(2, 6, 1),
(2, 7, 2),
(2, 8, 3),

(3, 9, 1),
(3, 7, 2),

(4, 11, 1),
(4, 8, 2),
(4, 12, 3),

(5, 6, 1),
(5, 14, 2),
(5, 15, 3),
(5, 16, 4),
(5, 17, 5);
