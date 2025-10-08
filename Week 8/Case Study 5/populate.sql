-- Dummy data for 'Drink' table
INSERT INTO Drink (name, `desc`) VALUES
('Just Java', 'Regular house blend, decaffeinated coffee, or flavor of the day.'),
('Cafe au Lait', 'House blended coffee infused into a smooth, steamed milk.'),
('Iced Cappuccino', 'Sweetened espresso blended with icy-cold milk and served in a chilled glass.');

-- Dummy data for 'DrinkCategory' table
INSERT INTO DrinkCategory (drink_id, price, category) VALUES
(1, 2.00, 'Endless Cup'),
(2, 2.00, 'Single'),
(2, 3.00, 'Double'),
(3, 4.75, 'Single'),
(3, 5.75, 'Double');

-- Dummy data for 'Order' table
INSERT INTO `Order` (date_of_purchase) VALUES
('2024-06-01 12:30:00'),
('2024-06-02 18:45:00');

-- Dummy data for 'OrderItem' table
INSERT INTO OrderItem (order_id, drink_id, quantity) VALUES
(1, 2, 1),
(1, 3, 1),
(2, 5, 1),
(2, 4, 1);
