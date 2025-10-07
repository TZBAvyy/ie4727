CREATE TABLE `Customer`(
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `name` TEXT NOT NULL,
    `email` TEXT NOT NULL
);
CREATE TABLE `Drink`(
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `name` TEXT NOT NULL,
    `desc` TEXT NOT NULL
);
CREATE TABLE `Order`(
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `customer_id` BIGINT UNSIGNED NOT NULL,
    `date_of_purchase` DATE NOT NULL
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
    `price` FLOAT NOT NULL,
    `category` TEXT NOT NULL
);
ALTER TABLE
    `Order` ADD CONSTRAINT `order_customer_id_foreign` FOREIGN KEY(`customer_id`) REFERENCES `Customer`(`id`);
ALTER TABLE
    `DrinkCategory` ADD CONSTRAINT `drinkcategory_drink_id_foreign` FOREIGN KEY(`drink_id`) REFERENCES `Drink`(`id`);
ALTER TABLE
    `OrderItem` ADD CONSTRAINT `orderitem_order_id_foreign` FOREIGN KEY(`order_id`) REFERENCES `Order`(`id`);
ALTER TABLE
    `OrderItem` ADD CONSTRAINT `orderitem_drink_id_foreign` FOREIGN KEY(`drink_id`) REFERENCES `DrinkCategory`(`id`);