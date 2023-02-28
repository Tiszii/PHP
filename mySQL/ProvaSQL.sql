DROP DATABASE IF EXISTS my_contatti;

CREATE DATABASE IF NOT EXISTS my_contatti DEFAULT CHARACTER SET = utf8;

USE my_contatti;

CREATE TABLE tcontatti (
    id_contatti                 BIGINT              NOT NULL    AUTO_INCREMENT,
    nome                        VARCHAR(20),        /* NULL */    
    cognome                     VARCHAR(20)         NOT NULL,
    codice_fiscale              CHAR(16)            UNIQUE,    
    data_nascita                DATE,
    ora_nascita                 TIME,    
    attivo                      BOOLEAN             DEFAULT    TRUE,
    PRIMARY KEY(id_contatti),
    INDEX icontatti (nome)    
) ENGINE = InnoDB;

CREATE TABLE ttelefoni (
    id_telefoni                 BIGINT              NOT NULL    AUTO_INCREMENT,
    numero                      VARCHAR(20),
    operatore                   VARCHAR(20),
    tipo                        ENUM('P', 'C', 'L'), /* Personale - Casa - Lavoro */
    fk_contatti                 BIGINT              NOT NULL,
    PRIMARY KEY(id_telefoni),
    INDEX itelefoni (numero),
    FOREIGN KEY(fk_contatti) REFERENCES tcontatti(id_contatti)
    ON DELETE CASCADE
    ON UPDATE CASCADE
) ENGINE = InnoDB;

CREATE TABLE toperatori (
    id_operatori                INT                 NOT NULL    AUTO_INCREMENT,
    nome                        VARCHAR(20),    
    PRIMARY KEY(id_operatori),
    INDEX ioperatori (nome)
) ENGINE = InnoDB;

CREATE TABLE tgruppi (
    id_gruppi                   BIGINT              NOT NULL    AUTO_INCREMENT,
    nome                        VARCHAR(20)         NOT NULL,
    PRIMARY KEY(id_gruppi),
    INDEX igruppi (nome)
) ENGINE = InnoDB;

CREATE TABLE tappartiene (    
    fk_contatti                 BIGINT              NOT NULL,
    fk_gruppi                   BIGINT              NOT NULL,
    PRIMARY KEY(fk_contatti, fk_gruppi),
    FOREIGN KEY(fk_contatti) REFERENCES tcontatti(id_contatti)
      ON UPDATE CASCADE
        ON DELETE CASCADE,    
    FOREIGN KEY(fk_gruppi) REFERENCES tgruppi(id_gruppi)
    ON UPDATE CASCADE
        ON DELETE CASCADE
) ENGINE = InnoDB;



--Aggiungere una colonna dopo la colonna cognome
ALTER TABLE tcontatti ADD COLUMN email VARCHAR(50) AFTER cognome;

--Modifica il tipo della colonna
ALTER TABLE ttelefoni MODIFY COLUMN numero BIGINT;

--Rinominare una colonna
ALTER TABLE tcontatti CHANGE nome nome_completo TEXT;

--Eliminare una colonna
ALTER TABLE tcontatti DROP COLUMN email;

--Aggiungi una FK a ttelefoni che fa riferimento a toperatori
ALTER TABLE ttelefoni
ADD CONSTRAINT fk_ttelefoni_toperatori
FOREIGN KEY (operatore) REFERENCES toperatori(nome)

/*
The following constraints are commonly used in SQL:
NOT NULL - Ensures that a column cannot have a NULL value
UNIQUE - Ensures that all values in a column are different
PRIMARY KEY - A combination of a NOT NULL and UNIQUE. Uniquely identifies each row in a table
FOREIGN KEY - Prevents actions that would destroy links between tables
CHECK - Ensures that the values in a column satisfies a specific condition
DEFAULT - Sets a default value for a column if no value is specified
CREATE INDEX - Used to create and retrieve data from the database very quickly
*/

/*--------------------------------------------------------------------------------------------------------------------------*/


/*add unique constraint on multiple columns --> single(ADD UNIQUE (ID);)*/
ALTER TABLE tcontatti
ADD CONSTRAINT uni UNIQUE (id_contatti,codice_fiscale);


/*--------------------------------------------------------------------------------------------------------------------------*/


/*add primary key constraint on multiple columns --> single(ADD PRIMARY KEY (ID);)*/
ALTER TABLE tcontatti
ADD CONSTRAINT pk_contatti UNIQUE (id_contatti,codice_fiscale);


