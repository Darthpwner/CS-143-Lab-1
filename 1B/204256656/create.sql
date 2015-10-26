# Movie Table; primary key: id
CREATE TABLE Movie (
	id INTEGER NOT NULL,
	title VARCHAR(100) NOT NULL,
	year INTEGER NOT NULL,
	rating VARCHAR(10),
	company VARCHAR(50) NOT NULL,
	PRIMARY KEY (id),
	# id has to be unique and between 0 and the max
	CHECK (id > 0 AND id <= MaxMovieID(id))
) ENGINE = InnoDB;

# Actor Table; primary key: id
CREATE TABLE Actor (
	id INTEGER NOT NULL,
	last VARCHAR (20) NOT NULL,
	first VARCHAR(20) NOT NULL,
	sex VARCHAR (6) NOT NULL,
	dob DATE NOT NULL,
	dod DATE DEFAULT NULL,
	PRIMARY KEY (id),
	# id has to be unique and between 0 and the max
	CHECK (id > 0 AND id <= MaxPersonID(id))
) ENGINE = InnoDB;

#Director Table; 
CREATE TABLE Director (
	id INTEGER NOT NULL,
	last VARCHAR (20) NOT NULL,
    first VARCHAR(20) NOT NULL,
	dob DATE NOT NULL,
	dod DATE DEFAULT NULL,
	PRIMARY KEY (id),
	# id has to be unique and between 0 and the max
	CHECK (id > 0 AND id <= MaxPersonID(id))
) ENGINE = InnoDB;

#MovieGenres;
CREATE TABLE MovieGenre (
	# the mid must match the id in Movie Table
	mid INTEGER REFERENCES Movie(id),
	genre VARCHAR (20),
	# the mid must match the id in Movie Table
	FOREIGN KEY (mid) REFERENCES Movie(id)
) ENGINE = InnoDB;

CREATE TABLE MovieDirector (
	# the mid must match the id in Movie Table
	mid INTEGER REFERENCES Movie(id),
	# the did must match the id in Director Table
	did INTEGER REFERENCES Director(id),
	# the mid must match the id in Movie Table
	FOREIGN KEY (mid) REFERENCES Movie(id),
	# the did must match the id in Director Table
	FOREIGN KEY (did) REFERENCES Director(id)
) ENGINE = InnoDB;

CREATE TABLE MovieActor (
	# the mid must match the id in Movie Table
	mid INTEGER REFERENCES Movie(id),
	# the aid must match the id in Actor Table
	aid INTEGER REFERENCES Actor(id),
	role VARCHAR(50) NOT NULL,
	# the mid must match the id in Movie Table
	FOREIGN KEY (mid) REFERENCES Movie(id),
	# the aid must match the id in Actor Table
	FOREIGN KEY (aid) REFERENCES Actor(id)
) ENGINE = InnoDB;

CREATE TABLE Review (
	name VARCHAR(20) NOT NULL,
	time TIMESTAMP NOT NULL,
	# the mid must match the id in Movie Table
	mid INTEGER REFERENCES Movie(id),
	rating INTEGER NOT NULL,
	comment VARCHAR(500) NULL,	#Comments are optional but you have to give a rating
	# the mid must match the id in Movie Table
	FOREIGN KEY (mid) REFERENCES Movie(id),
	# rating has to be between 0 and 5 stars
	CHECK (rating >= 0 AND rating <= 5)
) ENGINE = InnoDB;

CREATE TABLE MaxPersonID (
	id INT DEFAULT 69000
);

CREATE TABLE MaxMovieID (
	id INT DEFAULT 4750
);
