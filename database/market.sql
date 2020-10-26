DROP DATABASE market_new;
CREATE DATABASE market_new CHARACTER SET 'UTF8' COLLATE 'utf8_general_ci';
USE market_new;

CREATE TABLE states(id_state INT AUTO_INCREMENT PRIMARY KEY,
    state VARCHAR(60) UNIQUE NOT NULL)
    Engine = InnoDB CHARACTER SET 'UTF8' COLLATE 'utf8_general_ci';

CREATE TABLE municipalities(id_municipality INT AUTO_INCREMENT PRIMARY KEY,
    municipality VARCHAR(60) NOT NULL)
    Engine = InnoDB CHARACTER SET 'UTF8' COLLATE 'utf8_general_ci';

CREATE TABLE colonies(id_colony INT AUTO_INCREMENT PRIMARY KEY,
    colony VARCHAR(60) NOT NULL)
    Engine = InnoDB CHARACTER SET 'UTF8' COLLATE 'utf8_general_ci';

CREATE TABLE postcodes(id_postcode INT AUTO_INCREMENT PRIMARY KEY,
    postcode VARCHAR(60) NOT NULL)
    Engine = InnoDB CHARACTER SET 'UTF8' COLLATE 'utf8_general_ci';

CREATE TABLE states_municipalities(id_state_municipality INT AUTO_INCREMENT PRIMARY KEY,
    id_state INT,
    FOREIGN KEY (id_state) REFERENCES states (id_state)
    ON DELETE CASCADE ON UPDATE CASCADE,
    id_municipality INT,
    FOREIGN KEY (id_municipality) REFERENCES municipalities (id_municipality)
    ON DELETE CASCADE ON UPDATE CASCADE)
    Engine = InnoDB CHARACTER SET 'UTF8' COLLATE 'utf8_general_ci';

CREATE TABLE municipalities_colonies(id_municipality_colony INT AUTO_INCREMENT PRIMARY KEY,
    id_municipality INT,
    FOREIGN KEY (id_municipality) REFERENCES municipalities (id_municipality)
    ON DELETE CASCADE ON UPDATE CASCADE,
    id_colony INT,
    FOREIGN KEY (id_colony) REFERENCES colonies (id_colony)
    ON DELETE CASCADE ON UPDATE CASCADE)
    Engine = InnoDB CHARACTER SET 'UTF8' COLLATE 'utf8_general_ci';

CREATE TABLE colonies_postcodes(id_colony_postcode INT AUTO_INCREMENT PRIMARY KEY,
    id_colony INT,
    FOREIGN KEY (id_colony) REFERENCES colonies (id_colony)
    ON DELETE CASCADE ON UPDATE CASCADE,
    id_postcode INT,
    FOREIGN KEY (id_postcode) REFERENCES postcodes (id_postcode)
    ON DELETE CASCADE ON UPDATE CASCADE)
    Engine = InnoDB CHARACTER SET 'UTF8' COLLATE 'utf8_general_ci';

CREATE TABLE users(id_user INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(60) NOT NULL,
    email VARCHAR(60) UNIQUE NOT NULL,
    password VARCHAR(200) NOT NULL,
    level INT(1) NOT NULL,
    status INT(1) NOT NULL,
    sessions INT(1) NOT NULL)
    Engine = InnoDB CHARACTER SET 'UTF8' COLLATE 'utf8_general_ci';

CREATE TABLE clients(id_client INT AUTO_INCREMENT PRIMARY KEY,
    rfc CHAR(13) UNIQUE NOT NULL,
    telephone1 CHAR(10) UNIQUE NOT NULL,
    email1 VARCHAR(60) UNIQUE NOT NULL,
    telephone2 CHAR(10) UNIQUE,
    email2 VARCHAR(60) UNIQUE)
    Engine = InnoDB CHARACTER SET 'UTF8' COLLATE 'utf8_general_ci';

