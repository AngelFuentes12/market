DROP DATABASE market;

CREATE DATABASE market CHARACTER SET 'UTF8' COLLATE 'utf8_general_ci';
USE market;

CREATE TABLE users(id_user INT AUTO_INCREMENT PRIMARY KEY,
					name VARCHAR(30) NOT NULL,
					surname VARCHAR(30) NOT NULL,
					lastname VARCHAR(30) NOT NULL,
					birthday DATE NOT NULL,
					telephone VARCHAR(30) UNIQUE)
					Engine = InnoDB CHARACTER SET 'UTF8' COLLATE 'utf8_general_ci';

CREATE TABLE checks(id_check INT AUTO_INCREMENT PRIMARY KEY,
					id_user INT,
					FOREIGN KEY (id_user) REFERENCES users (id_user)
					ON DELETE CASCADE ON UPDATE CASCADE,
					email VARCHAR(30) UNIQUE NOT NULL,
					password VARCHAR(50) NOT NULL,
					status ENUM('Active', 'Suspended', 'Verification') NOT NULL,
                         type_user ENUM('Admin', 'User') NOT NULL,
					create_at DATETIME NOT NULL,
					update_at DATETIME NOT NULL)
					Engine = InnoDB CHARACTER SET 'UTF8' COLLATE 'utf8_general_ci';

CREATE TABLE categories(id_category INT AUTO_INCREMENT PRIMARY KEY,
						name VARCHAR(30) UNIQUE NOT NULL,
						create_at DATETIME NOT NULL,
						update_at DATETIME NOT NULL)
						Engine = InnoDB CHARACTER SET 'UTF8' COLLATE 'utf8_general_ci';
INSERT INTO `categories` (`id_category`, `name`, `create_at`, `update_at`) VALUES
     (1, 'Despensas', '2020-09-06 22:30:39', '2020-09-06 22:30:39'),
     (2, 'Lácteos', '2020-09-06 22:30:39', '2020-09-06 22:30:39'),
     (3, 'Frutas y verduras', '2020-09-06 22:30:39', '2020-09-06 22:30:39'),
     (4, 'Carnes, Pescados y Mariscos', '2020-09-06 22:30:39', '2020-09-06 22:30:39'),
     (5, 'Salchichonería', '2020-09-06 22:30:39', '2020-09-06 22:30:39'),
     (6, 'Panadería y Tortillería', '2020-09-06 22:30:39', '2020-09-06 22:30:39'),
     (7, 'Jugos y Bebidas', '2020-09-06 22:30:39', '2020-09-06 22:30:39'),
     (8, 'Cerveza, Vinos y Licores', '2020-09-06 22:30:39', '2020-09-06 22:30:39'),
     (9, 'Congelados', '2020-09-06 22:30:39', '2020-09-06 22:30:39'),
     (10, 'Limpieza y Mascotas', '2020-09-06 22:30:39', '2020-09-06 22:30:39'),
     (11, 'Bebés y Niños', '2020-09-06 22:30:39', '2020-09-06 22:30:39'),
     (12, 'Farmacia', '2020-09-06 22:30:39', '2020-09-06 22:30:39'),
     (13, 'Higiene y Belleza', '2020-09-06 22:30:39', '2020-09-06 22:30:39'),
     (14, 'Electrónica', '2020-09-06 22:30:39', '2020-09-06 22:30:39'),
     (15, 'Artículos para el Hogar', '2020-09-06 22:30:39', '2020-09-06 22:30:39'),
     (16, 'Ropa y Zapatería', '2020-09-06 22:30:39', '2020-09-06 22:30:39');


CREATE TABLE subcategories(id_subcategory INT AUTO_INCREMENT PRIMARY KEY,
							id_category INT,
							FOREIGN KEY (id_category) REFERENCES categories (id_category)
							ON DELETE CASCADE ON UPDATE CASCADE,
							name VARCHAR(60) UNIQUE NOT NULL,
							create_at DATETIME NOT NULL,
							update_at DATETIME NOT NULL)
							Engine = InnoDB CHARACTER SET 'UTF8' COLLATE 'utf8_general_ci';
