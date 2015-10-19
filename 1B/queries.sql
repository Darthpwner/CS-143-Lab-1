/*Give me the names of all the actors in the movie 'Die Another Day'.
Please also make sure actor names are in this format:  <firstname> <lastname>   (seperated by single space). */

/*SELECT CONCAT (first, ' ', last)
FROM Actor A, MovieActor MA, Movie M
WHERE M.title = 'Die Another Day' AND A.id = MA.aid AND M.id = MA.mid*/

/*Give me the count of all the actors who acted in multiple movies.*/

SELECT COUNT(*)
FROM (
	SELECT COUNT(mid)
	FROM Actor A, MovieActor MA
	WHERE A.id = MA.aid
	GROUP BY id
	HAVING COUNT(mid) > 1
) as tmp

/*Give me the titles of all the Romance movies*/
/*SELECT title
FROM Movie M, MovieGenre MG
WHERE M.id = MG.mid AND MG.genre = 'Romance';
*/
