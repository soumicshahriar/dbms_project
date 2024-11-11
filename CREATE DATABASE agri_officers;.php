CREATE DATABASE agri_officers;

USE agri_officers;

CREATE TABLE records (
    id INT AUTO_INCREMENT PRIMARY KEY,
    agri_officer_id VARCHAR(50),
    date DATE,
    product_scanned VARCHAR(100),
    check_storage_condition VARCHAR(100),
    data_received VARCHAR(100),
    quantity DECIMAL(10,2),
    selling_price DECIMAL(10,2)
);