INSERT INTO `subcategories` (`id_subcategory`, `id_category`, `name`, `create_at`, `update_at`) VALUES
     (1, 1, 'Café, Té y Sustitutos', '2020-09-06 22:30:39', '2020-09-06 22:30:39'),
     (2, 1, 'Pan y Tortillas Empacados', '2020-09-06 22:30:39', '2020-09-06 22:30:39'),
     (3, 1, 'Cereales y Barras', '2020-09-06 22:30:39', '2020-09-06 22:30:39'),
     (4, 1, 'Galletas', '2020-09-06 22:30:39', '2020-09-06 22:30:39'),
     (5, 1, 'Enlatados y Conservas', '2020-09-06 22:30:39', '2020-09-06 22:30:39'),
     (6, 1, 'Leches', '2020-09-06 22:30:39', '2020-09-06 22:30:39'),
     (7, 1, 'Azúcar y Postres', '2020-09-06 22:30:39', '2020-09-06 22:30:39'),
     (8, 1, 'Mermeladas y Miel', '2020-09-06 22:30:39', '2020-09-06 22:30:39'),
     (9, 1, 'Dulces y Chocolates', '2020-09-06 22:30:39', '2020-09-06 22:30:39'),
     (10, 1, 'Botana y Fruta Seca', '2020-09-06 22:30:39', '2020-09-06 22:30:39'),
     (11, 1, 'Salsas, Aderezos y Vinagre', '2020-09-06 22:30:39', '2020-09-06 22:30:39'),
     (12, 1, 'Pastas', '2020-09-06 22:30:39', '2020-09-06 22:30:39'),
     (13, 1, 'Harina y Repostería', '2020-09-06 22:30:39', '2020-09-06 22:30:39'),
     (14, 1, 'Saborizantes y Jarabes', '2020-09-06 22:30:39', '2020-09-06 22:30:39'),
     (15, 1, 'Arroz, Frijol y Semillas', '2020-09-06 22:30:39', '2020-09-06 22:30:39'),
     (16, 1, 'Especies y Sazonadores', '2020-09-06 22:30:39', '2020-09-06 22:30:39'),
     (17, 1, 'Alimentos Instantáneos', '2020-09-06 22:30:39', '2020-09-06 22:30:39'),
     (18, 1, 'Comida Oriental', '2020-09-06 22:30:39', '2020-09-06 22:30:39'),
     (19, 1, 'Alimentos Saludables', '2020-09-06 22:30:39', '2020-09-06 22:30:39'),
     (20, 1, 'Aceites de Cocina', '2020-09-06 22:30:39', '2020-09-06 22:30:39'),
     (21, 2, 'Leche', '2020-09-06 22:30:39', '2020-09-06 22:30:39'),
     (22, 2, 'Yogurt', '2020-09-06 22:30:39', '2020-09-06 22:30:39'),
     (23, 2, 'Gelatinas y Postres', '2020-09-06 22:30:39', '2020-09-06 22:30:39'),
     (24, 2, 'Mantequilla y Margarina', '2020-09-06 22:30:39', '2020-09-06 22:30:39'),
     (25, 2, 'Huevo', '2020-09-06 22:30:39', '2020-09-06 22:30:39'),
     (26, 2, 'Crema', '2020-09-06 22:30:39', '2020-09-06 22:30:39'),
     (27, 2, 'Queso', '2020-09-06 22:30:39', '2020-09-06 22:30:39'),
     (28, 2, 'Alimento Liquido', '2020-09-06 22:30:39', '2020-09-06 22:30:39'),
     (29, 3, 'Frutas', '2020-09-06 22:30:39', '2020-09-06 22:30:39'),
     (30, 3, 'Verduras', '2020-09-06 22:30:39', '2020-09-06 22:30:39'),
     (31, 3, 'Orgánicos y Superfoods', '2020-09-06 22:30:39', '2020-09-06 22:30:39'),
     (32, 4, 'Pollo y Pavo', '2020-09-06 22:30:39', '2020-09-06 22:30:39'),
     (33, 4, 'Cerdo', '2020-09-06 22:30:39', '2020-09-06 22:30:39'),
     (34, 4, 'Pescados y Mariscos', '2020-09-06 22:30:39', '2020-09-06 22:30:39'),
     (35, 4, 'Res', '2020-09-06 22:30:39', '2020-09-06 22:30:39'),
     (36, 4, 'Sushi', '2020-09-06 22:30:39', '2020-09-06 22:30:39'),
     (37, 5, 'Carnes Frías', '2020-09-06 22:30:39', '2020-09-06 22:30:39'),
     (38, 5, 'Artículos a Granel', '2020-09-06 22:30:39', '2020-09-06 22:30:39'),
     (39, 5, 'Quesos', '2020-09-06 22:30:39', '2020-09-06 22:30:39'),
     (40, 5, 'Empacados', '2020-09-06 22:30:39', '2020-09-06 22:30:39'),
     (41, 6, 'Pan Salado', '2020-09-06 22:30:39', '2020-09-06 22:30:39'),
     (42, 6, 'Tortillería', '2020-09-06 22:30:39', '2020-09-06 22:30:39'),
     (43, 6, 'Pan Dulce', '2020-09-06 22:30:39', '2020-09-06 22:30:39'),
     (44, 6, 'Repostería y Pastelería', '2020-09-06 22:30:39', '2020-09-06 22:30:39'),
     (45, 6, 'Comida y Snacks', '2020-09-06 22:30:39', '2020-09-06 22:30:39'),
     (46, 7, 'Agua', '2020-09-06 22:30:39', '2020-09-06 22:30:39'),
     (47, 7, 'Café y Te Preparado', '2020-09-06 22:30:39', '2020-09-06 22:30:39'),
     (48, 7, 'Energizantes Hidratantes', '2020-09-06 22:30:39', '2020-09-06 22:30:39'),
     (49, 7, 'Jugos y Néctares', '2020-09-06 22:30:39', '2020-09-06 22:30:39'),
     (50, 7, 'Refrescos', '2020-09-06 22:30:39', '2020-09-06 22:30:39'),
     (51, 7, 'Polvo y Jarabes', '2020-09-06 22:30:39', '2020-09-06 22:30:39'),
     (52, 8, 'Cervezas', '2020-09-06 22:30:39', '2020-09-06 22:30:39'),
     (53, 8, 'Vinos', '2020-09-06 22:30:39', '2020-09-06 22:30:39'),
     (54, 8, 'Licores', '2020-09-06 22:30:39', '2020-09-06 22:30:39'),
     (55, 8, 'Digestivos', '2020-09-06 22:30:39', '2020-09-06 22:30:39'),
     (56, 8, 'Coolers', '2020-09-06 22:30:39', '2020-09-06 22:30:39'),
     (57, 8, 'Hielos y Vasos', '2020-09-06 22:30:39', '2020-09-06 22:30:39'),
     (58, 9, 'Comida Fácil', '2020-09-06 22:30:39', '2020-09-06 22:30:39'),
     (59, 9, 'Frutas y Verduras Congeladas', '2020-09-06 22:30:39', '2020-09-06 22:30:39'),
     (60, 9, 'Hielo', '2020-09-06 22:30:39', '2020-09-06 22:30:39'),
     (61, 9, 'Postres Congelados', '2020-09-06 22:30:39', '2020-09-06 22:30:39'),
     (62, 10, 'Limpieza del Hogar', '2020-09-06 22:30:39', '2020-09-06 22:30:39'),
     (63, 10, 'Artículos de Lavandería', '2020-09-06 22:30:39', '2020-09-06 22:30:39'),
     (64, 10, 'Lavatrastes y Lavavajillas', '2020-09-06 22:30:39', '2020-09-06 22:30:39'),
     (65, 10, 'Mascotas', '2020-09-06 22:30:39', '2020-09-06 22:30:39'),
     (66, 10, 'Accesorios para Limpieza', '2020-09-06 22:30:39', '2020-09-06 22:30:39'),
     (67, 10, 'Desechables', '2020-09-06 22:30:39', '2020-09-06 22:30:39'),
     (68, 10, 'Papel Higiénico', '2020-09-06 22:30:39', '2020-09-06 22:30:39'),
     (69, 10, 'Aromatizantes', '2020-09-06 22:30:39', '2020-09-06 22:30:39'),
     (70, 11, 'Pañales y Toallitas Húmedas', '2020-09-06 22:30:39', '2020-09-06 22:30:39'),
     (71, 11, 'Higiene del Bebe', '2020-09-06 22:30:39', '2020-09-06 22:30:39'),
     (72, 11, 'Formula Láctea', '2020-09-06 22:30:39', '2020-09-06 22:30:39'),
     (73, 11, 'Leche de Crecimiento', '2020-09-06 22:30:39', '2020-09-06 22:30:39'),
     (74, 11, 'Comida para Bebe y Lactancia', '2020-09-06 22:30:39', '2020-09-06 22:30:39'),
     (75, 11, 'Juguetería', '2020-09-06 22:30:39', '2020-09-06 22:30:39'),
     (76, 11, 'Artículos para Fiesta', '2020-09-06 22:30:39', '2020-09-06 22:30:39'),
     (77, 11, 'Ropa para Bebe', '2020-09-06 22:30:39', '2020-09-06 22:30:39'),
     (78, 11, 'Juguetes para Bebe y Estimulación Temprana', '2020-09-06 22:30:39', '2020-09-06 22:30:39'),
     (79, 11, 'Cunas, Carriolas y Accesorios', '2020-09-06 22:30:39', '2020-09-06 22:30:39'),
     (80, 12, 'Vitaminas y Suplementos', '2020-09-06 22:30:39', '2020-09-06 22:30:39'),
     (81, 12, 'Cuidado Personal', '2020-09-06 22:30:39', '2020-09-06 22:30:39'),
     (82, 12, 'Estomacales', '2020-09-06 22:30:39', '2020-09-06 22:30:39'),
     (83, 12, 'Material de Curación', '2020-09-06 22:30:39', '2020-09-06 22:30:39'),
     (84, 12, 'Incontinencia', '2020-09-06 22:30:39', '2020-09-06 22:30:39'),
     (85, 12, 'Analgésicos', '2020-09-06 22:30:39', '2020-09-06 22:30:39'),
     (86, 12, 'Bienestar Sexual', '2020-09-06 22:30:39', '2020-09-06 22:30:39'),
     (87, 12, 'Medicamentos Genéricos', '2020-09-06 22:30:39', '2020-09-06 22:30:39'),
     (88, 12, 'Medicamentos de Patente', '2020-09-06 22:30:39', '2020-09-06 22:30:39'),
     (89, 12, 'Respiratorios', '2020-09-06 22:30:39', '2020-09-06 22:30:39'),
     (90, 12, 'Oftálmicos y Óticos', '2020-09-06 22:30:39', '2020-09-06 22:30:39'),
     (91, 12, 'Medicamentos de Alta Especialidad', '2020-09-06 22:30:39', '2020-09-06 22:30:39'),
     (92, 12, 'Ortopedia y Equipos de Medición', '2020-09-06 22:30:39', '2020-09-06 22:30:39'),
     (93, 12, 'Dieta', '2020-09-06 22:30:39', '2020-09-06 22:30:39'),
     (94, 12, 'Naturistas y Herbolarios', '2020-09-06 22:30:39', '2020-09-06 22:30:39'),
     (95, 12, 'Nutrición Deportiva', '2020-09-06 22:30:39', '2020-09-06 22:30:39'),
     (96, 12, 'Cuidado de los Pies', '2020-09-06 22:30:39', '2020-09-06 22:30:39'),
     (97, 12, 'Diabetes', '2020-09-06 22:30:39', '2020-09-06 22:30:39'),
     (98, 12, 'Medicamentos Infantiles', '2020-09-06 22:30:39', '2020-09-06 22:30:39'),
     (99, 13, 'Afeitado', '2020-09-06 22:30:39', '2020-09-06 22:30:39'),
     (100, 14, 'Cuidado Bucal', '2020-09-06 22:30:39', '2020-09-06 22:30:39'),
     (101, 14, 'Cuidado Facial', '2020-09-06 22:30:39', '2020-09-06 22:30:39'),
     (102, 14, 'Cosméticos', '2020-09-06 22:30:39', '2020-09-06 22:30:39'),
     (103, 14, 'Cuidado del Cabello', '2020-09-06 22:30:39', '2020-09-06 22:30:39'),
     (104, 14, 'Higiene y Cuidado Corporal', '2020-09-06 22:30:39', '2020-09-06 22:30:39'),
     (105, 14, 'Higiene y Cuidado para Manos', '2020-09-06 22:30:39', '2020-09-06 22:30:39'),
     (106, 14, 'Cuidado para Pies', '2020-09-06 22:30:39', '2020-09-06 22:30:39'),
     (107, 14, 'Pañuelos Desechables', '2020-09-06 22:30:39', '2020-09-06 22:30:39'),
     (108, 14, 'Cuidado Intimo', '2020-09-06 22:30:39', '2020-09-06 22:30:39'),
     (109, 14, 'Kits de Viaje', '2020-09-06 22:30:39', '2020-09-06 22:30:39'),
     (110, 14, 'Higiene Masculina', '2020-09-06 22:30:39', '2020-09-06 22:30:39'),
     (111, 14, 'Accesorios de Moda', '2020-09-06 22:30:39', '2020-09-06 22:30:39'),
     (112, 14, 'Desmaquillantes y Quitaesmaltes', '2020-09-06 22:30:39', '2020-09-06 22:30:39'),
     (113, 14, 'Productos Destacados', '2020-09-06 22:30:39', '2020-09-06 22:30:39'),
     (114, 15, 'Televisores', '2020-09-06 22:30:39', '2020-09-06 22:30:39'),
     (115, 15, 'Telefonía', '2020-09-06 22:30:39', '2020-09-06 22:30:39'),
     (116, 15, 'Computación', '2020-09-06 22:30:39', '2020-09-06 22:30:39'),
     (117, 15, 'Videojuegos', '2020-09-06 22:30:39', '2020-09-06 22:30:39'),
     (118, 15, 'Audio', '2020-09-06 22:30:39', '2020-09-06 22:30:39'),
     (119, 15, 'Fotografía', '2020-09-06 22:30:39', '2020-09-06 22:30:39'),
     (120, 16, 'Hombre', '2020-09-06 22:30:39', '2020-09-06 22:30:39'),
     (121, 16, 'Mujer', '2020-09-06 22:30:39', '2020-09-06 22:30:39');

