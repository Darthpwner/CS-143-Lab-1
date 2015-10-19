#Movie Violations
#PRIMARY KEY (id),
TODO

#CHECK (id > 0 AND id <= MaxMovieID(id))
UPDATE Movie
SET id = -1	# Violates constraint because id is negative

#Actor Violations
#PRIMARY KEY (id),
TODO

#CHECK (id > 0 AND id <= MaxPersonID(id))
UPDATE Actor
SET id = MaxPersonID(id) + 1 #Violates constraint because id is larger than MaxPersonID

#Director Violations
#PRIMARY KEY (id),
TODO

#CHECK (id > 0 AND id <= MaxPersonID(id))
UPDATE Director
SET id = 0 - MaxPersonID(id) #Violates constraint because id < 0

#MovieGenres Violations
#mid INTEGER REFERENCES Movie(id),
DELETE FROM Movie
WHERE (SELECT id)	#Violates constraint since we lose the tuple in Movie

#FOREIGN KEY (mid) REFERENCES Movie(id)
UPDATE MovieGenre
SET mid = mid - 1 #Violates constraint since we updated the Foreign Key

#MovieDirector Violations
#mid INTEGER REFERENCES Movie(id),
Update Movie
SET id = NULL	#Violates constraint since we update Movie

#did INTEGER REFERENCES Director(id),
INSERT INTO MovieDirector #Violates constraint as we insert into MovieDirector
SELECT *
FROM Actor
WHERE sex = 'Female'

#FOREIGN KEY (mid) REFERENCES Movie(id),
INSERT INTO MovieDirector #Violates constriant as we insert into MovieDirector
SELECT *
FROM Director

#FOREIGN KEY (did) REFERENCES Director(id)
DELETE FROM Director #Violates constraint since we lose tuple in Director
WHERE (SELECT id)

#MovieActor Violations
#mid INTEGER REFERENCES Movie(id),
UPDATE MovieActor
SET mid = mid - 100 #Violates constraint since we update MovieActor

#aid INTEGER REFERENCES Actor(id),
UPDATE Movie
SET id = 69 + id #Violates constraint since we update Actor

#FOREIGN KEY (mid) REFERENCES Movie(id),
INSERT INTO MovieActor #Violates constraint by inserting into MovieActor
SELECT year
FROM Movie 

#FOREIGN KEY (aid) REFERENCES Actor(id)
DELETE FROM Actor
WHERE (SELECT id) #Violates constraint by deleting Actor

#Review Violations
#mid INTEGER REFERENCES Movie(id),
DELETE FROM Movie
WHERE (SELECT id) #Violates constraint by deleting Movie

#FOREIGN KEY (mid) REFERENCES Movie(id),
UPDATE Review
SET mid = mid * 0 #Violates constraint by updating Review
