ALTER TABLE car
ADD car_color VARCHAR(50) AFTER model_id,
ADD car_plate VARCHAR(50) AFTER car_color;

ALTER TABLE car 
ADD car_name VARCHAR(100) AFTER admin_id,
ADD car_cc VARCHAR(20) AFTER car_mileage;

UPDATE model SET brand_id = 4
WHERE model_name IN
(
'A-Class',
'C-Class',
'E-Class',
'S-Class',
'GLA',
'GLC',
'GLE',
'GLS'
);

UPDATE model SET brand_id = 6
WHERE model_name IN
(
'Axia',
'Bezza',
'Myvi',
'Alza',
'Aruz'
);

UPDATE model SET brand_id = 3
WHERE model_name IN
(
'1 Series',
'2 Series',
'3 Series',
'5 Series',
'7 Series',
'X1',
'X3',
'X5',
'X7'
);

UPDATE model SET brand_id = 5
WHERE model_name IN
(
'Saga',
'Persona',
'Iriz',
'Exora',
'X50',
'X70',
'S70'
);