CREATE TABLE direcctions(id_direcction INT AUTO_INCREMENT PRIMARY KEY,
    id_state INT,
    FOREIGN KEY (id_state) REFERENCES states (id_state)
    ON DELETE CASCADE ON UPDATE CASCADE,
    id_municipality INT,
    FOREIGN KEY (id_municipality) REFERENCES municipalities (id_municipality)
    ON DELETE CASCADE ON UPDATE CASCADE,
    id_colony INT,
    FOREIGN KEY (id_colony) REFERENCES colonies (id_colony)
    ON DELETE CASCADE ON UPDATE CASCADE,
    id_postcode INT,
    FOREIGN KEY (id_postcode) REFERENCES postcodes (id_postcode)
    ON DELETE CASCADE ON UPDATE CASCADE,
    street VARCHAR(60) NOT NULL,
    outside INT(2) NOT NULL,
    inside INT(2) NOT NULL)
    Engine = InnoDB CHARACTER SET 'UTF8' COLLATE 'utf8_general_ci';

CREATE TABLE users_clients (id_user_client INT AUTO_INCREMENT PRIMARY KEY,
    id_user INT,
    FOREIGN KEY (id_user) REFERENCES users (id_user)
    ON DELETE CASCADE ON UPDATE CASCADE,
    id_client INT,
    FOREIGN KEY (id_client) REFERENCES clients (id_client)
    ON DELETE CASCADE ON UPDATE CASCADE)
    Engine = InnoDB CHARACTER SET 'UTF8' COLLATE 'utf8_general_ci';

CREATE TABLE clients_direcctions(id_client_direcction INT AUTO_INCREMENT PRIMARY KEY,
    id_client INT,
    FOREIGN KEY (id_client) REFERENCES clients (id_client)
    ON DELETE CASCADE ON UPDATE CASCADE,
    id_direcction INT,
    FOREIGN KEY (id_direcction) REFERENCES direcctions (id_direcction)
    ON DELETE CASCADE ON UPDATE CASCADE)
    Engine = InnoDB CHARACTER SET 'UTF8' COLLATE 'utf8_general_ci';

CREATE TABLE products(id_product INT AUTO_INCREMENT PRIMARY KEY,
    product VARCHAR(60) UNIQUE NOT NULL,
    cost FLOAT(5,2) NOT NULL,
    description VARCHAR(300) NOT NULL)
    Engine = InnoDB CHARACTER SET 'UTF8' COLLATE 'utf8_general_ci';

CREATE TABLE categories(id_category INT AUTO_INCREMENT PRIMARY KEY,
    category VARCHAR(60) UNIQUE NOT NULL)
    Engine = InnoDB CHARACTER SET 'UTF8' COLLATE 'utf8_general_ci';

INSERT INTO `categories` (`id_category`, `category`) VALUES
(15, 'ArtÃ­culos para el Hogar'),
(11, 'BebÃ©s y NiÃ±os'),
(4, 'Carnes, Pescados y Mariscos'),
(8, 'Cerveza, Vinos y Licores'),
(9, 'Congelados'),
(1, 'Despensa'),
(14, 'ElectrÃ³nica'),
(12, 'Farmacia'),
(3, 'Frutas y Verduras'),
(13, 'Higiene y Belleza'),
(7, 'Jugos y Bebidas'),
(2, 'LÃ¡cteos'),
(10, 'Limpieza y Mascotas'),
(6, 'PanaderÃ­a y TortillerÃ­a'),
(16, 'Ropa y ZapaterÃ­a'),
(5, 'SalchichonerÃ­a');

CREATE TABLE subcategories(id_subcategory INT AUTO_INCREMENT PRIMARY KEY,
    subcategory VARCHAR(60) UNIQUE NOT NULL)
    Engine = InnoDB CHARACTER SET 'UTF8' COLLATE 'utf8_general_ci';

