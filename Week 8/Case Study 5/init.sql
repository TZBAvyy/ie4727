DROP TABLE IF EXISTS `OrderItem`;
DROP TABLE IF EXISTS `Order`;
DROP TABLE IF EXISTS `DrinkCategory`;
DROP TABLE IF EXISTS `Drink`;
DROP TABLE IF EXISTS `Customer`;

CREATE TABLE `Drink`(
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `name` TEXT NOT NULL,
    `desc` TEXT NOT NULL
);
CREATE TABLE `Order`(
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `date_of_purchase` DATETIME NOT NULL
);
CREATE TABLE `OrderItem`(
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `order_id` BIGINT UNSIGNED NOT NULL,
    `drink_id` BIGINT UNSIGNED NOT NULL,
    `quantity` BIGINT UNSIGNED NOT NULL
);
CREATE TABLE `DrinkCategory`(
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `drink_id` BIGINT UNSIGNED NOT NULL,
    `price` FLOAT(53) NOT NULL,
    `category` TEXT NOT NULL
);
ALTER TABLE
    `DrinkCategory` ADD CONSTRAINT `drinkcategory_drink_id_foreign` FOREIGN KEY(`drink_id`) REFERENCES `Drink`(`id`);
ALTER TABLE
    `OrderItem` ADD CONSTRAINT `orderitem_order_id_foreign` FOREIGN KEY(`order_id`) REFERENCES `Order`(`id`);
ALTER TABLE
    `OrderItem` ADD CONSTRAINT `orderitem_drink_id_foreign` FOREIGN KEY(`drink_id`) REFERENCES `DrinkCategory`(`id`);