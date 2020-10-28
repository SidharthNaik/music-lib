use test;

CREATE TABLE users(
    username VARCHAR(30) PRIMARY KEY,
    password VARCHAR(30) NOT NULL,
    email VARCHAR(50) NOT NULL,
    date TIMESTAMP
)