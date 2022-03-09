DROP DATABASE IF EXISTS carrefive;
CREATE DATABASE carrefive CHARACTER SET utf8;
USE carrefive;

CREATE TABLE user (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR (25) NOT NULL,
    password VARCHAR (512) NOT NULL
);

CREATE TABLE product (
    product_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR (255) NOT NULL,
    description TEXT NOT NULL,
    price FLOAT NOT NULL,
    image VARCHAR (512),
    dlc DATE
);

ALTER TABLE user ADD UNIQUE(`username`);

INSERT INTO product (name,description,price,dlc) VALUES
('PANZANI Coquillettes', 'Des coquillettes panzani !', 0.76, '2025-11-09'),
('MAGNUM Classic x4', 'Boite de 4 magnums classic', 2.34, '2022-05-09'),
('CARRE5 500 Feuilles A4', 'Rame de papier A4 90gr', 4.01, null),
('PAIC Citron', 'Du liquide vaisselle', 1.76, null);