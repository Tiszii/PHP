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
INSERT INTO tcontatti (nome, cognome, codice_fiscale, data_nascita, ora_nascita)
VALUES ('Mario', 'Rossi', 'RSSMRA80A01A001B', '1980-01-01', '12:00:00');

INSERT INTO ttelefoni (numero, operatore, tipo, fk_contatti)
VALUES ('3331234567', 'Vodafone', 'P', 4);

INSERT INTO toperatori (nome)
VALUES ('Tim');

INSERT INTO tgruppi (nome)
VALUES ('Amici');

INSERT INTO tappartiene (fk_contatti, fk_gruppi)
VALUES (1, 1);


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





ALTER TABLE tcontatti
ADD COLUMN Citta varchar(50);

UPDATE tcontatti 
SET Citta = 'Trento' 
WHERE tcontatti.id_contatti = 4;




--1
SELECT Citta, Count(*) AS NumeroContatti
FROM tcontatti
GROUP BY Citta;


--2
SELECT Citta, GROUP_CONCAT(Nome,' ',Cognome, SEPARATOR ',') AS NumeroContatti
FROM tcontatti
GROUP BY Citta;


--3
SELECT *
FROM tcontatti
WHERE tcontatti.data_nascita=(
    SELECT MAX(tcontatti.data_nascita)
    FROM tcontatti
);


--4
SELECT *
FROM tcontatti,ttelefoni
WHERE ttelefoni.fk_contatti=tcontatti.id_contatti AND ttelefoni.operatore='VODAFONE';


--5
SELECT ttelefoni.operatore AS Operatore, COUNT(*) AS NumeroContatti
FROM tcontatti,ttelefoni
WHERE ttelefoni.fk_contatti=tcontatti.id_contatti
GROUP BY ttelefoni.operatore;


--6
SELECT operatore AS Operatore, COUNT(*) AS NumeroContatti
FROM ttelefoni
GROUP BY operatore
HAVING COUNT(*)=(
	SELECT COUNT(*)
	FROM ttelefoni
	GROUP BY operatore
	ORDER BY COUNT(*) ASC
	LIMIT 1
)
ORDER BY operatore ASC;





--IN: Selezionare i contatti che appartengono a uno o più gruppi specifici:

SELECT *
FROM tcontatti
WHERE id_contatti IN (
SELECT fk_contatti
FROM tappartiene
WHERE fk_gruppi IN (1, 2, 3)
);




--Wildcard: Selezionare i contatti il cui cognome inizia con la lettera 'A':

SELECT *
FROM tcontatti
WHERE cognome LIKE 'A%';

--Selezionare i contatti il cui nome contiene la lettera 'o':
SELECT *
FROM tcontatti
WHERE nome LIKE '%o%';




--Between: Selezionare i contatti nati tra il 1° gennaio 1990 e il 31 dicembre 1995:

SELECT *
FROM tcontatti
WHERE data_nascita BETWEEN '1990-01-01' AND '1995-12-31';

--Selezionare i contatti che hanno un numero di telefono con un valore tra 1000 e 9999:
SELECT *
FROM ttelefoni
WHERE numero BETWEEN '1000' AND '9999';



--Aliases: Selezionare il nome del contatto, il numero di telefono e il nome dell'operatore per i numeri di telefono di tipo 'C':
SELECT c.nome, t.numero, o.nome AS operatore
FROM tcontatti c
JOIN ttelefoni t ON c.id_contatti = t.fk_contatti
JOIN toperatori o ON t.operatore = o.id_operatori
WHERE t.tipo = 'C';




--join:Selezionare il nome del contatto e il nome del gruppo a cui appartiene:
SELECT c.nome, g.nome
FROM tcontatti c
JOIN tappartiene ap ON c.id_contatti = ap.fk_contatti
JOIN tgruppi g ON ap.fk_gruppi = g.id_gruppi;



