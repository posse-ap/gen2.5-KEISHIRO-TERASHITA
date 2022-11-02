CREATE DATABASE IF NOT EXISTS posse;
USE posse;

DROP TABLE IF EXISTS members, studies, languages, contents;

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

-- 以下ダミーデータ
INSERT INTO members VALUES
(1, "林千翼子", 1, "chiyoko@example.com", "chiyoko"),
(2, "小野寛太", 2, "onokan@example.com", "kanta"),
(3, "寺下渓志郎", 2, "terashi@example.com", "keishiro"),
(4, "伊藤瑠星", 3, "ryusei@example.com", "ryusei");

INSERT INTO studies (member_id, language_id, content_id, hours, date) VALUES
(1, 1, 1, 1, ADDDATE(CURDATE(),interval -35 day)),
(1, 3, 1, 4, ADDDATE(CURDATE(),interval -33 day)),
(1, 4, 2, 3, ADDDATE(CURDATE(),interval -11 day)),
(1, 7, 1, 8, ADDDATE(CURDATE(),interval -10 day)),
(1, 1, 2, 5, ADDDATE(CURDATE(),interval -9 day)),
(1, 2, 3, 6, ADDDATE(CURDATE(),interval -8 day)),
(1, 4, 3, 5, ADDDATE(CURDATE(),interval -7 day)),
(1, 3, 3, 3, ADDDATE(CURDATE(),interval -6 day)),
(1, 2, 1, 2, ADDDATE(CURDATE(),interval -5 day)),
(1, 6, 2, 3, ADDDATE(CURDATE(),interval -4 day)),
(1, 8, 1, 4, ADDDATE(CURDATE(),interval -3 day)),
(1, 4, 1, 4, ADDDATE(CURDATE(),interval -1 day)),
(1, 4, 4, 4, ADDDATE(CURDATE(),interval -1 day)), -- その他試しにね
(1, 5, 3, 5, CURDATE()),
(1, 4, 2, 3, CURDATE()),
(1, 7, 2, 3, ADDDATE(CURDATE(),interval +2 day)),
(1, 1, 3, 6, ADDDATE(CURDATE(),interval +3 day)),
(1, 3, 2, 5, ADDDATE(CURDATE(),interval +4 day)),
(1, 5, 1, 2, ADDDATE(CURDATE(),interval +5 day)),
(1, 7, 3, 3, ADDDATE(CURDATE(),interval +6 day)),
(1, 4, 3, 5, ADDDATE(CURDATE(),interval +7 day)),
(1, 7, 2, 7, ADDDATE(CURDATE(),interval +8 day)),
(1, 6, 2, 6, ADDDATE(CURDATE(),interval +9 day)),
(1, 6, 3, 5, ADDDATE(CURDATE(),interval +10 day)),
(1, 8, 1, 5, ADDDATE(CURDATE(),interval +11 day)),
(1, 3, 2, 2, ADDDATE(CURDATE(),interval +12 day)),
(1, 4, 2, 5, ADDDATE(CURDATE(),interval +20 day)),
(1, 6, 3, 3, ADDDATE(CURDATE(),interval +35 day)),
(1, 7, 1, 7, ADDDATE(CURDATE(),interval +64 day));

INSERT INTO languages VALUES
(1, "その他"),
(2, "SHELL"),
(3, "Laravel"),
(4, "SQL"),
(5, "PHP"),
(6, "JS"),
(7, "CSS"),
(8, "HTML");

INSERT INTO contents VALUES
(1, "N予備校"),
(2, "ドットインストール"),
(3, "POSSE課題"),
(4, "その他");
