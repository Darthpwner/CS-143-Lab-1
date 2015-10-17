/*Give me the names of all the actors in the movie 'Die Another Day'.
 Please also make sure actor names are in this format:  <firstname> <lastname>   (seperated by single space).*/

SELECT DISTINCT last, first
#SELECT firstname, lastname
FROM ACTOR A, MOVIEACTOR MA, MOVIE M
WHERE M.title = 'Die Another Day' AND A.id = MA.aid AND M.id = MA.mid

/*Give me the count of all the actors who acted in multiple movies.*/


/*To Be Determined by the user*/