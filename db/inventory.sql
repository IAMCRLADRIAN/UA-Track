
CREATE DATABASE IF NOT EXISTS inventory;


USE inventory;


CREATE TABLE inventory (
    id INT AUTO_INCREMENT PRIMARY KEY,   
    product_name VARCHAR(255) NOT NULL, 
    available_qty INT NOT NULL,         
    total_qty INT NOT NULL,             
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, 
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP 
);