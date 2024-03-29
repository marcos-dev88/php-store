-- MySQL Script generated by MySQL Workbench
-- Sat Aug  8 13:26:23 2020
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema php_store
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema php_store
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `php_store` DEFAULT CHARACTER SET utf8 ;
USE `php_store` ;

-- -----------------------------------------------------
-- Table `php_store`.`loja`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `php_store`.`store` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) NOT NULL,
  `social_reason` VARCHAR(100) NOT NULL,
  `cnpj` VARCHAR(25) NOT NULL,
  `city` VARCHAR(45) NOT NULL,
  `state` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`));


-- -----------------------------------------------------
-- Table `php_store`.`usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `php_store`.`user` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `id_store` INT NOT NULL,
  `role` VARCHAR(20) NOT NULL,
  `nick_name` VARCHAR(45) NOT NULL,
  `password` VARCHAR(100) NOT NULL,
  `birth_date` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`, `id_store`),
  INDEX `fk_user_store_idx` (`id_store` ASC),
  CONSTRAINT `fk_user_store`
    FOREIGN KEY (`id_store`)
    REFERENCES `php_store`.`store` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION);


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

INSERT INTO loja(name, social_reason, cnpj, city, state) VALUES ("Adminstore", "Loja de Administracao", 8080127001, "Florianopolis", "Santa Catarina");

INSERT INTO usuario(id_loja, role, nick_name, password, birth_date) VALUES (1, "admin", "admin", "admin", "1999-07-30");

INSERT INTO usuario(id_loja, role, nick_name, password, birth_date) VALUES (1, "user", "user", "user", "1999-07-30");

