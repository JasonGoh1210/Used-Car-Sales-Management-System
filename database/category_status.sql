ALTER TABLE category 
ADD category_status VARCHAR(10) DEFAULT 'Active';

CREATE TABLE car_images (
    id INT AUTO_INCREMENT PRIMARY KEY,
    car_id INT,
    image_path VARCHAR(255)
);

CREATE TABLE brand (
    brand_id INT AUTO_INCREMENT PRIMARY KEY,
    brand_name VARCHAR(100) NOT NULL
);

CREATE TABLE model (
    model_id INT AUTO_INCREMENT PRIMARY KEY,
    brand_id INT NOT NULL,
    model_name VARCHAR(100) NOT NULL,

    FOREIGN KEY (brand_id) REFERENCES brand(brand_id)
    ON DELETE CASCADE
);

ALTER TABLE car
ADD brand_id INT,
ADD model_id INT;

ALTER TABLE car
ADD FOREIGN KEY (brand_id) REFERENCES brand(brand_id),
ADD FOREIGN KEY (model_id) REFERENCES model(model_id);

ALTER TABLE car
DROP COLUMN car_brand,
DROP COLUMN car_model;

INSERT INTO brand (brand_name) VALUES
('Honda'),
('Toyota'),
('BMW'),
('Mercedes-Benz'),
('Proton'),
('Perodua'),
('Nissan'),
('Mazda');

INSERT INTO model (brand_id, model_name) VALUES

-- Honda
(1, 'City'),
(1, 'Civic'),
(1, 'Accord'),
(1, 'Jazz'),
(1, 'CR-V'),
(1, 'HR-V'),
(1, 'BR-V'),
(1, 'Odyssey'),
(1, 'Insight'),

-- Toyota
(2, 'Vios'),
(2, 'Yaris'),
(2, 'Corolla Altis'),
(2, 'Camry'),
(2, 'Hilux'),
(2, 'Fortuner'),
(2, 'Innova'),
(2, 'Alphard'),
(2, 'Vellfire'),

-- Proton
(3, 'Saga'),
(3, 'Persona'),
(3, 'Iriz'),
(3, 'Exora'),
(3, 'X50'),
(3, 'X70'),
(3, 'S70'),

-- Perodua
(4, 'Axia'),
(4, 'Bezza'),
(4, 'Myvi'),
(4, 'Alza'),
(4, 'Aruz'),

-- BMW
(5, '1 Series'),
(5, '2 Series'),
(5, '3 Series'),
(5, '5 Series'),
(5, '7 Series'),
(5, 'X1'),
(5, 'X3'),
(5, 'X5'),
(5, 'X7'),

-- Mercedes
(6, 'A-Class'),
(6, 'C-Class'),
(6, 'E-Class'),
(6, 'S-Class'),
(6, 'GLA'),
(6, 'GLC'),
(6, 'GLE'),
(6, 'GLS'),

-- Nissan
(7, 'Almera'),
(7, 'Sylphy'),
(7, 'Teana'),
(7, 'X-Trail'),
(7, 'Navara'),

-- Mazda
(8, 'Mazda 2'),
(8, 'Mazda 3'),
(8, 'Mazda 6'),
(8, 'CX-3'),
(8, 'CX-5'),
(8, 'CX-8'),
(8, 'CX-9');