-- MySQL Workbench Forward Engineering

DROP SCHEMA IF EXISTS `primebank`;

CREATE SCHEMA `primebank` DEFAULT CHARACTER SET utf8 ;

USE `primebank`;

-- -----------------------------------------------------

-- Table `primebank`.`usuarios`

-- -----------------------------------------------------

CREATE TABLE
    IF NOT EXISTS `primebank`.`usuarios` (
        `id` INT NOT NULL AUTO_INCREMENT,
        `nome` VARCHAR(100) NOT NULL,
        `email` VARCHAR(60) NOT NULL,
        `senha` VARCHAR(32) NOT NULL,
        `documento` VARCHAR(14) NOT NULL,
        `data_nasc` DATE NULL,
        `data_cadastro` DATETIME(1) GENERATED ALWAYS AS (NOW()) VIRTUAL,
        `tipo` INT NOT NULL,
        PRIMARY KEY (`id`)
    ) ENGINE = InnoDB;

-- -----------------------------------------------------

-- Table `primebank`.`contas`

-- -----------------------------------------------------

CREATE TABLE
    IF NOT EXISTS `primebank`.`contas` (
        `agencia` INT NOT NULL,
        `numero` INT NOT NULL,
        `tipo_conta` INT NOT NULL,
        `saldo` FLOAT NULL,
        `usuarios_id` INT NOT NULL,
        PRIMARY KEY (`agencia`, `numero`),
        INDEX `fk_contas_usuarios_idx` (`usuarios_id` ASC),
        CONSTRAINT `fk_contas_usuarios` FOREIGN KEY (`usuarios_id`) REFERENCES `primebank`.`usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
    ) ENGINE = InnoDB;

-- -----------------------------------------------------

-- Table `primebank`.`extratos`

-- -----------------------------------------------------

CREATE TABLE
    IF NOT EXISTS `primebank`.`extratos` (
        `id` INT NOT NULL AUTO_INCREMENT,
        `valor` FLOAT NOT NULL,
        `acao` VARCHAR(8) NOT NULL,
        `data_cadastro` DATETIME(1) GENERATED ALWAYS AS (NOW()) VIRTUAL,
        `contas_agencia` INT NOT NULL,
        `contas_numero` INT NOT NULL,
        PRIMARY KEY (`id`),
        INDEX `fk_extratos_contas1_idx` (
            `contas_agencia` ASC,
            `contas_numero` ASC
        ),
        CONSTRAINT `fk_extratos_contas1` FOREIGN KEY (
            `contas_agencia`,
            `contas_numero`
        ) REFERENCES `primebank`.`contas` (`agencia`, `numero`) ON DELETE NO ACTION ON UPDATE NO ACTION
    )