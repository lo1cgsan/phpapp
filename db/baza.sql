DROP TABLE IF EXISTS menu;
CREATE TABLE menu (
	id INTEGER PRIMARY KEY AUTOINCREMENT,
	plik CHAR(20) NOT NULL,
	tytul VARCHAR(30) NOT NULL,
	topmenu INTEGER DEFAULT 0
);

INSERT INTO menu (id, plik, tytul) VALUES(1, 'witam', 'Witamy');
INSERT INTO menu (id, plik, tytul) VALUES(2, 'wiadomosci', 'Wiadomości');
INSERT INTO menu (id, plik, tytul) VALUES(3, 'userform', 'Użytkownicy');
INSERT INTO menu (id, plik, tytul) VALUES(4, 'klasa', 'Klasa');

DROP TABLE IF EXISTS users;
CREATE TABLE users (
	id INTEGER PRIMARY KEY AUTOINCREMENT,
	login CHAR(20) NOT NULL,
	haslo CHAR(40),
	email VARCHAR(50),
	data DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE posty (
	id INTEGER PRIMARY KEY AUTOINCREMENT,
	tresc VARCHAR NOT NULL,
	id_user INTEGER DEFAULT NULL,
	data DATETIME DEFAULT CURRENT_TIMESTAMP,
	FOREIGN KEY (id_user) REFERENCES users(id)
);


-- INSERT INTO menu(tytul, plik, id) VALUES('Klasa', 'klasa', NULL);
-- sqlite3 baza.db < baza.sql