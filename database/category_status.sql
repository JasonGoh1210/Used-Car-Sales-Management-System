ALTER TABLE category 
ADD category_status VARCHAR(10) DEFAULT 'Active';

INSERT INTO customer 
(cust_name, cust_email, cust_phone, cust_password, cust_address, cust_city, cust_state, cust_postcode, cust_status, ic_front, ic_back, cust_ic)
VALUES

('Ali Ahmad', 'ali@gmail.com', '0123456789', '12345678', '', '', '', '', 'Active', '', '', ''),
('John Tan', 'john@gmail.com', '0139876543', '12345678', '', '', '', '', 'Active', '', '', ''),
('Siti Nur', 'siti@gmail.com', '0145566778', '12345678', '', '', '', '', 'Inactive', '', '', ''),
('Ahmad Lim', 'ahmad@gmail.com', '0112233445', '12345678', '', '', '', '', 'Active', '', '', '');

CREATE TABLE car_images (
    id INT AUTO_INCREMENT PRIMARY KEY,
    car_id INT,
    image_path VARCHAR(255)
);