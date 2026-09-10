DROP DATABASE IF EXISTS `carboek`;
 
CREATE DATABASE `carboek`;
 
USE `carboek`;
 
CREATE TABLE `gebruikers` (
    id MEDIUMINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL,
    wachtwoord VARCHAR(100) NOT NULL
);
CREATE TABLE `verlanglijsten_gebruikers` (
    id MEDIUMINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    gebruiker_ID INT(100) NOT NULL,
    auto_ID INT(100) NOT NULL
);

CREATE TABLE `auto_merk` (
    id MEDIUMINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    logo_url VARCHAR(100) NOT NULL,
    merk VARCHAR(100) NOT NULL
);
CREATE TABLE `auto_model` (
    id MEDIUMINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    merk_id MEDIUMINT NOT NULL,
    foto_auto VARCHAR(255),
    model VARCHAR(50) NOT NULL,
    optrekken_seconde DECIMAL(4,2) NOT NULL,
    jaar YEAR NOT NULL,
    kenteken VARCHAR(20) UNIQUE,
    tank ENUM('Benzine', 'Diesel', 'Elektrisch', 'Hybride') NOT NULL,
    waarde DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (merk_id) REFERENCES auto_merk(id)
);

-- INSERT INTO `gebruikers` (`username`, `wachtwoord`) VALUES
--     ( 'admin', 'ww');



INSERT INTO `auto_merk` (`merk`, `logo_url`) VALUES
('Alfa Romeo', 'images/alfa_romeo-logo-brandlogo.net_-512x512.png'),
('Aston Martin', 'images/aston-martin-logo-preview-400x400.png'),
('Audi', 'images/audi-logo-vector-download-400x400.jpg'),
('bugatti', 'images/OIP (27).jpeg'),
('BMW', 'images/bmw-vector-logo.png'),
('Bentley', 'images/bentley-logo-512x512.png'),
('Citroën', 'images/citroen-2022-logo_brandlogos.net_udrsj.png'),
('Cupra', 'images/cupra-logo_brandlogos.net_rnjls-512x512.png'),
('Dacia', 'images/dacia-logo-vector-01.png'),
('Fiat', 'images/fiat-logo-vector-01.png'),
('Ford', 'images/ford-logo-vector-01.png'),
('Ferrari', 'images/scuderia_ferrari-logo_brandlogos.net_uupa6-512x697.png'),
('Honda', 'images/honda-silver-logo-vector.png'),
('Hyundai', 'images/Hyundai-logo.png'),
('Jaguar', 'images/jaguar_cars-logo_brandlogos.net_y7ns0.png'),
('Jeep', 'images/jeep-logo_brandlogos.net_9pgy3-512x512.png'),
('Kia', 'images/kia-brandlogo.net_-512x512.png'),
('Lamborghini', 'images/lamborghini-logo_brandlogos.net_bh7fz-512x576.png'),
('Land Rover', 'images/land-rover-logo-512x512.png'),
('Lexus', 'images/lexus-logo-vector.gif'),
('Mini', 'images/bmw_mini-brandlogo.net_-512x512.png'),
('Mitsubishi', 'images/mitsubishi-logo-vector.jpg'),
('Maserati', 'images/maserati-logo-brandlogo.net_-512x512.png'),
('Mazda', 'images/mazda-logo-vector.gif'),
('Mclaren', 'images/mclaren-logo-512x512.png'),
('Mercedes', 'images/mercedes-benz_star-logo_brandlogos.net_ykrt4-512x512.png'),
('Nissan', 'images/nissan-logo-preview-400x400.png'),
('Opel', 'images/opel-logo_brandlogos.net_aud49-512x512.png'),
('Peugeot', 'images/Peugeot-vector-logo.png'),
('Polestar', 'images/b2df174f965c82d9404de5ab072ed04e.jpg'),
('Porshe', 'images/Porsche-logo-01.png'),
('Renault', 'images/renault-black-vector-logo.png'),
('Seat', 'images/seat-logo_brandlogos.net_isic0-512x497.png'),
('Skoda', 'images/skoda_auto-logo_brandlogos.net_zfdmc-512x352.png'),
('Smart', 'images/smart-brandlogo.net_-512x512.png'),
('Subaru', 'images/subaru-logo-brandlogos.net_-512x512.png'),
('Suzuki', 'images/suzuki-logo_brandlogos.net_78npy-512x345.png'),
('tesla', 'images/tesla-logo-512x512.png'),
('Toyota', 'images/toyota-logo_brandlogos.net_e2gvv.png'),
('Volkswagen', 'images/volkswagen-logo-vector.png'),
('Volvo', 'images/volvo_iron_mark-vector_brandlogos.net_j56yu-512x512.png');

