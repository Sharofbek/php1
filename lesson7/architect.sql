DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories`(
	id SERIAL PRIMARY KEY COMMENT "ID of Category",
	name VARCHAR(255) NOT NULL COMMENT "Name of Category",
	created_at DATETIME DEFAULT CURRENT_TIMESTAMP COMMENT "When created",
	updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT "When updated"
)Engine=InnoDB;

DROP TABLE IF EXISTS `products`;
CREATE TABLE `products`(
	id SERIAL PRIMARY KEY COMMENT "ID of Product",
	category_id BIGINT UNSIGNED NOT NULL,
    name VARCHAR(255) NOT NULL COMMENT "Name of Product",
	description TEXT NOT NULL COMMENT "Description of Product",
	price DECIMAL(10,2) NOT NULL COMMENT "Price of Product",
	img_lg VARCHAR(255) NOT NULL COMMENT "Path to Large size image",
	img_md VARCHAR(255) NOT NULL COMMENT "Path to middle size image",
	img_sm VARCHAR(255) NOT NULL COMMENT "Path to small image",
	overview_video VARCHAR(255) COMMENT "Path to overview video if exists",
	sold INTEGER UNSIGNED NOT NULL DEFAULT 0 COMMENT "How much times sold this product",
	-- FOREIGN KEY (category_id) REFERENCES categories (id) ON DELETE CASCADE,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP COMMENT "When created",
	updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT "When updated"
)Engine=InnoDB;

-- DROP TABLE IF EXISTS `images`;
-- CREATE TABLE `images`(
-- 	id SERIAL PRIMARY KEY COMMENT "ID of Category",
-- 	product_id BIGINT UNSIGNED NOT NULL,
-- 	`path` VARCHAR(255) NOT NULL COMMENT "path to the current image",
--     FOREIGN KEY (product_id) REFERENCES products (id) ON DELETE CASCADE,
-- 	created_at DATETIME DEFAULT CURRENT_TIMESTAMP COMMENT "When created",
-- 	updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT "When updated"
-- )Engine=InnoDB;

DROP TABLE IF EXISTS `product_comments`;
CREATE TABLE `product_comments`(
	id SERIAL PRIMARY KEY COMMENT "ID of comment",
	user_id BIGINT UNSIGNED NOT NULL,
	phone_number VARCHAR(255) NOT NULL,
	product_id BIGINT UNSIGNED NOT NULL,
	content VARCHAR(255) NOT NULL COMMENT "comment for specific product",
    FOREIGN KEY (product_id) REFERENCES products (id) ON DELETE CASCADE,
	created_at DATETIME DEFAULT CURRENT_TIMESTAMP COMMENT "When created",
	updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT "When updated"
)Engine=InnoDB;

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`(
	id SERIAL PRIMARY KEY COMMENT "ID of comment",
	is_admin TINYINT default 0,
	name  VARCHAR(255) NOT NULL,
	login VARCHAR(255) NOT NULL UNIQUE,
	email VARCHAR(255) NOT NULL UNIQUE,
	password VARCHAR(255) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP COMMENT "When created",
	updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT "When updated"
)Engine=InnoDB;

DROP TABLE IF EXISTS `basket`;
CREATE TABLE `basket`(
	id SERIAL PRIMARY KEY,
	user_id BIGINT UNSIGNED NOT NULL,
	product_id BIGINT UNSIGNED NOT NULL,
	quantity int unsigned not null,
	FOREIGN KEY (product_id) REFERENCES products (id) ON DELETE CASCADE,
	FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE,
	created_at DATETIME DEFAULT CURRENT_TIMESTAMP COMMENT "When created",
	updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT "When updated"
)Engine=InnoDB;

insert into users (name, login, email, password, is_admin) values ("Admin", "admin", "admin@admin.com", concat("?(*C123&5#a6wedfOOapeu1",md5("password?(*C123&5#a6wedfOOapeu1")), 1);

DROP TABLE IF EXISTS `feedbacks`;
CREATE TABLE `feedbacks`(
	id SERIAL PRIMARY KEY COMMENT "ID of comment",
	name VARCHAR(255)  NOT NULL,
	email VARCHAR(255)  NOT NULL,
	subject VARCHAR(255)  NOT NULL,
	message TEXT NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP COMMENT "When created",
	updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT "When updated"
)Engine=InnoDB;