CREATE TABLE marks(id_mark INT AUTO_INCREMENT PRIMARY KEY,
						name VARCHAR(30) UNIQUE NOT NULL,
						create_at DATETIME NOT NULL,
						update_at DATETIME NOT NULL)
						Engine = InnoDB CHARACTER SET 'UTF8' COLLATE 'utf8_general_ci';

CREATE TABLE images(id_image INT AUTO_INCREMENT PRIMARY KEY,
						name VARCHAR(30) UNIQUE NOT NULL)
						Engine = InnoDB CHARACTER SET 'UTF8' COLLATE 'utf8_general_ci';

CREATE TABLE products(id_product INT AUTO_INCREMENT PRIMARY KEY,
						id_mark INT,
						FOREIGN KEY (id_mark) REFERENCES marks (id_mark)
						ON DELETE CASCADE ON UPDATE CASCADE,
						upc CHAR(12) UNIQUE NOT NULL,
						name VARCHAR(50) NOT NULL,
						description VARCHAR(500),
						price FLOAT(5,2) NOT NULL,
						stock INT(5) NOT NULL)
						Engine = InnoDB CHARACTER SET 'UTF8' COLLATE 'utf8_general_ci';

CREATE TABLE images_products(id_images_product INT AUTO_INCREMENT PRIMARY KEY,
						id_image INT,
						FOREIGN KEY (id_image) REFERENCES images (id_image)
						ON DELETE CASCADE ON UPDATE CASCADE,
						id_product INT,
						FOREIGN KEY (id_product) REFERENCES products (id_product)
						ON DELETE CASCADE ON UPDATE CASCADE)
						Engine = InnoDB CHARACTER SET 'UTF8' COLLATE 'utf8_general_ci';						

