/* Create tables */
CREATE TABLE Constituency (
    Id varchar(50) NOT NULL PRIMARY KEY
);

CREATE TABLE party (
    Id varchar(50) NOT NULL PRIMARY KEY
);

CREATE TABLE Address (
    Id INT AUTO_INCREMENT NOT NULL,
    addressLine1 varchar(35) NOT NULL,
    addressLine2 varchar(35),
    addressLine3 varchar(20),
    post_code char(10) NOT NULL,
    constituency_Id varchar(50) NOT NULL,
    PRIMARY KEY (Id),
    FOREIGN KEY (constituency_Id) REFERENCES Constituency(Id)
);

CREATE TABLE Candidate (
  	Id INT AUTO_INCREMENT NOT NULL,
	DOB date NOT NULL,
    fname varchar(35) NOT NULL,
    lname varchar(35) NOT NULL,
    prev_fname varchar(20),
    prev_lname varchar(20),
    NINO char(10) NOT NULL,
    address_Id INT NOT NULL,
    party_Id varchar(50) NOT NULL,
    constituency_Id varchar(50) NOT NULL,
    PRIMARY KEY (Id),
    FOREIGN KEY (address_Id) REFERENCES Address(Id),
    FOREIGN KEY (party_Id) REFERENCES Party(Id),
    FOREIGN KEY (constituency_Id) REFERENCES Constituency(Id)
);	/* country and nationality were removed but are still in design*/

CREATE TABLE Administrator (
    Id INT AUTO_INCREMENT NOT NULL,
    DOB date NOT NULL,
    first_name varchar(20) NOT NULL,
    last_name varchar(20) NOT NULL,
    password varchar(45) NOT NULL,
    address_ID INT NOT NULL,
    PRIMARY KEY (Id),
    FOREIGN KEY (address_ID) REFERENCES Address(Id)
);

CREATE TABLE Voter (
  	Id varchar(6) NOT NULL,
    DOB date NOT NULL,
	Password varchar(20) NOT NULL,
    first_name varchar(20) NOT NULL,
    last_name varchar(20) NOT NULL,
    prev_first_name varchar(20),
    prev_last_name varchar(20),
    NINO varchar(10) NOT NULL,
    address_ID int NOT NULL,
    open_reg int(1) NOT NULL,
    postal_vote int(1) NOT NULL,
    only_resident int(1) NOT NULL,
    further_contact varchar(50) NOT NULL,
    expiry_date date NOT NULL,
    PRIMARY KEY (Id),
    FOREIGN KEY (address_ID) REFERENCES address(Id)
);

CREATE TABLE Election(
  id int AUTO_INCREMENT not null primary key,
  name varchar(45) not null,
  electionDate DATE
);

CREATE TABLE Vote (
  	Id varchar(6) NOT NULL,
    election_ID INT NOT NULL,
    candidate_ID INT NOT NULL,
   	PRIMARY KEY (Id,election_ID),
    FOREIGN KEY (Id) REFERENCES voter(Id),
    FOREIGN KEY (candidate_ID) REFERENCES candidate(Id),
    FOREIGN KEY (election_ID) REFERENCES election(Id)
);

/* Insert data */
/* Constituency */
INSERT INTO `constituency` (`Id`) VALUES ('Portsmouth South');

/* Party */
INSERT INTO `party` (`Id`)
VALUES ('Conservative'), ('Labour'),('Green'), ('UKIP'),('Liberal Democrats'), ('Independant');

/* Address */
INSERT INTO `address` (`Id`, `addressLine1`, `addressLine2`, `addressLine3`, `post_code`, `constituency_Id`)
values (NULL, '9 Portsmouth Road', '', '', 'PO1 O3F', 'Portsmouth South'),
(NULL, '20 Havant Street', '', '', 'PO1 3OP', 'Portsmouth South'),
(NULL, '253 London Road', '', '', 'PO1 9ET', 'Portsmouth South'),
(NULL, '12 Sutherland Road', '', '', 'PO4 0EY', 'Portsmouth South');

/* Candidate */
INSERT INTO `candidate` (`Id`, `DOB`, `fname`, `lname`, `prev_fname`, `prev_lname`, `NINO`, `address_Id`, `party_Id`, `constituency_Id`)
VALUES (NULL, '1978-08-20', 'Toby', 'Phillips', NULL, NULL, 'CH101312', '1', 'Conservative', 'Portsmouth South'),
(NULL, '1990-12-16', 'Caroline', 'Adams', NULL, NULL, 'TK102110', '4', 'Labour', 'Portsmouth South'),
(NULL, '1990-12-16', 'Sally', 'Adams', NULL, NULL, 'MC098657D', '3', 'Liberal Democrats', 'Portsmouth South');

/* Administrator */
INSERT INTO `administrator` (`Id`, `DOB`, `first_name`, `last_name`, `password`, `address_ID`)
VALUES (NULL, '1985-06-13', 'Nathan', 'Morgan', 'password123', '2');

/* Voter */
INSERT INTO `voter` (`Id`, `DOB`, `Password`,`first_name`, `last_name`, `prev_first_name`, `prev_last_name`, `NINO`, `address_ID`, `open_reg`, `postal_vote`, `only_resident`, `further_contact`, `expiry_date`)
VALUES ("AC-71", '1985-06-13', '1234' ,'Nathan', 'Morgan', NULL, NULL, 'SN078272D', '2', '0', '0', '1', 'NathanMorgan@gmail.com', '2020-04-05'),
("DI-63", '1978-08-20', 'password' ,'Toby', 'Phillips', NULL, NULL, 'CH101312', '1', '0', '0', '1', 'TP010@gmail.com', '2020-08-15'),
("OB-54", '1990-12-16', 'pass' ,'Caroline', 'Adams', NULL, NULL, 'TK102110', '4', '0', '0', '1', 'c.Adams94@gmail.com', '2020-03-03'),
("AT-92", '1986-11-12', 'pass' ,'Sally', 'Adams', NULL, NULL, 'MC098657D', '3', '0', '0', '1', 'c.Adams94@gmail.com', '2019-16-43');

/* Election */
INSERT INTO `election` (`id`, `name`, `electionDate`)
VALUES (NULL, 'General Election 2018', '2018-05-03');