INSERT INTO `subcategories` (`id_subcategory`, `subcategory`) VALUES
(116, 'Accesorios para cocina'),
(64, 'Accesorios para Limpieza'),
(117, 'Accesorios para mesa'),
(20, 'Aceites de Cocina'),
(97, 'Afeitado'),
(44, 'Agua'),
(27, 'Alimento LÃ­quido'),
(17, 'Alimentos InstantÃ¡neos'),
(19, 'Alimentos Saludables'),
(83, 'AnalgÃ©sicos'),
(67, 'Aromatizantes'),
(15, 'Arroz, Frijol y Semillas'),
(37, 'ArtÃ­culos a granel'),
(61, 'ArtÃ­culos de lavanderÃ­a'),
(118, 'ArtÃ­culos de temporada'),
(119, 'ArtÃ­culos deportivos'),
(74, 'ArtÃ­culos para fiesta'),
(114, 'Audio'),
(7, 'AzÃºcar y Postres'),
(84, 'Bienestar Sexual'),
(10, 'Botanas y Fruta Seca'),
(45, 'CafÃ© y TÃ© Preparado'),
(1, 'CafÃ©, TÃ© y Sustitutos'),
(36, 'Carnes frÃ­as'),
(32, 'Cerdo'),
(3, 'Cereales y Barras'),
(50, 'Cervezas'),
(120, 'Colchones y Blancos'),
(56, 'Comida FÃ¡cil'),
(18, 'Comida Oriental'),
(72, 'Comida para bebÃ© y lactancia'),
(43, 'Comida y Snacks'),
(112, 'ComputaciÃ³n'),
(54, 'Coolers'),
(100, 'CosmÃ©ticos'),
(25, 'Crema'),
(106, 'Cuidado Ãntimo'),
(98, 'Cuidado bucal'),
(94, 'Cuidado de los Pies'),
(101, 'Cuidado del cabello'),
(99, 'Cuidado facial'),
(104, 'Cuidado para pies'),
(79, 'Cuidado Personal'),
(77, 'Cunas, carriolas y accesorios'),
(121, 'DecoraciÃ³n y Muebles'),
(65, 'Desechables'),
(109, 'Desmaquillantes y quitaesmaltes'),
(95, 'Diabetes'),
(91, 'Dieta'),
(53, 'Digestivos'),
(9, 'Dulces y Chocolates'),
(128, 'ElectrodomÃ©sticos'),
(38, 'Empacados'),
(46, 'Energizantes e Hidratantes'),
(5, 'Enlatados y Conservas'),
(16, 'Especias y Sazonadores'),
(80, 'Estomacales'),
(70, 'FÃ³rmula lÃ¡ctea'),
(122, 'FerreterÃ­a y Autos'),
(115, 'FotografÃ­a'),
(28, 'Frutas'),
(57, 'Frutas y Verduras Congeladas'),
(4, 'Galletas'),
(22, 'Gelatinas y Postres'),
(13, 'Harina y ReposterÃ­a'),
(58, 'Hielo'),
(55, 'Hielos y Vasos'),
(69, 'Higiene del bebÃ©'),
(108, 'Higiene masculina'),
(102, 'Higiene y cuidado corporal'),
(103, 'Higiene y cuidado para manos'),
(130, 'Hombre'),
(24, 'Huevo'),
(82, 'Incontinencia'),
(123, 'JardinerÃ­a y exteriores'),
(47, 'Jugos y NÃ©ctares'),
(73, 'JugueterÃ­a'),
(76, 'Juguetes para bebÃ© y estimulaciÃ³n temprana'),
(107, 'Kits de viaje'),
(62, 'Lavatrastes y lavavajillas'),
(124, 'LÃ­nea Blanca'),
(6, 'Leche'),
(71, 'Leche de Crecimiento'),
(129, 'Libros y Revistas'),
(52, 'Licores'),
(60, 'Limpieza del hogar'),
(23, 'Mantequilla y margarina'),
(63, 'Mascotas'),
(81, 'Material de CuraciÃ³n'),
(89, 'Medicamentos de Alta Especialidad'),
(86, 'Medicamentos de Patente'),
(85, 'Medicamentos GenÃ©ricos'),
(96, 'Medicamentos Infantiles'),
(8, 'Mermeladas y Miel'),
(131, 'Mujer'),
(92, 'Naturistas y Herbolarios'),
(132, 'NiÃ±a y Juvenil'),
(133, 'NiÃ±o y Juvenil'),
(93, 'NutriciÃ³n Deportiva'),
(88, 'OftÃ¡lmicos y Oticos'),
(125, 'OrganizaciÃ³n y Almacenamiento'),
(30, 'OrgÃ¡nicos y Superfoods'),
(90, 'Ortopedia y Equipos de MediciÃ³n'),
(68, 'PaÃ±ales y toallitas hÃºmedas para bebÃ©'),
(105, 'PaÃ±uelos desechables'),
(41, 'Pan Dulce'),
(39, 'Pan Salado'),
(2, 'Pan y Tortillas Empacados'),
(66, 'Papel higiÃ©nico'),
(126, 'PapelerÃ­a'),
(12, 'Pastas'),
(33, 'Pescados y Mariscos'),
(127, 'Pintura'),
(31, 'Pollo y Pavo'),
(49, 'Polvos y Jarabes'),
(59, 'Postres Congelados'),
(26, 'Quesos'),
(48, 'Refrescos'),
(42, 'ReposterÃ­a y PastelerÃ­a'),
(34, 'Res'),
(87, 'Respiratorios'),
(75, 'Ropa para bebÃ©'),
(14, 'Saborizantes y Jarabes'),
(11, 'Salsas, Aderezos y Vinagre'),
(35, 'Sushi'),
(111, 'TelefonÃ­a'),
(110, 'Televisores'),
(40, 'TortillerÃ­a'),
(29, 'Verduras'),
(113, 'Videojuegos'),
(51, 'Vinos'),
(78, 'Vitaminas y Suplementos'),
(21, 'Yogurt');

