-- CS340
-- Robert Ottolia, Onur Ozay
-- Final Project table creation queries

DROP TABLE IF EXISTS breweries;
DROP TABLE IF EXISTS locations;
DROP TABLE IF EXISTS amenities;
DROP TABLE IF EXISTS employees;
DROP TABLE IF EXISTS beers;
DROP TABLE IF EXISTS contains;
DROP TABLE IF EXISTS serves;

CREATE TABLE locations (
	id INT NOT NULL AUTO_INCREMENT,
	city VARCHAR(255) NOT NULL,
	state VARCHAR(255) NOT NULL,
	UNIQUE (city, state),
	PRIMARY KEY (id)
) ENGINE = InnoDB DEFAULT CHARSET = utf8;

CREATE TABLE beers (
	id INT NOT NULL AUTO_INCREMENT,
	style VARCHAR(255) NOT NULL,
	type VARCHAR(255) NOT NULL,
	abv INT,
	PRIMARY KEY (id)
) ENGINE = InnoDB DEFAULT CHARSET = utf8;

CREATE TABLE amenities (
	id INT NOT NULL AUTO_INCREMENT,
	feature VARCHAR(255) NOT NULL,
	PRIMARY KEY (id)
) ENGINE = InnoDB DEFAULT CHARSET = utf8;

CREATE TABLE breweries (
	id INT NOT NULL AUTO_INCREMENT,
	name VARCHAR(255) NOT NULL,
	rating INT,
	location_id INT NOT NULL,
	PRIMARY KEY (id),
	FOREIGN KEY (location_id) REFERENCES locations (id)
) ENGINE = InnoDB DEFAULT CHARSET = utf8;

CREATE TABLE employees (
	id INT NOT NULL AUTO_INCREMENT,
	age INT NOT NULL,
	f_name VARCHAR(255) NOT NULL,
	l_name VARCHAR(255) NOT NULL,
	pay_hr INT,
	position VARCHAR(255) NOT NULL,
	brewery_id INT NOT NULL,
	beer_id INT NOT NULL,
	PRIMARY KEY (id), 
	FOREIGN KEY (brewery_id) REFERENCES breweries (id),
	FOREIGN KEY (beer_id) REFERENCES beers (id)
) ENGINE = InnoDB DEFAULT CHARSET = utf8;

CREATE TABLE contains (
	amenity_id INT NOT NULL,
	brewery_id INT NOT NULL,
	PRIMARY KEY (amenity_id, brewery_id),
	FOREIGN KEY (amenity_id) REFERENCES amenities (id),
	FOREIGN KEY (brewery_id) REFERENCES breweries (id)
) ENGINE = InnoDB DEFAULT CHARSET = utf8;

CREATE TABLE serves (
	beer_id INT NOT NULL,
	brewery_id INT NOT NULL,
	PRIMARY KEY (beer_id, brewery_id),
	FOREIGN KEY (beer_id) REFERENCES beers (id),
	FOREIGN KEY (brewery_id) REFERENCES breweries (id)
) ENGINE = InnoDB DEFAULT CHARSET = utf8;