use test;

CREATE TABLE songs(
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    songName VARCHAR(30) NOT NULL,
    artistName VARCHAR(30) NOT NULL,
    genre VARCHAR(30) NOT NULL,
    musicLink VARCHAR(100),
    date TIMESTAMP
)