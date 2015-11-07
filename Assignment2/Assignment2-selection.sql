#1 Find the film title and language name of all films in which ADAM GRANT acted
#Order the results by title, descending (use ORDER BY title DESC at the end of the query)

SELECT film.title, language.name FROM language 
INNER JOIN film ON film.language_id = language.language_id
INNER JOIN film_actor ON film.film_id = film_actor.film_id
INNER JOIN actor ON film_actor.actor_id = actor.actor_id
WHERE actor.first_name = 'ADAM' AND actor.last_name = 'GRANT'
ORDER BY film.title DESC;

#2 We want to find out how many of each category of film ED CHASE has started in so return a table with category.name and the count
#of the number of films that ED was in which were in that category order by the category name ascending (Your query should return every category even if ED has been in no films in that category).

SELECT q1.name AS 'Film Category', IFNULL(q2.count, '0') AS '# of Films Ed Chase has appeared in' 
FROM (
	SELECT category.name FROM category 
) AS q1
LEFT JOIN (
	SELECT category.name, COUNT(category.name) AS 'count' FROM category 
	INNER JOIN film_category ON film_category.category_id = category.category_id
	INNER JOIN film ON film.film_id = film_category.film_id
	INNER JOIN film_actor ON film.film_id = film_actor.film_id
	INNER JOIN actor ON actor.actor_id = film_actor.actor_id
	WHERE actor.first_name = 'ED' AND actor.last_name = 'CHASE'
	GROUP BY category.name
) AS q2
ON q1.name = q2.name AND '# of Films Ed Chase has starred in' >= 0
GROUP BY q1.name
ORDER BY q1.name;

#3 Find the first name, last name and total combined film length of Sci-Fi films for every actor
#That is the result should list the names of all of the actors(even if an actor has not been in any Sci-Fi films)and the total length of Sci-Fi films they have been in.

SELECT q1.first_name AS 'first_name', q1.last_name AS 'last_name', SUM(q2.length) AS 'Total length'
FROM (
	SELECT actor.actor_id, actor.first_name, actor.last_name, film_actor.film_id
	FROM actor INNER JOIN film_actor ON film_actor.actor_id = actor.actor_id
) AS q1
LEFT JOIN 
(
	SELECT film.length, film.film_id FROM film
	INNER JOIN film_category ON film_category.film_id = film.film_id
	INNER JOIN category ON category.category_id = film_category.category_id
	WHERE category.name = 'Sci-Fi'
) AS q2
ON q1.film_id = q2.film_id 
GROUP BY q1.actor_id
ORDER BY q1.first_name;


#4 Find the first name and last name of all actors who have never been in a Sci-Fi film

SELECT actor.first_name, actor.last_name FROM actor
WHERE actor.actor_id NOT IN (
	SELECT actor.actor_id FROM actor
	INNER JOIN film_actor ON film_actor.actor_id = actor.actor_id
	INNER JOIN film ON film.film_id = film_actor.film_id
	INNER JOIN film_category ON film_category.film_id = film.film_id
	INNER JOIN category ON category.category_id = film_category.category_id
	WHERE category.name = 'Sci-Fi'
) ORDER BY actor.first_name;


#5 Find the film title of all films which feature both KIRSTEN PALTROW and WARREN NOLTE
#Order the results by title, descending (use ORDER BY title DESC at the end of the query)
#Warning, this is a tricky one and while the syntax is all things you know, you have to think oustide
#the box a bit to figure out how to get a table that shows pairs of actors in movies

SELECT q1.title FROM (
	SELECT film.film_id, film.title FROM film
	INNER JOIN film_actor ON film_actor.film_id = film.film_id
	INNER JOIN actor ON actor.actor_id = film_actor.actor_id
	WHERE actor.first_name = 'KIRSTEN' and actor.last_name = 'PALTROW'
) AS q1
INNER JOIN (
	SELECT film.film_id, film.title FROM film
	INNER JOIN film_actor ON film_actor.film_id = film.film_id
	INNER JOIN actor ON actor.actor_id = film_actor.actor_id
	WHERE actor.first_name = 'WARREN' and actor.last_name = 'NOLTE'
) AS q2
WHERE q1.film_id = q2.film_id
ORDER BY q1.title DESC;
