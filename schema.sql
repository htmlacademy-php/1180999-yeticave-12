-- Создание базы данных
CREATE DATABASE yeticave
	DEFAULT CHARacter SET UTF8
	DEFAULT COLLATE UTF8_GENERAL_CI;

-- Используем базу данных
USE yeticave;

-- Создание таблицы категорий
CREATE TABLE categories (
	id INT AUTO_INCREMENT, 
	name VARCHAR(255) NOT NULL, 
	code VARCHAR(255) NOT NULL,
	PRIMARY KEY (id) -- указываю первичный ключ
);

CREATE TABLE users (
	id INT AUTO_INCREMENT,
	dt_add DATETIME NOT NULL,
	name VARCHAR(255) NOT NULL,
	email VARCHAR(255) NOT NULL UNIQUE, -- поле с проверкой на уникальность
	pass VARCHAR(255) NOT NULL,
	contacts VARCHAR(255) NOT NULL,
	PRIMARY KEY (id) -- указываю первичный ключ
);

CREATE TABLE lots (
	id INT AUTO_INCREMENT,
	user_id INT NOT NULL,
	category_id INT NOT NULL,
	dt_add DATETIME NOT NULL,
	name VARCHAR(255) NOT NULL,
	description VARCHAR(255) NOT NULL,
	image VARCHAR(255) NOT NULL,
	price INT NOT NULL,
	dt_end TIMESTAMP NOT NULL,
	step INT NOT NULL,
	PRIMARY KEY (id),
	INDEX lots_name_idx (name),   		-- создаю индекс для поля, по которому будет поиск
	INDEX lots_category_idx (category_id),	-- создаю индекс для поля, по которому будет поиск
	INDEX lots_user_idx (user_id), 			-- создаю индекс для поля, по которому будет поиск
	FOREIGN KEY (category_id) REFERENCES categories (id),  -- указываю внешний ключ для поля
	FOREIGN KEY (user_id) REFERENCES users (id)				-- указываю внешний ключ для поля
);

CREATE TABLE bets (
	id INT AUTO_INCREMENT,
	user_id INT NOT NULL,
	lot_id INT NOT NULL,
	dt_add DATETIME,
	price INT NOT NULL,
	PRIMARY KEY (id), 
	INDEX bets_user_idx (user_id),
	INDEX bets_lot_idx (lot_id), 								
	FOREIGN KEY (user_id) REFERENCES users (id),	-- указываю внешний ключ для поля
	FOREIGN KEY (lot_id) REFERENCES lots (id)		-- указываю внешний ключ для поля
);
 