INSERT INTO `auto_model` (`merk_id`, `foto_auto`, `model`, `optrekken_seconde`, `jaar`, `kenteken`, `tank`, `waarde`) VALUES
(1, 'images/eeba4940-2019-alfa-romeo-giulia-62.jpg', 'Giulia', 5.1, 2023, 'AB-123-CD', 'Benzine', 55000),
(2, 'images/kaas.jpeg', 'DB11', 3.9, 2022, 'XY-456-ZZ', 'Benzine', 220000),
(3, 'images/OIP (1).jpeg', 'RS6', 3.6, 2024, 'ZZ-999-YY', 'Benzine', 130000),
(4, 'images/bugatti-chiron-sport-110-ans-1.jpg', 'Chiron', 2.4, 2023, 'BG-123-ZX', 'Benzine', 3000000),
(5, 'images/OIP (2).jpeg', 'M3', 4.2, 2023, 'GG-888-HH', 'Benzine', 95000),
(6, 'images/OIP (3).jpeg', 'Continental GT', 3.5, 2023, 'TT-777-FF', 'Benzine', 250000),
(7, 'images/OIP.jpeg', 'C5 X', 7.9, 2023, 'QQ-666-RR', 'Hybride', 45000),
(8, 'images/OIP (4).jpeg', 'Formentor', 4.9, 2024, 'VV-555-DD', 'Benzine', 60000),
(9, 'images/OIP (5).jpeg', 'Duster', 10.5, 2022, 'AA-111-BB', 'Benzine', 25000),
(10, 'images/downloaden.jpeg', '500e', 9.0, 2023, 'EE-222-CC', 'Elektrisch', 30000),
(11, 'images/downloaden (1).jpeg', 'Mustang GT', 4.0, 2024, 'WW-333-EE', 'Benzine', 80000),
(12, 'images/OIP (6).jpeg', 'SF90 Stradale', 2.5, 2023, 'FF-444-GG', 'Hybride', 500000),
(13, 'images/OIP (7).jpeg', 'Civic Type R', 5.4, 2023, 'PP-123-KK', 'Benzine', 65000),
(14, 'images/downloaden (2).jpeg', 'Ioniq 5', 7.4, 2024, 'LL-321-NN', 'Elektrisch', 50000),
(15, 'images/downloaden (3).jpeg', 'F-Pace', 5.3, 2023, 'MM-432-OO', 'Benzine', 85000),
(16, 'images/downloaden (4).jpeg', 'Wrangler', 7.2, 2023, 'NN-543-PP', 'Benzine', 70000),
(17, 'images/OIP (8).jpeg', 'EV6', 6.2, 2024, 'OO-654-QQ', 'Elektrisch', 52000),
(18, 'images/OIP (9).jpeg', 'Huracán', 2.9, 2023, 'PP-765-RR', 'Benzine', 320000),
(19, 'images/downloaden (5).jpeg', 'Defender', 6.5, 2023, 'QQ-876-SS', 'Diesel', 75000),
(20, 'images/OIP (10).jpeg', 'RX 500h', 5.7, 2024, 'RR-987-TT', 'Hybride', 68000),
(21, 'images/OIP (11).jpeg', 'Cooper SE', 7.3, 2023, 'SS-111-AA', 'Elektrisch', 37000),
(22, 'images/OIP (12).jpeg', 'Outlander PHEV', 8.0, 2023, 'TT-222-BB', 'Hybride', 40000),
(23, 'images/OIP (13).jpeg', 'MC20', 2.9, 2023, 'UU-333-CC', 'Benzine', 280000),
(24, 'images/downloaden (6).jpeg', 'MX-5', 6.7, 2023, 'VV-444-DD', 'Benzine', 35000),
(25, 'images/downloaden (7).jpeg', '720S', 2.8, 2022, 'WW-555-EE', 'Benzine', 280000),
(26, 'images/downloaden (8).jpeg', 'AMG GT', 3.2, 2024, 'XX-666-FF', 'Benzine', 180000),
(27, 'images/OIP (14).jpeg', 'GT-R', 3.1, 2023, 'YY-777-GG', 'Benzine', 120000),
(28, 'images/OIP (15).jpeg', 'Astra', 8.1, 2023, 'ZZ-888-HH', 'Benzine', 27000),
(29, 'images/OIP (16).jpeg', '308', 7.5, 2024, 'AA-999-II', 'Hybride', 35000),
(30, 'images/OIP (17).jpeg', 'Polestar 2', 4.7, 2023, 'BB-111-JJ', 'Elektrisch', 60000),
(31, 'images/OIP (18).jpeg', '911 Turbo S', 2.7, 2024, 'CC-222-KK', 'Benzine', 250000),
(32, 'images/OIP (19).jpeg', 'Mégane E-Tech', 7.2, 2023, 'DD-333-LL', 'Elektrisch', 45000),
(33, 'images/downloaden (9).jpeg', 'Leon', 7.0, 2023, 'EE-444-MM', 'Benzine', 32000),
(34, 'images/OIP (20).jpeg', 'Octavia', 7.3, 2023, 'FF-555-NN', 'Hybride', 34000),
(35, 'images/OIP (21).jpeg', 'EQ Fortwo', 10.1, 2024, 'GG-666-OO', 'Elektrisch', 25000),
(36, 'images/OIP (22).jpeg', 'WRX STI', 4.9, 2023, 'HH-777-PP', 'Benzine', 55000),
(37, 'images/OIP (23).jpeg', 'Swift Sport', 8.3, 2023, 'II-888-QQ', 'Benzine', 25000),
(38, 'images/OIP (24).jpeg', 'Model 3', 3.1, 2024, 'JJ-999-RR', 'Elektrisch', 52000),
(39, 'images/OIP (25).jpeg', 'Supra GR', 4.2, 2023, 'KK-111-SS', 'Benzine', 70000),
(40, 'images/downloaden (10).jpeg', 'Golf R', 4.7, 2023, 'LL-222-TT', 'Benzine', 55000),
(41, 'images/OIP (26).jpeg', 'XC90 Recharge', 5.9, 2023, 'MM-333-UU', 'Hybride', 75000);