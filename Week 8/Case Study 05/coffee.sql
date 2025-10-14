CREATE DATABASE IF NOT EXISTS javajam;
USE javajam;
CREATE TABLE IF NOT EXISTS drinks (
    ID INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    description VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS categories (
    ID INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    price FLOAT(5,2) NOT NULL,
    drinksid INT UNSIGNED NOT NULL,
    FOREIGN KEY (drinksid) REFERENCES drinks(ID)
);

CREATE TABLE IF NOT EXISTS receipts (
    ID INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    orderdate DATETIME NOT NULL
);

CREATE TABLE IF NOT EXISTS orders (
    ID INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    categoryid INT UNSIGNED NOT NULL,
    quantity INT UNSIGNED NOT NULL,
    receiptid INT UNSIGNED NOT NULL,
    FOREIGN KEY (categoryid) REFERENCES categories(ID),
    FOREIGN KEY (receiptid) REFERENCES receipts(ID)
);
USE javajam;

-- Drinks
INSERT INTO drinks (name, description)
VALUES
('Just Java', 'Regular house blend, decaffeinated coffee, or flavor of the day.'),
('Cafe au Lait', 'House blended coffee infused into a smooth, steamed milk.'),
('Iced Cappuccino', 'Sweetened espresso blended with icy-cold milk and served in a chilled glass.');

-- Categories
INSERT INTO categories (name, price, drinksid)
VALUES
('Single', 1.00, 1),
('Double', 2.00, 1),
('Single', 2.00, 2),
('Double', 3.00, 2),
('Single', 5.00, 3),
('Double', 6.00, 3);
