SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `mydb` ;

-- -----------------------------------------------------
-- Table `mydb`.`summoner`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`summoner` (
  `id` INT NOT NULL,
  `name` VARCHAR(45) NULL,
  `tier` VARCHAR(45) NULL,
  `rank` VARCHAR(45) NULL,
  `lp` VARCHAR(45) NULL,
  `wins` VARCHAR(45) NULL,
  `lastupdate` DATETIME NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`permission`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`permission` (
  `id` INT NOT NULL,
  `label` VARCHAR(45) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`user` (
  `id` INT NOT NULL,
  `name` VARCHAR(45) NULL,
  `password` VARCHAR(45) NULL,
  `summoner_id` INT NOT NULL,
  `permission_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_user_summoner_idx` (`summoner_id` ASC),
  INDEX `fk_user_permission1_idx` (`permission_id` ASC),
  CONSTRAINT `fk_user_summoner`
    FOREIGN KEY (`summoner_id`)
    REFERENCES `mydb`.`summoner` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_permission1`
    FOREIGN KEY (`permission_id`)
    REFERENCES `mydb`.`permission` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`post`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`post` (
  `id` INT NOT NULL,
  `description` MEDIUMTEXT NULL,
  `lien` VARCHAR(45) NULL,
  `user_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_post_user1_idx` (`user_id` ASC),
  CONSTRAINT `fk_post_user1`
    FOREIGN KEY (`user_id`)
    REFERENCES `mydb`.`user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`comment`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`comment` (
  `id` INT NOT NULL,
  `text` TEXT NULL,
  `post_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_comment_post1_idx` (`post_id` ASC),
  CONSTRAINT `fk_comment_post1`
    FOREIGN KEY (`post_id`)
    REFERENCES `mydb`.`post` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`note`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`note` (
  `id` INT NOT NULL,
  `plus` TINYINT(1) NULL,
  `user_id` INT NOT NULL,
  `post_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_note_user1_idx` (`user_id` ASC),
  INDEX `fk_note_post1_idx` (`post_id` ASC),
  CONSTRAINT `fk_note_user1`
    FOREIGN KEY (`user_id`)
    REFERENCES `mydb`.`user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_note_post1`
    FOREIGN KEY (`post_id`)
    REFERENCES `mydb`.`post` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
