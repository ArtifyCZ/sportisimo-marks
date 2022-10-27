CREATE DATABASE IF NOT EXISTS marks;

USE marks;

CREATE TABLE IF NOT EXISTS mark (
    id INT UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY,
    name VARCHAR(256) UNIQUE NOT NULL
);