--Inner join:Selezionare il nome del contatto e il nome del gruppo a cui appartiene solo se il contatto appartiene a almeno un gruppo:
SELECT c.nome, g.nome
FROM tcontatti c
JOIN tappartiene ap ON c.id_contatti = ap.fk_contatti
JOIN tgruppi g ON ap.fk_gruppi = g.id_gruppi;



--CrossJoin :Restituisce il nome del contatto e il nome del gruppo a cui appartiene, per tutte le possibili combinazioni
SELECT c.nome, g.nome
FROM tcontatti c
CROSS JOIN tgruppi g;



--Self join : Restituisce il nome del contatto e il nome dei contatti associati ai gruppi a cui appartiene
SELECT c1.nome, c2.nome
FROM tcontatti c1
JOIN tappartiene a ON c1.id_contatti = a.fk_contatti
JOIN tcontatti c2 ON c2.id_contatti = a.fk_contatti;



--Right join Restituisce il nome del contatto e il numero di telefono associato, incluso il nome dell'operatore, 
--per tutti i numeri di telefono, incluso quelli non associati ad alcun contatto
SELECT c.nome, t.numero, o.nome AS operatore
FROM ttelefoni t
RIGHT JOIN tcontatti c ON t.fk_contatti = c.id_contatti
LEFT JOIN toperatori o ON t.operatore = o.id_operatori;



--left join Restituisce il nome dei gruppi e il nome del contatto, se presente, che appartiene al gruppo, per tutti i gruppi
SELECT g.nome AS gruppo, c.nome AS contatto
FROM tgruppi g
LEFT JOIN tappartiene a ON g.id_gruppi = a.fk_gruppi
LEFT JOIN tcontatti c ON a.fk_contatti = c.id_contatti;


--group by Restituisce il nome dell'operatore e il numero di telefoni associati, per ogni operatore, in ordine decrescente di numero di telefoni
SELECT o.nome AS operatore, COUNT(t.id_telefoni) AS num_telefoni
FROM ttelefoni t
LEFT JOIN toperatori o ON t.operatore = o.id_operatori
GROUP BY o.id_operatori
ORDER BY num_telefoni DESC;


--having Restituisce il nome dei gruppi con almeno tre contatti appartenenti
SELECT g.nome AS gruppo, COUNT(c.id_contatti) AS num_contatti
FROM tgruppi g
LEFT JOIN tappartiene a ON g.id_gruppi = a.fk_gruppi
LEFT JOIN tcontatti c ON a.fk_contatti = c.id_contatti
GROUP BY g.id_gruppi
HAVING num_contatti >= 3;


--exist Restituisce il nome dei contatti che hanno almeno un numero di telefono associato
SELECT nome, cognome
FROM tcontatti
WHERE EXISTS (SELECT * FROM ttelefoni WHERE ttelefoni.fk_contatti = tcontatti.id_contatti);


--Any/all Restituisce il nome dei contatti che hanno almeno un numero di telefono associato con l'operatore "Vodafone"
SELECT nome, cognome
FROM tcontatti
WHERE id_contatti = ANY (SELECT fk_contatti FROM ttelefoni WHERE operatore = 'Vodafone');


--Case Restituisce il nome e il cognome dei contatti e, se hanno un numero di telefono personale, 
-- restituisce "SI" nella colonna "ha_telefono_personale", altrimenti restituisci "NO"
SELECT 
    nome, 
    cognome, 
    CASE 
        WHEN EXISTS (SELECT * FROM ttelefoni WHERE fk_contatti = tcontatti.id_contatti AND tipo = 'P') 
            THEN 'SI'
        ELSE 'NO'
    END AS ha_telefono_personale
FROM tcontatti;


--Insert Select
INSERT INTO tcontatti_telefonopersonale (nome, cognome, codice_fiscale, data_nascita, ora_nascita, attivo)
SELECT 
    nome, 
    cognome, 
    codice_fiscale, 
    data_nascita, 
    ora_nascita, 
    attivo 
FROM tcontatti 