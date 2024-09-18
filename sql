CREATE TABLE `llog` (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(255) NOT NULL,
    `email` VARCHAR(255) NOT NULL UNIQUE,
    `mobileno` VARCHAR(15) NOT NULL,
    `qualification` VARCHAR(255) NOT NULL,
    `password` VARCHAR(255) NOT NULL
);
