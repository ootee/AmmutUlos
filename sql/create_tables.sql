-- Lisää CREATE TABLE lauseet tähän tiedostoon
CREATE TABLE Kilpailija (
	kilpailija_id SERIAL PRIMARY KEY,
	etunimi TEXT NOT NULL,
	sukunimi TEXT
);

CREATE TABLE Kilpailu (
	kilpailu_id SERIAL PRIMARY KEY,
	pvm DATE NOT NULL,
	paikka TEXT NOT NULL
);

CREATE TABLE Rasti (
	rasti_id SERIAL PRIMARY KEY,
	rastinro INTEGER NOT NULL,
	kuvaus VARCHAR(100),
	taululkm INTEGER NOT NULL,
	kilpailu INTEGER REFERENCES Kilpailu(kilpailu_id)
);

CREATE TABLE Tulos (
	tulos_id SERIAL PRIMARY KEY,
	aika DECIMAL NOT NULL,
	pisteet INTEGER NOT NULL,
	rasti INTEGER REFERENCES Rasti(rasti_id),
	kilpailija INTEGER REFERENCES Kilpailija(kilpailija_id)
);

CREATE TABLE Kilpailusuoritus (
	kilpailija INTEGER REFERENCES Kilpailija(kilpailija_id),
	kilpailu INTEGER REFERENCES Kilpailu(kilpailu_id)
);