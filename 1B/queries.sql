/*Give me the names of all the actors in the movie 'Die Another Day'.
 Please also make sure actor names are in this format:  <firstname> <lastname>   (seperated by single space).*/

SELECT firstname, lastname
FROM actor, movie
WHERE title = "Die Another Day"
/*Give me the count of all the actors who acted in multiple movies.*/


/*To Be Determined by the user*/