CREATE TABLE deposit (
    deposit_id INT AUTO_INCREMENT PRIMARY KEY,
    deposit_amount DECIMAL(10,2),
    deposit_receipt VARCHAR(255),
    deposit_status VARCHAR(20)
);

CREATE TABLE booking (
    booking_id INT AUTO_INCREMENT PRIMARY KEY,
    customer_name VARCHAR(100),
    email VARCHAR(100),
    phone VARCHAR(20),
    address TEXT,
    postcode VARCHAR(10),
    state VARCHAR(50),
    city VARCHAR(50),
    booking_date DATETIME
);

CREATE TABLE transaction_record (
    transaction_id INT AUTO_INCREMENT PRIMARY KEY,
    card_name VARCHAR(100),
    card_number VARCHAR(30),
    amount DECIMAL(10,2),
    payment_status VARCHAR(20),
    receipt VARCHAR(255),
    transaction_date DATETIME
);

CREATE TABLE test_drive (
    tdrive_id INT AUTO_INCREMENT PRIMARY KEY,
    cust_id INT,
    car_id INT,
    tdrive_date DATETIME,
    tdrive_status VARCHAR(20)
);