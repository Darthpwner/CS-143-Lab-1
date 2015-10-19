#Movie Violations
 #PRIMARY KEY (id),

#CHECK (id > 0 AND id <= MaxMovieID(id))
UPDATE Movie
SET id = -1	# Violates constraint because id is negative

#Actor Violations
TODO #PRIMARY KEY (id),
#CHECK (id > 0 AND id <= MaxPersonID(id))
Update Actor
Set id = MaxPersonID(id) + 1 #Violates constraint because id is larger than MaxPersonID

#Director Violations
TODO #PRIMARY KEY (id),
TODO #CHECK (id > 0 AND id <= MaxPersonID(id))

#MovieGenres Violations
TODO #mid INTEGER REFERENCES Movie(id),
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