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
  language_id INT,
  content_id INT,
  hours FLOAT,
  date DATE
);

CREATE TABLE languages (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  language TEXT
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

INSERT INTO studies (member_id, language_id, content_id, hours, date) VALUES
(1, 3, 1, 4, "2019-04-22"),
(1, 4, 2, 3, "2019-10-02"),
(1, 7, 1, 8, "2021-10-02"),
(1, 1, 2, 5, "2022-03-27"),
(1, 2, 3, 6, "2022-05-14"),
(1, 4, 3, 5, "2022-07-19"),
(1, 3, 3, 3, "2022-08-14"),
(2, 2, 1, 2, "2021-07-19"),
(2, 6, 2, 3, "2021-09-20"),
(2, 8, 1, 4, "2021-11-09"),
(2, 1, 1, 1, "2021-12-21"),
(2, 4, 1, 4, "2022-02-28"),
(2, 5, 3, 5, "2022-08-14"),
(2, 4, 2, 3, "2022-08-14"),
(3, 6, 2, 6, "2021-11-19"),
(3, 7, 2, 3, "2021-11-22"),
(3, 1, 3, 6, "2022-12-05"),
(3, 3, 2, 5, "2022-01-08"),
(3, 5, 1, 2, "2022-03-22"),
(3, 7, 3, 3, "2022-07-19"),
(3, 4, 3, 5, "2022-08-14"),
(4, 7, 2, 7, "2022-07-03"),
(4, 6, 3, 5, "2022-07-11"),
(4, 8, 1, 5, "2022-07-23"),
(4, 3, 2, 2, "2022-08-01"),
(4, 4, 2, 5, "2022-08-08"),
(4, 6, 3, 3, "2022-08-13"),
(4, 7, 1, 7, "2022-08-14");

INSERT INTO languages VALUES
(1, "その他"),
(2, "HTML"),
(3, "CSS"),
(4, "JS"),
(5, "PHP"),
(6, "SQL"),
(7, "Laravel"),
(8, "SHELL");

INSERT INTO contents VALUES
(1, "N予備校"),
(2, "ドットインストール"),
(3, "POSSE課題");
