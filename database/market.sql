CREATE DATABASE market_new CHARACTER SET 'UTF8' COLLATE 'utf8_general_ci';
USE market_new;

CREATE TABLE states(id_state INT AUTO_INCREMENT PRIMARY KEY,
    state VARCHAR(60) NOT NULL)
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

CREATE TABLE store(id_store INT AUTO_INCREMENT PRIMARY KEY,
    date_entry DATETIME NOT NULL,
    date_exit DATETIME NOT NULL)
    Engine = InnoDB CHARACTER SET 'UTF8' COLLATE 'utf8_general_ci';

CREATE TABLE images(id_image INT AUTO_INCREMENT PRIMARY KEY,
    image VARCHAR(60) NOT NULL,
    type ENUM('slider', 'product') NOT NULL,
    status INT(1) NOT NULL)
    Engine = InnoDB CHARACTER SET 'UTF8' COLLATE 'utf8_general_ci';

CREATE TABLE products_categories(id_product_category INT AUTO_INCREMENT PRIMARY KEY,
    id_product INT,
    FOREIGN KEY (id_product) REFERENCES products (id_product)
    ON DELETE CASCADE ON UPDATE CASCADE,
    id_category INT,
    FOREIGN KEY (id_category) REFERENCES categories (id_category)
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
    vendor CHAR(13) UNIQUE NOT NULL,
    telephone1 CHAR(10) UNIQUE NOT NULL,
    email1 VARCHAR(60) UNIQUE NOT NULL,
    telephone2 CHAR(10) UNIQUE,
    email2 VARCHAR(60) UNIQUE)
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