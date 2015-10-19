#Movie Violations
 #PRIMARY KEY (id),

#CHECK (id > 0 AND id <= MaxMovieID(id))
UPDATE Movie
SET id = -1	# Violates constraint because id is negative

#Actor Violations
TODO #PRIMARY KEY (id),
#CHECK (id > 0 AND id <= MaxPersonID(id))
UPDATE Actor
SET id = MaxPersonID(id) + 1 #Violates constraint because id is larger than MaxPersonID

#Director Violations
TODO #PRIMARY KEY (id),
#CHECK (id > 0 AND id <= MaxPersonID(id))
UPDATE Director
SET id = 0 - MaxPersonID(id) #Violates constraint because id < 0

#MovieGenres Violations
#mid INTEGER REFERENCES Movie(id),
DELETE FROM Movie
WHERE (SELECT id)	#Lose the tuple in Movie
Update MovieGenres
SET mid = mid + 1	#Violation 

TODO #FOREIGN KEY (mid) REFERENCES Movie(id)

#MovieDirector Violations
TODO	#mid INTEGER REFERENCES Movie(id),
TODO	#did INTEGER REFERENCES Director(id),
TODO	#FOREIGN KEY (mid) REFERENCES Movie(id),
TODO	#FOREIGN KEY (did) REFERENCES Director(id)

#MovieActor Violations
TODO	#mid INTEGER REFERENCES Movie(id),
TODO	#aid INTEGER REFERENCES Actor(id),
TODO	#FOREIGN KEY (mid) REFERENCES Movie(id),
TODO	#FOREIGN KEY (aid) REFERENCES Actor(id)

#Review Violations
TODO	#mid INTEGER REFERENCES Movie(id),
TODO	#FOREIGN KEY (mid) REFERENCES Movie(id),