CREATE TABLE stocks(id_stock INT AUTO_INCREMENT PRIMARY KEY,
					id_subcategory INT,
					FOREIGN KEY (id_subcategory) REFERENCES subcategories (id_subcategory)
					ON DELETE CASCADE ON UPDATE CASCADE,
					id_product INT,
					FOREIGN KEY (id_product) REFERENCES products (id_product)
					ON DELETE CASCADE ON UPDATE CASCADE)
					Engine = InnoDB CHARACTER SET 'UTF8' COLLATE 'utf8_general_ci';

CREATE TABLE favorites(id_favorite INT AUTO_INCREMENT PRIMARY KEY,
						id_check INT,
						FOREIGN KEY (id_check) REFERENCES checks (id_check)
						ON DELETE CASCADE ON UPDATE CASCADE,
						id_stock INT,
						FOREIGN KEY (id_stock) REFERENCES stocks (id_stock)
						ON DELETE CASCADE ON UPDATE CASCADE)
						Engine = InnoDB CHARACTER SET 'UTF8' COLLATE 'utf8_general_ci';

CREATE TABLE buys(id_buy INT AUTO_INCREMENT PRIMARY KEY,
					id_check INT,
					FOREIGN KEY (id_check) REFERENCES checks (id_check)
					ON DELETE CASCADE ON UPDATE CASCADE,
					total FLOAT(9,2) NOT NULL)
					Engine = InnoDB CHARACTER SET 'UTF8' COLLATE 'utf8_general_ci';

