CREATE DATABASE IF NOT EXISTS posse;
USE posse;

CREATE TABLE members (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  name TEXT,
  gen INT,
  acout_name TEXT,
  password TEXT
  );

CREATE TABLE studies (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  member_id INT,
  content_id INT,
  hours FLOAT,
  date DATE
);

CREATE TABLE contents (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  content TEXT
);

INSERT INTO members VALUES
(1, "林千翼子", 1, "chiyoko@example.com", "chiyoko"),
(2, "小野寛太", 2, "onokan@example.com", "kanta"),
(3, "寺下渓志郎", 1, "terashi@example.com", "keishiro"),
(4, "伊藤瑠星", 1, "ryusei@example.com", "ryusei");

INSERT INTO studies VALUES
(1, 1, 3, 4, "2022-04-22"),
(2, 1, 4, 3, "2022-04-22"),
(3, 3, 2, 2, "2022-05-31"),
(4, 4, 1, 5, "2022-07-19");

INSERT INTO contents VALUES
(1, "その他"),
(2, "HTML"),
(3, "CSS"),
(4, "JS"),
(5, "PHP"),
(6, "SQL"),
(7, "Laravel"),
(8, "SHELL");