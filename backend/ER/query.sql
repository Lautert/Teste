-- Atores do filme com título "Jurassic"
SELECT
	A.ds_name
FROM
	movie M
	INNER JOIN movie_actor MA ON MA.cd_movie = M.cd_movie
	INNER JOIN actor A ON A.cd_actor = MA.cd_actor
WHERE
	M.ds_title ILIKE '%Jurassic%'
ORDER BY
	MA.n0_order

-- Filmes que o ator de nome "Christopher Walken" participou
SELECT
	M.ds_title,
	M.n0_year
FROM
	movie M
	INNER JOIN movie_actor MA ON MA.cd_movie = M.cd_movie
	INNER JOIN actor A ON A.cd_actor = MA.cd_actor
WHERE
	A.ds_name = 'Christopher Walken'
ORDER BY
	M.n0_year DESC

-- Alternativa
	SELECT
		M.ds_title,
		M.n0_year
	FROM
		movie M 
	WHERE
		cd_movie IN (
			SELECT
				cd_movie
			FROM
				movie_actor MA
				INNER JOIN actor A ON A.cd_actor = MA.cd_actor
			WHERE
				A.ds_name = 'Christopher Walken'
		)
	ORDER BY
		M.n0_year DESC

-- Listar os filmes do ano 2015 ordenados pela quantidade de atores participantes e pelo título em ordem alfabética
BEGIN;
	UPDATE movie SET n0_year = 2015 WHERE cd_movie BETWEEN 1 AND 4;
	SELECT
		M.ds_title,
		M.n0_year,
		count(MA.cd_actor) AS n0_total_actor
	FROM
		movie M
		INNER JOIN movie_actor MA ON MA.cd_movie = M.cd_movie
		INNER JOIN actor A ON A.cd_actor = MA.cd_actor
	WHERE
		M.n0_year = 2015
	GROUP BY
		1,2
	ORDER BY
		count(MA.cd_actor) DESC,
		M.ds_title;
ROLLBACK;

-- Listar os atores que trabalharam em filmes cujo diretor foi “SPIELBERG”
SELECT
	A.ds_name
FROM
	movie M
	INNER JOIN movie_actor MA ON MA.cd_movie = M.cd_movie
	INNER JOIN actor A ON A.cd_actor = MA.cd_actor
	INNER JOIN actor D ON D.cd_actor = M.cd_director
WHERE
	D.ds_name ILIKE '%SPIELBERG%'
GROUP BY
	1