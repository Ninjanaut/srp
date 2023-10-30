# Create database
CREATE DATABASE IF NOT EXISTS SRP;
USE SRP;

# ReCreate table
DROP TABLE IF EXISTS `brand`;
CREATE TABLE `brand`
(
    id     int AUTO_INCREMENT not null,
    `name` nvarchar(255)      not null,
    CONSTRAINT PK_brand PRIMARY KEY (id, `name`),
    CONSTRAINT UQ_name UNIQUE (`name`)
);

# Seed defaults
INSERT INTO `brand` (`name`)
VALUES ('Carraa'),
       ('Nike'),
       ('Keller'),
       ('Harrows');

# Seed additional records
DROP PROCEDURE IF EXISTS GenerateBrands;
DELIMITER $$
CREATE PROCEDURE GenerateBrands(fromRecord int, toRecord int)
BEGIN
    DECLARE i INT DEFAULT fromRecord;
    WHILE i <= toRecord
        DO
            insert into `brand` (`name`) values (CONCAT('Brand ', i));
            SET i = i + 1;
        END WHILE;
END$$
DELIMITER ;

call GenerateBrands(5, 99);
