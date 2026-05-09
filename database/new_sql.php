ALTER TABLE car
ADD car_color VARCHAR(50) AFTER model_id,
ADD car_plate VARCHAR(50) AFTER car_color;

ALTER TABLE car 
ADD car_name VARCHAR(100) AFTER admin_id,
ADD car_cc VARCHAR(20) AFTER car_mileage;