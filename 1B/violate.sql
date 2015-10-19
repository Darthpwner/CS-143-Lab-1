#Movie Violations
#PRIMARY KEY (id),
-- INSERT INTO Movie #Constraint since column count doesn't match the first row
-- SELECT id 
-- FROM Movie
-- WHERE id = 20
# ERROR 1136 (21S01) at line 3: Column count doesn't match value count at row 1

#CHECK (id > 0 AND id <= MaxMovieID(id))
-- UPDATE Movie
-- SET id = -1	# Violates constraint because id is negative

#Actor Violations
#PRIMARY KEY (id),
-- INSERT INTO Actor #Constraint since column count doesn't match the first row
-- VALUES (10, 'Lin', 'Matthew', 'Male', 1995-03-26)
# ERROR 1136 (21S01) at line 12: Column count doesn't match value count at row 1

#CHECK (id > 0 AND id <= MaxPersonID(id))
-- UPDATE Actor
-- SET id = MaxPersonID(id) + 1 #Violates constraint because id is larger than MaxPersonID

-- #Director Violations
-- #PRIMARY KEY (id),
-- UPDATE Director
-- SET id = id + 1
# ERROR 1451 (23000) at line 25: Cannot delete or update parent row: a foreign key constraint fails ('TEST', 'MovieDirector', CONSTRAINT 'MovieDirector_ibfk_2' FOREIGN KEY ('did') REFERENCES 'Director' ('id'))

-- #CHECK (id > 0 AND id <= MaxPersonID(id))
-- UPDATE Director
-- SET id = 0 - MaxPersonID(id) #Violates constraint because id < 0

-- #MovieGenres Violations
-- #mid INTEGER REFERENCES Movie(id),
#DELETE FROM Movie
#HERE (SELECT id)	#Violates constraint since we lose the tuple in Movie
# ERROR 1451 (23000) at line 29: Cannot delete or update a parent row: a foreign key constraint fails ('CS143', 'MovieGenre', CONSTRAINT 'MovieGenre_ibfk_1' FOREIGN KEY ('mid') REFERENCES 'Movie' ('id'))

-- #FOREIGN KEY (mid) REFERENCES Movie(id)
-- UPDATE MovieGenre
-- SET mid = mid - 1 #Violates constraint since we updated the Foreign Key
# ERROR 1452 (23000) at line 34: Cannot add or update a child row: a foreign key constraint fails ('CS143', 'MovieGenre', CONSTRAINT 'MovieGenre_ibfk_1' FOREIGN KEY ('mid') REFERENCES 'Movie' ('id'))

-- #MovieDirector Violations
-- #mid INTEGER REFERENCES Movie(id),
-- Update Movie
-- SET id = NULL	#Violates constraint since we update Movie
# ERROR 1451 (23000) at line 40: Cannot delete or update a parent row: a foreign key constraint fails ('CS143', 'MovieGenre', CONSTRAINT 'MovieGenre_ibfk_1' FOREIGN KEY ('mid') REFERENCES 'Movie' ('id'))

-- #did INTEGER REFERENCES Director(id),
-- INSERT INTO MovieDirector #Violates constraint as we insert into MovieDirector
-- SELECT *
-- FROM Actor
-- WHERE sex = 'Female'
# ERROR 1136 (21S01) at line 45: Column count doesn't match value count at row 1

-- #FOREIGN KEY (mid) REFERENCES Movie(id),
-- INSERT INTO MovieDirector #Violates constriant as we insert into MovieDirector
-- SELECT *
-- FROM Director
# ERROR 1136 (21S01) at line 52: Column count doesn't match value count at row 1

-- #FOREIGN KEY (did) REFERENCES Director(id)
-- DELETE FROM Director #Violates constraint since we lose tuple in Director
-- WHERE (SELECT id)
# ERROR 1451 (23000) at line 58: Cannot delete or update a parent row: a foreign key constraint fails ('CS143', 'MovieDirector', CONSTRAINT 'MovieDirector_ibfk_2' FOREIGN KEY ('did') REFERENCES 'Director' ('id'))

#MovieActor Violations
#mid INTEGER REFERENCES Movie(id),
-- UPDATE MovieActor
-- SET mid = mid - 100 #Violates constraint since we update MovieActor
# ERROR 1452 (23000) at line 58: Cannot delete or update a parent row: a foreign key constraint fails ('CS143', 'MovieDirector', CONSTRAINT 'MovieDirector_ibfk_2' FOREIGN KEY ('did') REFERENCES 'Director' ('id'))

-- #aid INTEGER REFERENCES Actor(id),
-- UPDATE Movie
-- SET id = 69 + id #Violates constraint since we update Actor
# ERROR 1451 (23000) at line 69: Cannot delete or update a parent row: a foreign key constraint fails ('CS143', 'MovieGenre', CONSTRAINT 'MovieGenre_ibfk_1' FOREIGN KEY ('mid') REFERENCES 'Movie' ('id'))

-- #FOREIGN KEY (mid) REFERENCES Movie(id),
-- INSERT INTO MovieActor #Violates constraint by inserting into MovieActor
-- SELECT year
-- FROM Movie 
# ERROR 1136 (21S01) at line 74: Column count doesn't match value count at row 1

-- #FOREIGN KEY (aid) REFERENCES Actor(id)
-- DELETE FROM Actor
-- WHERE (SELECT id) #Violates constraint by deleting Actor
# ERROR 1451 (23000) at line 80: Cannot delete or update a parent row: a foreign key constraint fails ('CS143', 'MovieActor', CONSTRAINT 'MovieActor_ibfk_2' FOREIGN KEY ('aid') REFERENCES 'Actor' ('id'))

-- #Review Violations
-- #mid INTEGER REFERENCES Movie(id),
-- DELETE FROM Movie
-- WHERE (SELECT id) #Violates constraint by deleting Movie
# ERROR 1451 (23000) at line 86: Cannot delete or update a parent row: a foreign key constraint fails ('CS143', 'MovieGenre', CONSTRAINT 'MovieGenre_ibfk_1' FOREIGN KEY ('mid') REFEREMCES 'Movie' ('id'))

-- #FOREIGN KEY (mid) REFERENCES Movie(id),
-- INSERT INTO Review #Violates constraint by inserting into Review
-- SELECT name
-- FROM Review
# ERROR 1136 (21S01) at line 97: Column count doesn't match value count at row 1