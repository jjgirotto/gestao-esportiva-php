-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema gestao_esportiva
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema gestao_esportiva
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `gestao_esportiva` DEFAULT CHARACTER SET utf8 ;
USE `gestao_esportiva` ;

-- -----------------------------------------------------
-- Table `gestao_esportiva`.`equipe`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gestao_esportiva`.`equipe` (
  `id_equipe` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  `tecnico` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id_equipe`),
  UNIQUE INDEX `nome_UNIQUE` (`nome` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gestao_esportiva`.`jogador`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gestao_esportiva`.`jogador` (
  `id_jogador` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NOT NULL,
  `numero_camisa` INT NOT NULL,
  `id_equipe` INT NULL,
  PRIMARY KEY (`id_jogador`),
  INDEX `fk_jogador_equipe_idx` (`id_equipe` ASC) VISIBLE,
  CONSTRAINT `fk_jogador_equipe`
    FOREIGN KEY (`id_equipe`)
    REFERENCES `gestao_esportiva`.`equipe` (`id_equipe`)
    ON DELETE SET NULL
    ON UPDATE NO ACTION
) ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gestao_esportiva`.`competicao`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gestao_esportiva`.`competicao` (
  `id_competicao` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  `tipo` VARCHAR(45) NOT NULL,
  `premio` DECIMAL(10,2) NOT NULL,
  PRIMARY KEY (`id_competicao`),
  UNIQUE INDEX `nome_UNIQUE` (`nome` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gestao_esportiva`.`equipe_da_competicao`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gestao_esportiva`.`equipe_da_competicao` (
  `id_equipe` INT NOT NULL,
  `id_competicao` INT NOT NULL,
  `colocacao` INT NOT NULL,
  PRIMARY KEY (`id_equipe`, `id_competicao`),
  INDEX `fk_equipe_has_competicao_competicao1_idx` (`id_competicao` ASC) VISIBLE,
  INDEX `fk_equipe_has_competicao_equipe1_idx` (`id_equipe` ASC) VISIBLE,
  CONSTRAINT `fk_equipe_has_competicao_equipe1`
    FOREIGN KEY (`id_equipe`)
    REFERENCES `gestao_esportiva`.`equipe` (`id_equipe`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_equipe_has_competicao_competicao1`
    FOREIGN KEY (`id_competicao`)
    REFERENCES `gestao_esportiva`.`competicao` (`id_competicao`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gestao_esportiva`.`partida`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gestao_esportiva`.`partida` (
  `id_partida` INT NOT NULL AUTO_INCREMENT,
  `id_competicao` INT NOT NULL,
  `resultado` VARCHAR(45) NOT NULL,
  `sumula` VARCHAR(1000) NOT NULL,
  PRIMARY KEY (`id_partida`),
  INDEX `fk_partida_competicao1_idx` (`id_competicao` ASC) VISIBLE,
  CONSTRAINT `fk_partida_competicao1`
    FOREIGN KEY (`id_competicao`)
    REFERENCES `gestao_esportiva`.`competicao` (`id_competicao`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gestao_esportiva`.`equipe_da_partida`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gestao_esportiva`.`equipe_da_partida` (
  `id_equipe` INT NOT NULL,
  `id_partida` INT NOT NULL,
  `pontuacao` INT NULL,
  PRIMARY KEY (`id_equipe`, `id_partida`),
  INDEX `fk_equipe_has_partida_partida1_idx` (`id_partida` ASC) VISIBLE,
  INDEX `fk_equipe_has_partida_equipe1_idx` (`id_equipe` ASC) VISIBLE,
  CONSTRAINT `fk_equipe_has_partida_equipe1`
    FOREIGN KEY (`id_equipe`)
    REFERENCES `gestao_esportiva`.`equipe` (`id_equipe`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_equipe_has_partida_partida1`
    FOREIGN KEY (`id_partida`)
    REFERENCES `gestao_esportiva`.`partida` (`id_partida`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gestao_esportiva`.`usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gestao_esportiva`.`usuario` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `senha` VARCHAR(255) NOT NULL,
  `nivel` ENUM('adm', 'colab') NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC) VISIBLE)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
