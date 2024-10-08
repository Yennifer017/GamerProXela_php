/*
 * This document contain the code for the DB for the Gamer Pro Xela, 
 * please create a superuser to 
 * administrate the DB, it's not equals to 'adminGX'
 * 
 * Also it's necessary to run the file initial-data.sql
 */

--table creation
CREATE TABLE administrative.params(
	id SERIAL PRIMARY KEY,
	name VARCHAR(10) UNIQUE NOT NULL,
	value MONEY NOT NULL
);
CREATE TABLE administrative.card_category (
	id SERIAL PRIMARY KEY,
	type VARCHAR(10) UNIQUE NOT NULL,
	points INTEGER NOT NULL DEFAULT 0,
	to_upgrade MONEY NOT NULL CHECK (to_upgrade >= CAST(0 AS MONEY))
);
CREATE TABLE administrative.sucursal(
	id SERIAL PRIMARY KEY,
	name VARCHAR(30) UNIQUE NOT NULL,
	total_checkouts INTEGER NOT NULL CHECK(total_checkouts >= 0),
	total_halls INTEGER NOT NULL CHECK(total_halls >= 0)
);
CREATE TYPE administrative.user_rol AS ENUM('admin', 'cajero', 'bodega', 'inventario');
CREATE TABLE administrative.worker(
	id SERIAL PRIMARY KEY,
	rol administrative.user_rol NOT NULL,
	username VARCHAR(16) NOT NULL UNIQUE,
	password VARCHAR(40) NOT NULL
);
CREATE TABLE administrative.cajero(
	id_worker SERIAL PRIMARY KEY,
	id_sucursal INTEGER NOT NULL,
	no_checkout INTEGER NOT NULL,
	FOREIGN KEY (id_worker) REFERENCES administrative.worker(id),
	FOREIGN KEY (id_sucursal) REFERENCES administrative.sucursal(id)
);
CREATE TABLE administrative.assigned(
	id_worker SERIAL PRIMARY KEY,
	id_sucursal INTEGER NOT NULL,
	FOREIGN KEY (id_worker) REFERENCES administrative.worker(id),
	FOREIGN KEY (id_sucursal) REFERENCES administrative.sucursal(id)
);
CREATE TABLE business.product(
	id SERIAL PRIMARY KEY,
	name VARCHAR(70) UNIQUE,
	price MONEY CHECK (price >= CAST(0 AS MONEY))
);
CREATE TABLE administrative.discount(
	id SERIAL PRIMARY KEY,
	id_product INTEGER NOT NULL,
	percentaje FLOAT NOT NULL CHECK (percentaje >= 0 AND percentaje <= 1),
	date_init DATE NOT NULL,
	date_end DATE,
	FOREIGN KEY (id_product) REFERENCES business.product(id)
);
CREATE TABLE users.client(
	id BIGINT PRIMARY KEY,
	firstname VARCHAR(25),
	lastname VARCHAR(25),
	email VARCHAR(60)
);
CREATE TYPE users.mod_status AS ENUM('aprobado', 'denegado', 'pendiente');
CREATE TABLE users.modification(
	id SERIAL PRIMARY KEY,
	id_cajero INTEGER NOT NULL,
	id_cliente INTEGER NOT NULL,
	firstname VARCHAR(25),
	lastname VARCHAR(25),
	email VARCHAR(60),
	status users.mod_status NOT NULL,
	FOREIGN KEY (id_cajero) REFERENCES administrative.cajero(id_worker),
	FOREIGN KEY (id_cliente) REFERENCES users.client(id)
);
CREATE TABLE users.card(
	id_client INTEGER PRIMARY KEY,
	id_category INTEGER NOT NULL,
	accumulated MONEY NOT NULL DEFAULT 0 CHECK (accumulated >= CAST(0 AS MONEY)),
	FOREIGN KEY (id_client) REFERENCES users.client(id),
	FOREIGN KEY (id_category) REFERENCES administrative.card_category(id)
);
CREATE TABLE business.sale(
	number SERIAL PRIMARY KEY,
	id_client INTEGER,
	id_sucursal INTEGER NOT NULL,
	id_cajero INTEGER NOT NULL,
	date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	FOREIGN KEY (id_client) REFERENCES users.client(id),
	FOREIGN KEY (id_sucursal) REFERENCES administrative.sucursal(id),
	FOREIGN KEY (id_cajero) REFERENCES administrative.cajero(id_worker)
);
CREATE TABLE business.card_discount(
	id_sale INTEGER PRIMARY KEY,
	id_card INTEGER NOT NULL,
	total MONEY NOT NULL DEFAULT 0 CHECK (total >= CAST(0 AS MONEY) ),
	FOREIGN KEY (id_sale) REFERENCES business.sale(number),
	FOREIGN KEY (id_card) REFERENCES users.card(id_client)
);
CREATE TABLE business.sold_product(
	id_product INTEGER NOT NULL,
	id_sale INTEGER NOT NULL,
	quantity INTEGER NOT NULL CHECK (quantity > 0),
	current_price MONEY NOT NULL CHECK (current_price >= CAST(0 AS MONEY)),
	price_with_discount MONEY NOT NULL CHECK (current_price >= CAST(0 AS MONEY) ),
	CONSTRAINT pk_sold_product PRIMARY KEY (id_product, id_sale),
	FOREIGN KEY (id_product) REFERENCES business.product(id),
	FOREIGN KEY (id_sale) REFERENCES business.sale(number)
);
CREATE TABLE storage.stock(
	id_sucursal INTEGER NOT NULL,
	id_product INTEGER NOT NULL,
	hall INTEGER NOT NULL,
	existences INTEGER NOT NULL,
	CONSTRAINT pk_stock PRIMARY KEY (id_sucursal, id_product),
	FOREIGN KEY (id_product) REFERENCES business.product(id),
	FOREIGN KEY (id_sucursal) REFERENCES administrative.sucursal(id)
);
CREATE TABLE storage.on_sale(
	id_sucursal INTEGER NOT NULL,
	id_product INTEGER NOT NULL,
	existences INTEGER NOT NULL,
	CONSTRAINT pk_on_sale PRIMARY KEY (id_sucursal, id_product),
	FOREIGN KEY (id_product) REFERENCES business.product(id),
	FOREIGN KEY (id_sucursal) REFERENCES administrative.sucursal(id)
);

CREATE TABLE users.card_upgrade(
	id INTEGER PRIMARY KEY,
	id_cajero INTEGER NOT NULL,
	id_client INTEGER NOT NULL,
	status users.mod_status NOT NULL,
	FOREIGN KEY (id_client) REFERENCES users.client(id),
	FOREIGN KEY (id_cajero) REFERENCES administrative.cajero(id_worker)
);

