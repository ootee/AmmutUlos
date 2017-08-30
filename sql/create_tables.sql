-- Lisää CREATE TABLE lauseet tähän tiedostoon
CREATE TABLE Kilpailija (
	kilpailija_id SERIAL PRIMARY KEY,
	etunimi VARCHAR(30) NOT NULL,
	sukunimi VARCHAR(30) NOT NULL,
	kayttajatunnus VARCHAR(16) NOT NULL,
	salasana VARCHAR(16) NOT NULL,
	usergroup TEXT
);

CREATE TABLE Kilpailu (
	kilpailu_id SERIAL PRIMARY KEY,
	pvm DATE NOT NULL,
	paikka VARCHAR(30) NOT NULL
);

CREATE TABLE Rasti (
	rasti_id SERIAL PRIMARY KEY,
	rastinro INTEGER NOT NULL,
	kuvaus VARCHAR(100),
	taululkm INTEGER NOT NULL,
	kilpailu INTEGER REFERENCES Kilpailu(kilpailu_id)
);

CREATE TABLE Osallistuminen (
	kilpailija INTEGER REFERENCES Kilpailija(kilpailija_id),
	kilpailu INTEGER REFERENCES Kilpailu(kilpailu_id)
);