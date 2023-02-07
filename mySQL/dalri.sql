CREATE DATABASE testDb
CREATE DATABASE IF NOT EXISTS testDb;

/*SHOW DATABASES;*/

DROP DATABASE testDb

/* with differential --> only with new changes*/
BACKUP DATABASE my_db
TO DISK = 'C:\my_db_backup.bak';

/*Restore Database From Backup*/
RESTORE DATABASE my_db
FROM DISK = 'C:\my_db_backup.bak';

CREATE TABLE Persons(
  PersonID int,
  LastName varchar(255),
  FirstName varchar(255),
  Address varchar(255),
  City varchar(255) 
);

DROP TABLE IF EXISTS Persons;

CREATE TABLE TestTable AS
SELECT customername, contactname
FROM customers;	/* crea una nuova tabella TestTable con delle colonne prese dalla tabella costumers*/

TRUNCATE TABLE Persons		/* usato per eliminare il contenuto di una tabella*/

ALTER TABLE Persons
ADD Birthday DATE;

ALTER TABLE Persons
DROP COLUMN Birthday;

ALTER TABLE Customers
RENAME TO newCustomers;

ALTER TABLE Persons
RENAME COLUMN PersonID TO P_id;

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

/* unique constraint on multiple columns --> single (UNIQUE (ID))*/
CREATE TABLE Persons (
    ID int NOT NULL,
    LastName varchar(255) NOT NULL,
    FirstName varchar(255),
    Age int,
    CONSTRAINT UC_Person UNIQUE (ID,LastName)
);

/*add unique constraint on multiple columns --> single(ADD UNIQUE (ID);)*/
ALTER TABLE Persons
ADD CONSTRAINT UC_Person UNIQUE (ID,LastName);


/*--------------------------------------------------------------------------------------------------------------------------*/


/* primary key constraint on multiple columns --> single(PRIMARY KEY (ID))*/
CREATE TABLE Persons (
    ID int NOT NULL,
    LastName varchar(255) NOT NULL,
    FirstName varchar(255),
    Age int,
    CONSTRAINT PK_Person PRIMARY KEY (ID,LastName)
);

/*add primary key constraint on multiple columns --> single(ADD PRIMARY KEY (ID);)*/
ALTER TABLE Persons
ADD CONSTRAINT UC_Person UNIQUE (ID,LastName);


/*----------------------------------------------------------------------------------------------------------------------------*/


/* foreign key constraint on multiple columns --> single(FOREIGN KEY (PersonID) REFERENCES Persons(PersonID))*/
CREATE TABLE Orders (
    OrderID int NOT NULL,
    OrderNumber int,
    PersonID int,
    PRIMARY KEY (OrderID),
    CONSTRAINT FK_PersonOrder FOREIGN KEY (PersonID,OrderNumber)
    REFERENCES Persons(PersonID,age)
);

/*add foreign key constraint on multiple columns --> single(ADD FOREIGN KEY (PersonID) REFERENCES Persons(PersonID);)*/
ALTER TABLE Orders
ADD CONSTRAINT FK_PersonOrder
FOREIGN KEY (PersonID,OrderNumber) REFERENCES Persons(PersonID,age);


/*----------------------------------------------------------------------------------------------------------------------------*/


/*add check constraint on multiple columns --> single(CHECK (Age>=18))*/
CREATE TABLE Persons (
    ID int NOT NULL,
    LastName varchar(255) NOT NULL,
    FirstName varchar(255),
    Age int,
    City varchar(255),
    CONSTRAINT CHK_Person CHECK (Age>=18 AND City='Sandnes')
);

/*add check constraint on multiple columns --> single(ADD CHECK (Age>=18);)*/
ALTER TABLE Persons
ADD CONSTRAINT CHK_PersonAge CHECK (Age>=18 AND City='Sandnes');


/*----------------------------------------------------------------------------------------------------------------------------*/


/*add default value (DEFAULT 'Sandnes')*/
CREATE TABLE Persons (
    ID int NOT NULL,
    LastName varchar(255) NOT NULL,
    FirstName varchar(255),
    Age int,
    City varchar(255) DEFAULT 'Sandnes'
);

