-- Lisää INSERT INTO lauseet tähän tiedostoon
INSERT INTO Kilpailija (etunimi, sukunimi, kayttajatunnus, salasana, usergroup) VALUES ('Testi', 'Käyttäjä', 'testi', 'testi', 'superuser');
INSERT INTO Kilpailu (pvm, paikka) VALUES ('2017-08-01', 'Helsinki');
INSERT INTO Rasti (rastinro, kuvaus, taululkm, kilpailu) VALUES ('1', 'kolme taulua', '3', '1');
INSERT INTO Osallistuminen (kilpailija, kilpailu) VALUES ('1', '1');