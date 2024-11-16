CREATE DATABASE ClinicDashboard;

USE ClinicDashboard;

CREATE TABLE Departments (
    DepartmentID INT PRIMARY KEY AUTO_INCREMENT,
    Name VARCHAR(100) NOT NULL
);

CREATE TABLE Students (
    StudentID INT PRIMARY KEY AUTO_INCREMENT,
    FirstName VARCHAR(50) NOT NULL,
    LastName VARCHAR(50) NOT NULL,
    DateOfBirth DATE NOT NULL,
    Gender ENUM('Male', 'Female', 'Other') NOT NULL,
    DepartmentID INT NOT NULL,
    FOREIGN KEY (DepartmentID) REFERENCES Departments(DepartmentID)
);

CREATE TABLE Visits (
    VisitID INT PRIMARY KEY AUTO_INCREMENT,
    StudentID INT NOT NULL,
    VisitDate DATETIME NOT NULL,
    Reason TEXT NOT NULL,
    DepartmentID INT NOT NULL,
    FOREIGN KEY (StudentID) REFERENCES Students(StudentID),
    FOREIGN KEY (DepartmentID) REFERENCES Departments(DepartmentID)
);

INSERT INTO Departments (Name)
VALUES 
    ('Senior High School'),
    ('BSIT'),
    ('Psychology'),
    ('Nursing and Pharmacy'),
    ('Engineering'),
    ('Accountancy'),
    ('Business Administration'),
    ('Education'),
    ('Criminology'),
    ('Tourism and Hospitality Management'),
    ('Arts and Communication');