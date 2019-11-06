DROP TABLE IF EXISTS menu;
CREATE TABLE menu (
	id INTEGER PRIMARY KEY AUTOINCREMENT,
	plik CHAR(20) NOT NULL,
	tytul VARCHAR(30) NOT NULL,
	pozycja INTEGER DEFAULT 0
);

INSERT INTO menu VALUES(NULL, 'witam', 'Witamy', 1);
INSERT INTO menu VALUES(NULL, 'formularz', 'Formularz', 2);
INSERT INTO menu VALUES(NULL, 'klasa', 'Klasa', 3);

CREATE TABLE posty (
	id INTEGER PRIMARY KEY AUTOINCREMENT,
	tresc VARCHAR NOT NULL
);


-- INSERT INTO menu(tytul, plik, id) VALUES('Klasa', 'klasa', NULL);
-- sqlite3 baza.db < baza.sql