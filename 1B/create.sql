# Movie Table; primary key: id
CREATE TABLE Movie (
	id INTEGER NOT NULL,
	title VARCHAR(100) NOT NULL,
	year INTEGER NOT NULL,
	rating VARCHAR(10),
	company VARCHAR(10) NOT NULL,
	PRIMARY KEY (id),
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
	CHECK (id > 0 AND id <= MaxPersonID(id))
) ENGINE = InnoDB;

#MovieGenres;
CREATE TABLE MovieGenre (
	mid INTEGER REFERENCES Movie(id),
	genre VARCHAR (20) NOT NULL,
	/*UNIQUE(mid, genre),*/
	FOREIGN KEY (mid) REFERENCES Movie(id)
) ENGINE = InnoDB;

CREATE TABLE MovieDirector (
	mid INTEGER REFERENCES Movie(id),
	did INTEGER REFERENCES Director(id),
	FOREIGN KEY (mid) REFERENCES Movie(id),
	FOREIGN KEY (did) REFERENCES Director(id),
	#CHECK (mid > 0 AND mid <= MaxMovieID(id))
) ENGINE = InnoDB;

CREATE TABLE MovieActor (
	mid INTEGER REFERENCES Movie(id),
	aid INTEGER REFERENCES Actor(id),
	role VARCHAR(50) NOT NULL,
	FOREIGN KEY (mid) REFERENCES Movie(id),
	FOREIGN KEY (aid) REFERENCES Actor(id),
	#CHECK (aid > 0 AND aid <= MaxPersonID(id))
) ENGINE = InnoDB;

CREATE TABLE Review (
	name VARCHAR(20) NULL,
	time TIMESTAMP NULL,
	mid INTEGER REFERENCES Movie(id),
	rating INTEGER NULL,
	comment VARCHAR(500) NULL,
	FOREIGN KEY (mid) REFERENCES Movie(id),
	CHECK (rating >= 0 AND rating <= 5)
) ENGINE = InnoDB;

CREATE TABLE MaxPersonID (
	id INT DEFAULT 69000
);

CREATE TABLE MaxMovieID (
	id INT DEFAULT 4750
);