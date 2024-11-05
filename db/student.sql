-- Create database
CREATE DATABASE clinic_dashboard;
USE clinic_dashboard;

-- Create Departments table
CREATE TABLE departments (
    department_id INT PRIMARY KEY AUTO_INCREMENT,
    department_name VARCHAR(100) UNIQUE
);

-- Create Students table
CREATE TABLE students (
    student_id INT PRIMARY KEY AUTO_INCREMENT,
    first_name VARCHAR(50),
    last_name VARCHAR(50),
    birthdate DATE,
    gender ENUM('Male', 'Female', 'Other'),
    department_id INT,
    contact_info VARCHAR(100),
    FOREIGN KEY (department_id) REFERENCES departments(department_id)
);

-- Create Visits table
CREATE TABLE visits (
    visit_id INT PRIMARY KEY AUTO_INCREMENT,
    student_id INT,
    visit_date DATE,
    treatment TEXT,
    complaint TEXT,
    nurse VARCHAR(50),
    FOREIGN KEY (student_id) REFERENCES students(student_id)
);

-- Insert departments data
INSERT INTO departments (department_name) VALUES 
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