CREATE TABLE list_products(id_list_products INT AUTO_INCREMENT PRIMARY KEY,
							id_stock INT,
							FOREIGN KEY (id_stock) REFERENCES stocks (id_stock)
							ON DELETE CASCADE ON UPDATE CASCADE,
							id_buy INT,
							FOREIGN KEY (id_buy) REFERENCES buys (id_buy)
							ON DELETE CASCADE ON UPDATE CASCADE,
							price FLOAT(5,2),
							amount INT(5))
							Engine = InnoDB CHARACTER SET 'UTF8' COLLATE 'utf8_general_ci';		

CREATE TABLE mailbox(id_mailbox INT AUTO_INCREMENT PRIMARY KEY,
						id_check INT,
						FOREIGN KEY (id_check) REFERENCES checks (id_check)
						ON DELETE CASCADE ON UPDATE CASCADE,
						commentary VARCHAR(30) UNIQUE NOT NULL,
						create_at DATETIME NOT NULL,
						status ENUM("NEW", "READ"))
						Engine = InnoDB CHARACTER SET 'UTF8' COLLATE 'utf8_general_ci';	

CREATE TABLE cards(id_card INT AUTO_INCREMENT PRIMARY KEY,
					number_card CHAR(16) UNIQUE,
					cvv CHAR(3),
					exp_month INT(2),
					exp_year INT(2),
					type_card ENUM('Debito', 'Credito'),
					balance FLOAT(9,2),
					nip CHAR(4),
					company ENUM('Visa', 'Master Card', 'American Express'))
					Engine = InnoDB CHARACTER SET 'UTF8' COLLATE 'utf8_general_ci';