/*----------------------------------------------------------------------------------------------------------------------------*/


/*add foreign key constraint on multiple columns --> single(ADD FOREIGN KEY (PersonID) REFERENCES Persons(PersonID);)*/
ALTER TABLE tcontatti
ADD CONSTRAINT fk_contatti
FOREIGN KEY (id_contatti,codice_fiscale) REFERENCES ttelefoni(id_telefoni,numero);


/*----------------------------------------------------------------------------------------------------------------------------*/


/*add check constraint on multiple columns --> single(ADD CHECK (Age>=18);)*/
ALTER TABLE ttelefoni
ADD CONSTRAINT checkNumero CHECK (numero=3456783456 AND id_telefoni=2);


/*----------------------------------------------------------------------------------------------------------------------------*/


/*add default value*/
ALTER TABLE tcontatti
ALTER nome SET DEFAULT 'nome';


/*----------------------------------------------------------------------------------------------------------------------------*/


/*add index on multiple columns*/
CREATE INDEX indiceProva
ON tcontatti (nome, cognome);

/*add index on single column*/
CREATE INDEX indiceprova
ON ttelefoni (id_telefoni);

/*drop index*/
ALTER TABLE tcontatti
DROP INDEX indiceProva;


/*----------------------------------------------------------------------------------------------------------------------------*/


ALTER TABLE tcontatti AUTO_INCREMENT=100;


/*----------------------------------------------------------------------------------------------------------------------------*/


/*create a view and visualize it*/
CREATE VIEW [Contatti] AS
SELECT nome, cognome
FROM tcontatti
LIMIT 2;

SELECT * FROM [Contatti];

/*----------------------------------------------------------------------------------------------------------------------------*/

-- and, not, or
SELECT * FROM tcontatti
WHERE NOT nome='Mario' AND NOT cognome='Rossi';


--order by ordina in base al come crescente e al cognome decrescente
SELECT * FROM tcontatti
ORDER BY nome ASC, cognome DESC;


--insert into
INSERT INTO tcontatti (nome,cognome)
VALUES ('Mario','Rossi');

INSERT INTO ttelefoni (numero,fk_contatti)
VALUES ('3246623488','1');


--Null values
SELECT nome, cognome, codice_fiscale
FROM tcontatti
WHERE data_nascita IS NOT NULL;


--update
UPDATE ttelefoni
SET numero = 3246623488
WHERE fk_contatti = 1;


--delete
DELETE FROM tcontatti WHERE nome='Mario';


--limit
SELECT * FROM ttelefoni
WHERE operatore='Tim'
LIMIT 20;


--min() e max()
SELECT MIN(numero) AS NumeroPiuPiccolo
FROM ttelefoni;


--count(), avg(), sum()
SELECT COUNT(id_contatti)
FROM tcontatti;

SELECT AVG(id_contatti)
FROM tcontatti;

SELECT SUM(id_contatti)
FROM tcontatti;


--like
/*
LIKE 'a%'	Finds any values that start with "a"
LIKE '%a'	Finds any values that end with "a"
LIKE '%or%'	Finds any values that have "or" in any position
LIKE '_r%'	Finds any values that have "r" in the second position
LIKE 'a_%'	Finds any values that start with "a" and are at least 2 characters in length
LIKE 'a__%'	Finds any values that start with "a" and are at least 3 characters in length
LIKE 'a%o'	Finds any values that start with "a" and ends with "o"
*/

SELECT * FROM tcontatti
WHERE nome LIKE '%M____';

SELECT * FROM tcontatti
WHERE nome LIKE 'M%o';

SELECT * FROM tcontatti
WHERE nome LIKE '%Mar%';


SELECT *
FROM tcontatti
INNER JOIN ttelefoni
ON tcontatti.id_contatti = ttelefoni.fk_contatti;

SELECT *
FROM tcontatti, ttelefoni
WHERE tcontatti.id_contatti = ttelefoni.fk_contatti;

SELECT *
FROM tcontatti
INNER JOIN ttelefoni
ON tcontatti.id_contatti = ttelefoni.fk_contatti
INNER JOIN toperatori
ON ttelefoni.operatore = toperatori.nome;

SELECT *
FROM tcontatti, ttelefoni toperatori
WHERE tcontatti.id_contatti = ttelefoni.fk_contatti AND ttelefoni.operatore = toperatori.nome;
