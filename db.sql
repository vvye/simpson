CREATE DATABASE simpson;

USE simpson;

CREATE TABLE users
(
  id            INT PRIMARY KEY   NOT NULL AUTO_INCREMENT,
  first_name    VARCHAR(100)      NOT NULL,
  last_name     VARCHAR(100)      NOT NULL,
  email         VARCHAR(100)      NOT NULL,
  password_hash VARCHAR(100)      NOT NULL,
  email_public  TINYINT DEFAULT 0 NOT NULL
);