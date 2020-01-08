DROP TABLE IF EXISTS menu;
CREATE TABLE menu (
	id INTEGER PRIMARY KEY AUTOINCREMENT,
	plik CHAR(20) NOT NULL,
	tytul VARCHAR(30) NOT NULL,
	pozycja INTEGER DEFAULT 0
);

INSERT INTO menu VALUES(NULL, 'witam', 'Witamy', 1);
INSERT INTO menu VALUES(NULL, 'wiadomosci', 'Wiadomości', 2);
INSERT INTO menu VALUES(NULL, 'userform', 'Zarejestruj', 3);
INSERT INTO menu VALUES(NULL, 'userlogin', 'Zaloguj się', 4);
INSERT INTO menu VALUES(NULL, 'userlogout', 'Wyloguj', 5);

DROP TABLE IF EXISTS users;
CREATE TABLE users (
	id INTEGER PRIMARY KEY AUTOINCREMENT,
	login CHAR(20) NOT NULL,
	haslo CHAR(40),
	email VARCHAR(50),
	data DATE
);

CREATE TABLE posty (
	id INTEGER PRIMARY KEY AUTOINCREMENT,
	tresc VARCHAR NOT NULL,
	user INTEGER NOT NULL,
	data DATE DEFAULT CURRENT_TIMESTAMP,
	FOREIGN KEY (user) REFERENCES users(id)
);

-- INSERT INTO menu(tytul, plik, id) VALUES('Klasa', 'klasa', NULL);
-- sqlite3 baza.db < baza.sql