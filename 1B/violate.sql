#Movie Violations
ALTER TABLE Movie ADD PRIMARY KEY (id); #PRIMARY KEY (id),
TODO #CHECK (id > 0 AND id <= MaxMovieID(id))

#Actor Violations
TODO #PRIMARY KEY (id),
TODO #CHECK (id > 0 AND id <= MaxPersonID(id))

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