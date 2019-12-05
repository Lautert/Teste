/*
	Filme N : 1 Diretor
	Filme N : N Atores
*/

CREATE TABLE actor(
	cd_actor	SERIAL,
	ds_name		VARCHAR(200) NOT NULL,

	CONSTRAINT pk_atr_cd_actor PRIMARY KEY (cd_actor),
	CONSTRAINT uk_atr_ds_name UNIQUE (ds_name)
);
COMMENT ON TABLE actor IS 'alias atr';
CREATE INDEX ix_atr_ds_name ON actor(ds_name);

CREATE TABLE movie(
	cd_movie	SERIAL,
	ds_title	VARCHAR(200) NOT NULL,
	n0_year		INTEGER NOT NULL,

	cd_director INTEGER NOT NULL,

	CONSTRAINT pk_mve_cd_movie PRIMARY KEY (cd_movie),
	CONSTRAINT fk_mve_cd_director FOREIGN KEY (cd_director) REFERENCES actor(cd_actor),

	CONSTRAINT uk_mve_ds_title UNIQUE (ds_title)
);
COMMENT ON TABLE movie IS 'alias mve';
CREATE INDEX ix_mve_cd_director ON movie(cd_director);
CREATE INDEX ix_mve_ds_title ON movie(ds_title);
CREATE INDEX ix_mve_n0_year ON movie(n0_year);

CREATE TABLE movie_actor(
	cd_movie_actor	SERIAL,
	cd_movie		INTEGER NOT NULL,
	cd_actor		INTEGER NOT NULL,

	n0_order		INTEGER,

	CONSTRAINT pk_mar_cd_movie PRIMARY KEY (cd_movie_actor),
	CONSTRAINT fk_mar_cd_movie FOREIGN KEY (cd_movie) REFERENCES movie(cd_movie) ON DELETE CASCADE,
	CONSTRAINT fk_mar_cd_actor FOREIGN KEY (cd_actor) REFERENCES actor(cd_actor) ON DELETE CASCADE,

	CONSTRAINT uk_mar_cd_director_cd_actor UNIQUE (cd_movie, cd_actor)
);
COMMENT ON TABLE movie_actor IS 'alias mar';
CREATE INDEX ix_mar_cd_movie ON movie_actor(cd_movie);
CREATE INDEX ix_mar_cd_actor ON movie_actor(cd_actor);