CREATE DATABASE IF NOT EXISTS posse;
USE posse;

CREATE TABLE big_questions (id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, name TEXT);

CREATE TABLE questions (id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, big_question_id INT, image TEXT);

CREATE TABLE choices (id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, question_id INT, name TEXT, valid BOOL);

INSERT INTO big_questions VALUES 
(1, "東京の難読地名クイズ"),
(2, "広島の難読地名クイズ");

INSERT INTO questions VALUES 
(1, 1, "takanawa.png"),
(2, 1, "kameido.png"),
(3, 2, "mukainada.png");

INSERT INTO choices VALUES
(1, 1, "たかなわ", 1),
(2, 1, "たかわ", 0),
(3, 1, "こうわ", 0),
(4, 2, "かめと", 0),
(5, 2, "かめど", 0),
(6, 2, "かめいど", 1),
(7, 3, "むこうひら", 0),
(8, 3, "むきひら", 0),
(9, 3, "むかいなだ", 1);


INSERT INTO big_questions