CREATE TABLE categories_subcategories(id_category_subcategory INT AUTO_INCREMENT PRIMARY KEY,
    id_category INT,
    FOREIGN KEY (id_category) REFERENCES categories (id_category)
    ON DELETE CASCADE ON UPDATE CASCADE,
    id_subcategory INT,
    FOREIGN KEY (id_subcategory) REFERENCES subcategories (id_subcategory)
    ON DELETE CASCADE ON UPDATE CASCADE)
    Engine = InnoDB CHARACTER SET 'UTF8' COLLATE 'utf8_general_ci';

INSERT INTO `categories_subcategories` (`id_category_subcategory`, `id_category`, `id_subcategory`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 1, 5),
(6, 1, 6),
(7, 1, 7),
(8, 1, 8),
(9, 1, 9),
(10, 1, 10),
(11, 1, 11),
(12, 1, 12),
(13, 1, 13),
(14, 1, 14),
(15, 1, 15),
(16, 1, 16),
(17, 1, 17),
(18, 1, 18),
(19, 1, 19),
(20, 1, 20),
(21, 2, 6),
(22, 2, 21),
(23, 2, 22),
(24, 2, 23),
(25, 2, 24),
(26, 2, 25),
(27, 2, 26),
(28, 2, 27),
(29, 3, 28),
(30, 3, 29),
(31, 3, 30),
(32, 4, 31),
(33, 4, 32),
(34, 4, 33),
(35, 4, 34),
(36, 4, 35),
(37, 5, 36),
(38, 5, 37),
(39, 5, 26),
(40, 5, 38),
(41, 6, 39),
(42, 6, 40),
(43, 6, 41),
(44, 6, 42),
(45, 6, 43),
(46, 7, 44),
(47, 7, 45),
(48, 7, 46),
(49, 7, 47),
(50, 7, 48),
(51, 7, 49),
(52, 8, 50),
(53, 8, 51),
(54, 8, 52),
(55, 8, 53),
(56, 8, 54),
(57, 8, 55),
(58, 9, 56),
(59, 9, 57),
(60, 9, 58),
(61, 9, 59),
(62, 10, 60),
(63, 10, 61),
(64, 10, 62),
(65, 10, 63),
(66, 10, 64),
(67, 10, 65),
(68, 10, 66),
(69, 10, 67),
(70, 11, 68),
(71, 11, 69),
(72, 11, 70),
(73, 11, 71),
(74, 11, 72),
(75, 11, 73),
(76, 11, 74),
(77, 11, 75),
(78, 11, 76),
(79, 11, 77),
(80, 12, 78),
(81, 12, 79),
(82, 12, 80),
(83, 12, 81),
(84, 12, 82),
(85, 12, 83),
(86, 12, 84),
(87, 12, 85),
(88, 12, 86),
(89, 12, 87),
(90, 12, 88),
(91, 12, 89),
(92, 12, 90),
(93, 12, 91),
(94, 12, 92),
(95, 12, 93),
(96, 12, 94),
(97, 12, 95),
(98, 12, 96),
(99, 13, 97),
(100, 13, 98),
(101, 13, 99),
(102, 13, 100),
(103, 13, 101),
(104, 13, 102),
(105, 13, 103),
(106, 13, 104),
(107, 13, 105),
(108, 13, 106),
(109, 13, 107),
(110, 13, 108),
(111, 13, 109),
(112, 14, 110),
(113, 14, 111),
(114, 14, 112),
(115, 14, 113),
(116, 14, 114),
(117, 14, 115),
(118, 15, 116),
(119, 15, 117),
(120, 15, 118),
(121, 15, 119),
(122, 15, 120),
(123, 15, 121),
(124, 15, 122),
(125, 15, 123),
(126, 15, 124),
(127, 15, 125),
(128, 15, 126),
(129, 15, 127),
(130, 15, 128),
(131, 15, 129),
(132, 16, 130),
(133, 16, 131),
(134, 16, 132),
(135, 16, 133);