INSERT INTO `cards` (`id_card`, `number_card`, `cvv`, `exp_month`, `exp_year`, `type_card`, `balance`, `nip`, `company`) VALUES
     (1, '3506901036796550', '343', 11, 38, 'Debito', 3364.00, '5317', 'American Express'),
     (2, '3096365969267100', '413', 8, 39, 'Debito', 2479.00, '3877', 'American Express'),
     (3, '3475716178795020', '644', 10, 47, 'Credito', 758.00, '2510', 'American Express'),
     (4, '3054402886460260', '943', 1, 21, 'Credito', 4740.00, '7723', 'American Express'),
     (5, '3600587550751020', '108', 4, 20, 'Credito', 3964.00, '1492', 'American Express'),
     (6, '3171917645850420', '487', 2, 33, 'Debito', 3093.00, '8921', 'American Express'),
     (7, '3698906111616010', '381', 2, 32, 'Debito', 902.00, '6826', 'American Express'),
     (8, '3790233057549580', '308', 12, 47, 'Credito', 3661.00, '2979', 'American Express'),
     (9, '3364716779852630', '994', 9, 30, 'Credito', 2465.00, '8543', 'American Express'),
     (10, '3993891623217180', '333', 10, 33, 'Debito', 3429.00, '2080', 'American Express'),
     (11, '3115537653662300', '905', 10, 39, 'Debito', 4772.00, '8224', 'American Express'),
     (12, '3054253507279540', '395', 6, 37, 'Debito', 3485.00, '6257', 'American Express'),
     (13, '3430350525632310', '997', 12, 29, 'Credito', 3939.00, '7699', 'American Express'),
     (14, '3137294677319060', '173', 1, 47, 'Credito', 4337.00, '2832', 'American Express'),
     (15, '3542376868021240', '977', 3, 45, 'Debito', 4227.00, '1595', 'American Express'),
     (16, '3556802390856450', '918', 10, 28, 'Debito', 1516.00, '1305', 'American Express'),
     (17, '3202802045591800', '969', 11, 47, 'Credito', 49.00, '5544', 'American Express'),
     (18, '3067686949237700', '167', 10, 32, 'Credito', 3020.00, '1805', 'American Express'),
     (19, '3318205783334880', '366', 11, 39, 'Credito', 4996.00, '9249', 'American Express'),
     (20, '3836113904270970', '894', 11, 24, 'Debito', 4560.00, '2241', 'American Express'),
     (21, '4430936471238860', '456', 10, 42, 'Debito', 4382.00, '3501', 'Visa'),
     (22, '4335895530102770', '107', 10, 22, 'Debito', 3387.00, '7588', 'Visa'),
     (23, '4110096304345100', '786', 11, 46, 'Debito', 4762.00, '4745', 'Visa'),
     (24, '4862895894173720', '601', 4, 29, 'Credito', 1221.00, '2532', 'Visa'),
     (25, '4811576898380850', '307', 3, 30, 'Debito', 1456.00, '3410', 'Visa'),
     (26, '4768362191203960', '441', 11, 37, 'Debito', 930.00, '4211', 'Visa'),
     (27, '4896153591680200', '886', 4, 34, 'Credito', 2820.00, '7520', 'Visa'),
     (28, '4180431883872830', '200', 1, 47, 'Debito', 2094.00, '4486', 'Visa'),
     (29, '4981170023883230', '386', 8, 26, 'Credito', 718.00, '3025', 'Visa'),
     (30, '4303757239162770', '437', 11, 47, 'Credito', 4057.00, '8355', 'Visa'),
     (31, '4331861639030920', '811', 2, 26, 'Debito', 3062.00, '5476', 'Visa'),
     (32, '4342368226189500', '730', 6, 47, 'Credito', 3276.00, '4407', 'Visa'),
     (33, '4494440131554870', '425', 2, 42, 'Debito', 4217.00, '5721', 'Visa'),
     (34, '4536910293760820', '389', 5, 20, 'Debito', 3486.00, '8354', 'Visa'),
     (35, '4181213312173740', '876', 6, 47, 'Debito', 3705.00, '1652', 'Visa'),
     (36, '4577564099124170', '553', 8, 32, 'Credito', 981.00, '6982', 'Visa'),
     (37, '4176627456304190', '160', 3, 30, 'Debito', 826.00, '9454', 'Visa'),
     (38, '4004377117429730', '924', 11, 34, 'Credito', 2101.00, '5646', 'Visa'),
     (39, '4378139020847710', '316', 2, 46, 'Debito', 4653.00, '1068', 'Visa'),
     (40, '4501073781224870', '498', 10, 38, 'Credito', 976.00, '2123', 'Visa'),
     (41, '5479038755537450', '284', 6, 22, 'Debito', 805.00, '9210', 'Master Card'),
     (42, '5672391974259570', '178', 3, 43, 'Credito', 1389.00, '7669', 'Master Card'),
     (43, '5510438165557870', '544', 10, 35, 'Credito', 2990.00, '7896', 'Master Card'),
     (44, '5471621126039800', '995', 10, 30, 'Debito', 1764.00, '9691', 'Master Card'),
     (45, '5966722072267110', '756', 4, 28, 'Credito', 3986.00, '8809', 'Master Card'),
     (46, '5553588345760980', '166', 12, 42, 'Debito', 2220.00, '7682', 'Master Card'),
     (47, '5864093771238580', '681', 12, 28, 'Credito', 1438.00, '2887', 'Master Card'),
     (48, '5171559487205820', '585', 4, 40, 'Debito', 4026.00, '3659', 'Master Card'),
     (49, '5295246399313050', '374', 3, 47, 'Debito', 4385.00, '7146', 'Master Card'),
     (50, '5762756593375880', '604', 11, 28, 'Debito', 2387.00, '4383', 'Master Card'),
     (51, '5603802557723970', '815', 9, 25, 'Debito', 343.00, '7920', 'Master Card'),
     (52, '5956236797962360', '390', 11, 29, 'Credito', 1107.00, '2125', 'Master Card'),
     (53, '5175674757968290', '581', 9, 39, 'Credito', 4670.00, '3925', 'Master Card'),
     (54, '5846203394154620', '868', 4, 26, 'Debito', 737.00, '5968', 'Master Card'),
     (55, '5342095530058990', '639', 9, 22, 'Credito', 3503.00, '2640', 'Master Card'),
     (56, '5972869016697020', '218', 10, 36, 'Credito', 4498.00, '3596', 'Master Card'),
     (57, '5230619608556740', '254', 10, 44, 'Credito', 502.00, '5097', 'Master Card'),
     (58, '5640175154368520', '984', 2, 30, 'Credito', 126.00, '1410', 'Master Card'),
     (59, '5908775850792480', '971', 5, 40, 'Debito', 2285.00, '3499', 'Master Card'),
     (60, '5403216340043850', '877', 5, 31, 'Debito', 4425.00, '9587', 'Master Card');

CREATE TABLE user_card(id_user_card INT AUTO_INCREMENT PRIMARY KEY,
						id_check INT,
						FOREIGN KEY (id_check) REFERENCES checks (id_check)
						ON DELETE CASCADE ON UPDATE CASCADE,
						id_card INT,
						FOREIGN KEY (id_card) REFERENCES cards (id_card)
						ON DELETE CASCADE ON UPDATE CASCADE)
						Engine = InnoDB CHARACTER SET 'UTF8' COLLATE 'utf8_general_ci';																						