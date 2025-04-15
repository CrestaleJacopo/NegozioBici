-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema negoziobici
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema negoziobici
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `negoziobici` DEFAULT CHARACTER SET utf8mb4 ;
USE `negoziobici` ;

-- -----------------------------------------------------
-- Table `negoziobici`.`articoli`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `negoziobici`.`articoli` (
  `id` INT(11) NOT NULL,
  `nome` CHAR(50) NOT NULL,
  `foto` CHAR(50) NOT NULL,
  `prezzo` INT(11) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `negoziobici`.`cache`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `negoziobici`.`cache` (
  `key` VARCHAR(255) NOT NULL,
  `value` MEDIUMTEXT NOT NULL,
  `expiration` INT(11) NOT NULL,
  PRIMARY KEY (`key`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `negoziobici`.`cache_locks`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `negoziobici`.`cache_locks` (
  `key` VARCHAR(255) NOT NULL,
  `owner` VARCHAR(255) NOT NULL,
  `expiration` INT(11) NOT NULL,
  PRIMARY KEY (`key`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `negoziobici`.`failed_jobs`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `negoziobici`.`failed_jobs` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` VARCHAR(255) NOT NULL,
  `connection` TEXT NOT NULL,
  `queue` TEXT NOT NULL,
  `payload` LONGTEXT NOT NULL,
  `exception` LONGTEXT NOT NULL,
  `failed_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  PRIMARY KEY (`id`),
  UNIQUE INDEX `failed_jobs_uuid_unique` (`uuid` ASC) VISIBLE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `negoziobici`.`job_batches`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `negoziobici`.`job_batches` (
  `id` VARCHAR(255) NOT NULL,
  `name` VARCHAR(255) NOT NULL,
  `total_jobs` INT(11) NOT NULL,
  `pending_jobs` INT(11) NOT NULL,
  `failed_jobs` INT(11) NOT NULL,
  `failed_job_ids` LONGTEXT NOT NULL,
  `options` MEDIUMTEXT NULL DEFAULT NULL,
  `cancelled_at` INT(11) NULL DEFAULT NULL,
  `created_at` INT(11) NOT NULL,
  `finished_at` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `negoziobici`.`jobs`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `negoziobici`.`jobs` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `queue` VARCHAR(255) NOT NULL,
  `payload` LONGTEXT NOT NULL,
  `attempts` TINYINT(3) UNSIGNED NOT NULL,
  `reserved_at` INT(10) UNSIGNED NULL DEFAULT NULL,
  `available_at` INT(10) UNSIGNED NOT NULL,
  `created_at` INT(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `jobs_queue_index` (`queue` ASC) VISIBLE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `negoziobici`.`migrations`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `negoziobici`.`migrations` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` VARCHAR(255) NOT NULL,
  `batch` INT(11) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `negoziobici`.`utenti`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `negoziobici`.`utenti` (
  `nome` CHAR(50) NOT NULL,
  `password` CHAR(50) NULL DEFAULT NULL,
  `ruolo` CHAR(50) CHARACTER SET 'utf8' NULL DEFAULT NULL,
  `email` CHAR(100) CHARACTER SET 'utf8' NULL DEFAULT NULL,
  `confermato` CHAR(2) CHARACTER SET 'utf8' NULL DEFAULT 'no',
  `hash` CHAR(50) CHARACTER SET 'utf8' NULL DEFAULT NULL,
  PRIMARY KEY (`nome`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin;


-- -----------------------------------------------------
-- Table `negoziobici`.`ordini`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `negoziobici`.`ordini` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nomeCliente` CHAR(50) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NULL DEFAULT NULL,
  `idArticolo` INT(11) NULL DEFAULT NULL,
  `prezzo` INT(11) NULL DEFAULT NULL,
  `dataOra` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP(),
  PRIMARY KEY (`id`),
  INDEX `FK_ordini_articoli` (`idArticolo` ASC) VISIBLE,
  INDEX `nomeCliente` (`nomeCliente` ASC) VISIBLE,
  CONSTRAINT `FK_ordini_articoli`
    FOREIGN KEY (`idArticolo`)
    REFERENCES `negoziobici`.`articoli` (`id`),
  CONSTRAINT `FK_ordini_utenti`
    FOREIGN KEY (`nomeCliente`)
    REFERENCES `negoziobici`.`utenti` (`nome`))
ENGINE = InnoDB
AUTO_INCREMENT = 44
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `negoziobici`.`password_reset_tokens`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `negoziobici`.`password_reset_tokens` (
  `email` VARCHAR(255) NOT NULL,
  `token` VARCHAR(255) NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`email`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `negoziobici`.`sessions`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `negoziobici`.`sessions` (
  `id` VARCHAR(255) NOT NULL,
  `user_id` BIGINT(20) UNSIGNED NULL DEFAULT NULL,
  `ip_address` VARCHAR(45) NULL DEFAULT NULL,
  `user_agent` TEXT NULL DEFAULT NULL,
  `payload` LONGTEXT NOT NULL,
  `last_activity` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `sessions_user_id_index` (`user_id` ASC) VISIBLE,
  INDEX `sessions_last_activity_index` (`last_activity` ASC) VISIBLE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `negoziobici`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `negoziobici`.`users` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `email_verified_at` TIMESTAMP NULL DEFAULT NULL,
  `password` VARCHAR(255) NOT NULL,
  `remember_token` VARCHAR(100) NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  `ruolo` VARCHAR(50) NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `users_email_unique` (`email` ASC) VISIBLE)
ENGINE = InnoDB
AUTO_INCREMENT = 8
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
