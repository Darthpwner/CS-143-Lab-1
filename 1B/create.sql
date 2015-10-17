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

) ENGINE = InnoDB;

#Director Table; 
CREATE TABLE Director (

) ENGINE = InnoDB;

#MovieGenres;
CREATE TABLE MovieGenre (

) ENGINE = InnoDB;

CREATE TABLE MovieDirector (

) ENGINE = InnoDB;

CREATE TABLE MovieActor (

) ENGINE = InnoDB;

CREATE TABLE Review (

) ENGINE = InnoDB;

CREATE TABLE MaxPersonID (
	id INT DEFAULT 69000
);

CREATE TABLE MaxMovieID (
	id INT DEFAULT 4750
);