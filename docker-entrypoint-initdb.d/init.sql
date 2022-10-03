CREATE DATABASE IF NOT EXISTS posse;
USE posse;

DROP TABLE IF EXISTS big_questions;
DROP TABLE IF EXISTS questions;
DROP TABLE IF EXISTS choices;

CREATE TABLE big_questions (id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, name TEXT);

CREATE TABLE questions (id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, big_question_id INT, image TEXT);

CREATE TABLE choices (id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, question_id INT, name TEXT, valid BOOL);

TRUNCATE TABLE big_questions;
TRUNCATE TABLE questions;
TRUNCATE TABLE choices;

INSERT INTO big_questions (name) VALUES 
("東京の難読地名クイズ"),
("広島の難読地名クイズ");

INSERT INTO questions (big_question_id, image) VALUES 
(1, "takanawa.png"),
(1, "kameido.png"),
(2, "mukainada.png");

INSERT INTO choices (question_id, name, valid) VALUES
(1, "たかなわ", 1),
(1, "たかわ", 0),
(1, "こうわ", 0),
(2, "かめと", 0),
(2, "かめど", 0),
(2, "かめいど", 1),
(3, "むこうひら", 0),
(3, "むきひら", 0),
(3, "むかいなだ", 1);