ALTER TABLE Persons
ALTER City SET DEFAULT 'Sandnes';
ALTER City DROP DEFAULT;


/*----------------------------------------------------------------------------------------------------------------------------*/


/*add index on multiple columns*/
CREATE INDEX idx_pname
ON Persons (LastName, FirstName);

/*add index on single column*/
CREATE INDEX idx_pname
ON Persons (LastName, FirstName);

/*drop index*/
ALTER TABLE table_name
DROP INDEX index_name;


/*----------------------------------------------------------------------------------------------------------------------------*/


/*PersonID is AUTO_INCREMENT*/
CREATE TABLE Persons (
    Personid int NOT NULL AUTO_INCREMENT,
    LastName varchar(255) NOT NULL,
    FirstName varchar(255),
    Age int,
    PRIMARY KEY (Personid)
);

/*???????????????????*/
ALTER TABLE Persons AUTO_INCREMENT=100;


/*----------------------------------------------------------------------------------------------------------------------------*/


/*create a view and visualize it*/
CREATE VIEW [Brazil Customers] AS
SELECT CustomerName, ContactName
FROM Customers
WHERE Country = 'Brazil';

SELECT * FROM [Brazil Customers];


/*----------------------------------------------------------------------------------------------------------------------------*/


/*inserisce valori dentro la tabella specificato, se un attributo è autoincrement non serve inserirlo. Serve inserire gli attributi not null*/
INSERT INTO Customers(first_name, last_name, age, country)
VALUES
('Harry', 'Potter', 31, 'USA'),
('Chris', 'Hemsworth', 43, 'USA'),
('Tom', 'Holland', 26, 'UK');


/*----------------------------------------------------------------------------------------------------------------------------*/


/* aggiorna/modifica il valore first name e last name quando il costumer id =1 dalla tabella costumers*/
UPDATE Customers
SET first_name = 'Johnny', last_name = 'Depp'
WHERE customer_id = 1;


/*----------------------------------------------------------------------------------------------------------------------------*/

/*The SELECT INTO statement creates a new table. If the database already has a table with the same name, SELECT INTO gives an error.*/
SELECT *
INTO CustomersCopy
FROM Customers;


/*----------------------------------------------------------------------------------------------------------------------------*/


/*Old
the database must already have a table named OldCustomers
the column names of the OldCustomers table and the Customers table must match*/
INSERT INTO OldCustomers
SELECT *
FROM Customers;


/*----------------------------------------------------------------------------------------------------------------------------*/


/*the SQL command will delete a row from the Customers table where customer_id is 5.*/
DELETE FROM Customers
WHERE customer_id = 5;


/*----------------------------------------------------------------------------------------------------------------------------*/

/*
Some of The Most Important SQL Commands
SELECT - extracts data from a database
UPDATE - updates data in a database
DELETE - deletes data from a database
INSERT INTO - inserts new data into a database
CREATE DATABASE - creates a new database
ALTER DATABASE - modifies a database
CREATE TABLE - creates a new table
ALTER TABLE - modifies a table
DROP TABLE - deletes a table
CREATE INDEX - creates an index (search key)
DROP INDEX - deletes an index
*/

/*selezione "country" senza duplicati da costumers*/
SELECT DISTINCT Country FROM Customers;

/*conta quante "country" senza duplicati ci sono da costumers*/
SELECT COUNT(DISTINCT Country) FROM Customers;


/*----------------------------------------------------------------------------------------------------------------------------*/


/*seleziona tutte le istanze che hanno "country " = MEXICO*/
SELECT * FROM Customers
WHERE Country = 'Mexico';

/*
=	Equal	
>	Greater than	
<	Less than	
>=	Greater than or equal	
<=	Less than or equal	
<>	Not equal. Note: In some versions of SQL this operator may be written as !=	
BETWEEN	Between a certain range	
LIKE	Search for a pattern	
IN	To specify multiple possible values for a column
*/
