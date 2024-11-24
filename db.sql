CREATE DATABASE IF NOT EXISTS HealthTrack;
USE HealthTrack;

-- Create Departments table
CREATE TABLE Departments (
    DepartmentID INT PRIMARY KEY AUTO_INCREMENT,
    Name VARCHAR(100) NOT NULL
);

-- Create Students table
CREATE TABLE Students (
    StudentID INT PRIMARY KEY AUTO_INCREMENT,
    FirstName VARCHAR(50) NOT NULL,
    LastName VARCHAR(50) NOT NULL,
    DepartmentID INT NOT NULL,
    FOREIGN KEY (DepartmentID) REFERENCES Departments(DepartmentID)
);

-- Create Visits table
CREATE TABLE Visits (
    VisitID INT PRIMARY KEY AUTO_INCREMENT,
    StudentID INT NOT NULL,
    DepartmentID INT NOT NULL,
    VisitDate DATETIME NOT NULL,
    Reason TEXT NOT NULL,
    FOREIGN KEY (StudentID) REFERENCES Students(StudentID),
    FOREIGN KEY (DepartmentID) REFERENCES Departments(DepartmentID)
);
