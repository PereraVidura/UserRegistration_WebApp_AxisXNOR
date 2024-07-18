create database adminpanel; 

use adminpanel;

CREATE TABLE register (
    Id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    FirstName VARCHAR(50),
    LastName VARCHAR(50),
    Email VARCHAR(50),
    Address VARCHAR(200),
    PhoneNumber INT(15),
    Password VARCHAR(255),
	ProfileImage VARCHAR(255),
    HowHear VARCHAR(50),
    Gender VARCHAR(100),
    AgreeTerm tinyint(4),
	OTP VARCHAR(10)
);

DESC register;

SELECT * FROM register;



CREATE TABLE users (
    Id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    Name VARCHAR(50),
    Email VARCHAR(50),
    PhoneNumber INT(15),
    ProfileImage VARCHAR(255),
    Added_by VARCHAR(255)
);

DESC users;

SELECT * FROM users;




