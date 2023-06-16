-- MySQL Workbench Forward Engineering

DROP SCHEMA IF EXISTS `primebank`;

CREATE SCHEMA `primebank` DEFAULT CHARACTER SET utf8 ;

USE `primebank`;

-- -----------------------------------------------------

-- Table `primebank`.`usuarios`

-- -----------------------------------------------------

CREATE TABLE
    IF NOT EXISTS `primebank`.`usuario` (
        `id` INT NOT NULL AUTO_INCREMENT,
        `nome` VARCHAR(100) NOT NULL,
        `email` VARCHAR(50) NOT NULL,
        `senha` VARCHAR(45) NOT NULL,
        `documento` VARCHAR(14) NOT NULL,
        `data_nasc` DATE NULL,
        `data_cadastro` DATETIME GENERATED ALWAYS AS (NOW()) VIRTUAL,
        `tipo` INT NULL,
        PRIMARY KEY (`id`)
    ) ENGINE = InnoDB;

-- -----------------------------------------------------

-- Table `Banco`.`banco`

-- -----------------------------------------------------

CREATE TABLE
    IF NOT EXISTS `primebank`.`banco` (
        `id` INT NOT NULL AUTO_INCREMENT,
        `numero` INT NULL,
        `nome` VARCHAR(45) NULL,
        PRIMARY KEY (`id`)
    ) ENGINE = InnoDB;

-- -----------------------------------------------------

-- Table `Banco`.`agencia`

-- -----------------------------------------------------

CREATE TABLE
    IF NOT EXISTS `primebank`.`agencia` (
        `id` INT NOT NULL AUTO_INCREMENT,
        `id_banco` INT NOT NULL,
        `nome` VARCHAR(45) NULL,
        `numero` INT NOT NULL,
        PRIMARY KEY (`id`),
        INDEX `fk_agencia_banco1_idx` (`id_banco` ASC),
        CONSTRAINT `fk_agencia_banco1` FOREIGN KEY (`id_banco`) REFERENCES `primebank`.`banco` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
    ) ENGINE = InnoDB;

-- -----------------------------------------------------

-- Table `Banco`.`conta`

-- -----------------------------------------------------

CREATE TABLE
    IF NOT EXISTS `primebank`.`conta` (
        `id` INT NOT NULL AUTO_INCREMENT,
        `numero` INT NOT NULL,
        `tipo_conta` INT NOT NULL,
        `saldo` FLOAT NULL,
        `id_agencia` INT NOT NULL,
        `id_usuario` INT NOT NULL,
        PRIMARY KEY (`id`),
        INDEX `fk_conta_usuario_idx` (`id_usuario` ASC),
        INDEX `fk_conta_agencia1_idx` (`id_agencia` ASC),
        CONSTRAINT `fk_conta_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `primebank`.`usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
        CONSTRAINT `fk_conta_agencia1` FOREIGN KEY (`id_agencia`) REFERENCES `primebank`.`agencia` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
    ) ENGINE = InnoDB;

-- -----------------------------------------------------

-- Table `Banco`.`extrato`

-- -----------------------------------------------------

CREATE TABLE
    IF NOT EXISTS `primebank`.`extrato` (
        `id` INT NOT NULL AUTO_INCREMENT,
        `id_conta` INT NOT NULL,
        `valor` FLOAT NOT NULL,
        `acao` VARCHAR(10) NOT NULL,
        `data_cadastro` DATETIME GENERATED ALWAYS AS (NOW()) VIRTUAL,
        PRIMARY KEY (`id`),
        INDEX `fk_extrato_conta1_idx` (`id_conta` ASC),
        CONSTRAINT `fk_extrato_conta1` FOREIGN KEY (`id_conta`) REFERENCES `primebank`.`conta` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
    ) ENGINE = InnoDB;

-- -----------------------------------------------------

-- Table `Banco`.`emprestimo`

-- -----------------------------------------------------

CREATE TABLE
    IF NOT EXISTS `primebank`.`emprestimo` (
        `id` INT NOT NULL AUTO_INCREMENT,
        `id_conta` INT NOT NULL,
        `valor` FLOAT NULL,
        `taxa` FLOAT NULL,
        `parcelas` INT NULL,
        `parcelas_pagas` INT NULL,
        PRIMARY KEY (`id`),
        INDEX `fk_emprestimo_conta1_idx` (`id_conta` ASC),
        CONSTRAINT `fk_emprestimo_conta1` FOREIGN KEY (`id_conta`) REFERENCES `primebank`.`conta` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
    ) ENGINE = InnoDB;

-- -----------------------------------------------------

-- Table `Banco`.`investimento`

-- -----------------------------------------------------

CREATE TABLE
    IF NOT EXISTS `primebank`.`investimento` (
        `id` INT NOT NULL AUTO_INCREMENT,
        `id_conta` INT NOT NULL,
        `tipo_investimento` VARCHAR(45) NULL,
        `taxa` FLOAT NULL,
        `valor` FLOAT NULL,
        `valor_taxado` FLOAT NULL,
        PRIMARY KEY (`id`),
        INDEX `fk_investimento_conta1_idx` (`id_conta` ASC),
        CONSTRAINT `fk_investimento_conta1` FOREIGN KEY (`id_conta`) REFERENCES `primebank`.`conta` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
    ) ENGINE = InnoDB;

INSERT INTO
    `primebank`.`banco` (nome, numero)
VALUES ('Primebank', 1);

INSERT INTO
    `primebank`.`usuario` (
        nome,
        email,
        senha,
        documento,
        data_nasc,
        tipo
    )
VALUES (
        'Admin Primebank',
        'admin@primebank.com.br',
        '123456',
        '12345678910',
        '2023-06-16',
        1
    );