CREATE TABLE store(id_store INT AUTO_INCREMENT PRIMARY KEY,
    date_entry DATETIME NOT NULL,
    date_exit DATETIME NOT NULL)
    Engine = InnoDB CHARACTER SET 'UTF8' COLLATE 'utf8_general_ci';

CREATE TABLE images(id_image INT AUTO_INCREMENT PRIMARY KEY,
    image VARCHAR(60) NOT NULL,
    type ENUM('slider', 'product') NOT NULL,
    status INT(1) NOT NULL)
    Engine = InnoDB CHARACTER SET 'UTF8' COLLATE 'utf8_general_ci';

CREATE TABLE products_categories_subcategories(id_product_category_subcategory INT AUTO_INCREMENT PRIMARY KEY,
    id_product INT,
    FOREIGN KEY (id_product) REFERENCES products (id_product)
    ON DELETE CASCADE ON UPDATE CASCADE,
    id_category_subcategory INT,
    FOREIGN KEY (id_category_subcategory) REFERENCES categories_subcategories (id_category_subcategory)
    ON DELETE CASCADE ON UPDATE CASCADE,
    id_image INT,
    FOREIGN KEY (id_image) REFERENCES images (id_image)
    ON DELETE CASCADE ON UPDATE CASCADE)
    Engine = InnoDB CHARACTER SET 'UTF8' COLLATE 'utf8_general_ci';

CREATE TABLE products_store(id_product_store INT AUTO_INCREMENT PRIMARY KEY,
    id_product INT,
    FOREIGN KEY (id_product) REFERENCES products (id_product)
    ON DELETE CASCADE ON UPDATE CASCADE,
    id_store INT,
    FOREIGN KEY (id_store) REFERENCES store (id_store)
    ON DELETE CASCADE ON UPDATE CASCADE)
    Engine = InnoDB CHARACTER SET 'UTF8' COLLATE 'utf8_general_ci';

CREATE TABLE vendors(id_vendor INT AUTO_INCREMENT PRIMARY KEY,
    vendor VARCHAR(30) NOT NULL,
    name VARCHAR(30) NOT NULL,
    email1 VARCHAR(60) UNIQUE NOT NULL,
    telephone1 CHAR(10) UNIQUE NOT NULL,
    email2 VARCHAR(60),
    telephone2 CHAR(10))
    Engine = InnoDB CHARACTER SET 'UTF8' COLLATE 'utf8_general_ci';

CREATE TABLE vendors_direcctions(id_vendor_direcction INT AUTO_INCREMENT PRIMARY KEY,
    id_vendor INT,
    FOREIGN KEY (id_vendor) REFERENCES vendors (id_vendor)
    ON DELETE CASCADE ON UPDATE CASCADE,
    id_direcction INT,
    FOREIGN KEY (id_direcction) REFERENCES direcctions (id_direcction)
    ON DELETE CASCADE ON UPDATE CASCADE)
    Engine = InnoDB CHARACTER SET 'UTF8' COLLATE 'utf8_general_ci';

CREATE TABLE resets(id_reset INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(60) NOT NULL,
    token VARCHAR(60) NOT NULL,
    create_at DATETIME NOT NULL,
    status ENUM('valid', 'expired') NOT NULL)
    Engine = InnoDB CHARACTER SET 'UTF8' COLLATE 'utf8_general_ci';

CREATE TABLE verifications(id_verification INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(60) NOT NULL,
    token VARCHAR(60) NOT NULL,
    create_at DATETIME NOT NULL,
    status ENUM('valid', 'expired') NOT NULL)
    Engine = InnoDB CHARACTER SET 'UTF8' COLLATE 'utf8_general_ci';

INSERT INTO users (name, email, password, level, status, sessions) 
VALUES('Admin', 'admin@market.com', 'YWRtaW4xMjM=', 1, 1, 0);