DROP TABLE IF EXISTS `Tickets`;
DROP TABLE IF EXISTS `Schedules`;
DROP TABLE IF EXISTS `Movies`;
DROP TABLE IF EXISTS `Users`;
DROP TABLE IF EXISTS `Seats`;

CREATE TABLE `Movies`(
    `movie_id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `name` TEXT NOT NULL,
    `description` TEXT NOT NULL,
    `rating` VARCHAR(6) NOT NULL,
    `duration_in_min` BIGINT NOT NULL,
    `movie_poster` TEXT NOT NULL
);
CREATE TABLE `Users`(
    `user_id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `username` VARCHAR(20) NOT NULL,
    `name` TEXT NOT NULL,
    `email` TEXT NOT NULL,
    `hashpassword` TEXT NOT NULL
);
CREATE TABLE `Tickets`(
    `ticket_id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `user_id` BIGINT UNSIGNED NOT NULL,
    `seat_id` BIGINT UNSIGNED NOT NULL,
    `schedule_id` BIGINT UNSIGNED NOT NULL
);
CREATE TABLE `Seats`(
    `seat_id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `seat_type` VARCHAR(3) NOT NULL,
    `seat_price` FLOAT(53) NOT NULL
);
CREATE TABLE `Schedules`(
    `schedule_id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `movie_id` BIGINT UNSIGNED NOT NULL,
    `date` DATETIME NOT NULL
);
ALTER TABLE
    `Schedules` ADD UNIQUE `schedules_date_unique`(`date`);
ALTER TABLE
    `Tickets` ADD CONSTRAINT `tickets_user_id_foreign` FOREIGN KEY(`user_id`) REFERENCES `Users`(`user_id`);
ALTER TABLE
    `Schedules` ADD CONSTRAINT `schedules_movie_id_foreign` FOREIGN KEY(`movie_id`) REFERENCES `Movies`(`movie_id`);
ALTER TABLE
    `Tickets` ADD CONSTRAINT `tickets_schedule_id_foreign` FOREIGN KEY(`schedule_id`) REFERENCES `Schedules`(`schedule_id`);
ALTER TABLE
    `Tickets` ADD CONSTRAINT `tickets_seat_id_foreign` FOREIGN KEY(`seat_id`) REFERENCES `Seats`(`seat_id`);

-- Insert Movies
INSERT INTO Movies (name, description, rating, duration_in_min, movie_poster) VALUES
('The Dark Knight (2008)', "When a menace known as the Joker wreaks havoc and chaos on the people of Gotham, Batman, James Gordon and Harvey Dent must work together to put an end to the madness.", 'PG-13', 152, 'the-dark-knight-poster.jpg'),
('Inception (2010)', "A thief who steals corporate secrets through the use of dream-sharing technology is given the inverse task of planting an idea into the mind of a C.E.O., but his tragic past may doom the project and his team to disaster.", 'PG-13', 148, 'inception-poster.jpg'),
('Jurassic Park (1993)', "An industrialist invites some experts to visit his theme park of cloned dinosaurs. After a power failure, the creatures run loose, putting everyone's lives, including his grandchildren's, in danger.", 'PG-13', 127, 'jurassic-park-poster.jpg'),
('The Lion King (2019)', "After the murder of his father, a young lion prince flees his kingdom only to learn the true meaning of responsibility and bravery.", 'G', 118, 'the-lion-king-poster.jpg');

-- Insert Users
INSERT INTO Users (username, name, email, hashpassword) VALUES
('john_doe', 'John Doe', 'john@email.com', 'hashed_password_1'),
('jane_smith', 'Jane Smith', 'jane@email.com', 'hashed_password_2'),
('bob123', 'Bob Wilson', 'bob@email.com', 'hashed_password_3');

-- Insert Seats (Different types: 1=Regular, 2=VIP)
-- Seat Arrangement:
-- Most Front Row: A
-- Most Back Row: J
-- Total Seats per Row: 10
-- Total Seats: 100
INSERT INTO Seats (seat_type, seat_price) VALUES
-- Row A (Front, Regular)
('A1', 10.00), ('A2', 10.00), ('A3', 10.00), ('A4', 10.00), ('A5', 10.00),
('A6', 10.00), ('A7', 10.00), ('A8', 10.00), ('A9', 10.00), ('A10', 10.00),
-- Row B (Regular)
('B1', 10.00), ('B2', 10.00), ('B3', 10.00), ('B4', 10.00), ('B5', 10.00),
('B6', 10.00), ('B7', 10.00), ('B8', 10.00), ('B9', 10.00), ('B10', 10.00),
-- Row C (Regular)
('C1', 10.00), ('C2', 10.00), ('C3', 10.00), ('C4', 10.00), ('C5', 10.00),
('C6', 10.00), ('C7', 10.00), ('C8', 10.00), ('C9', 10.00), ('C10', 10.00),
-- Row D (VIP)
('D1', 15.00), ('D2', 15.00), ('D3', 15.00), ('D4', 15.00), ('D5', 15.00),
('D6', 15.00), ('D7', 15.00), ('D8', 15.00), ('D9', 15.00), ('D10', 15.00),
-- Row E (VIP)
('E1', 15.00), ('E2', 15.00), ('E3', 15.00), ('E4', 15.00), ('E5', 15.00),
('E6', 15.00), ('E7', 15.00), ('E8', 15.00), ('E9', 15.00), ('E10', 15.00),
-- Row F (VIP)
('F1', 15.00), ('F2', 15.00), ('F3', 15.00), ('F4', 15.00), ('F5', 15.00),
('F6', 15.00), ('F7', 15.00), ('F8', 15.00), ('F9', 15.00), ('F10', 15.00),
-- Row G (VIP)
('G1', 15.00), ('G2', 15.00), ('G3', 15.00), ('G4', 15.00), ('G5', 15.00),
('G6', 15.00), ('G7', 15.00), ('G8', 15.00), ('G9', 15.00), ('G10', 15.00),
-- Row H (Regular)
('H1', 10.00), ('H2', 10.00), ('H3', 10.00), ('H4', 10.00), ('H5', 10.00),
('H6', 10.00), ('H7', 10.00), ('H8', 10.00), ('H9', 10.00), ('H10', 10.00),
-- Row I (Regular)
('I1', 10.00), ('I2', 10.00), ('I3', 10.00), ('I4', 10.00), ('I5', 10.00),
('I6', 10.00), ('I7', 10.00), ('I8', 10.00), ('I9', 10.00), ('I10', 10.00),
-- Row J (Back, Regular)
('J1', 10.00), ('J2', 10.00), ('J3', 10.00), ('J4', 10.00), ('J5', 10.00),
('J6', 10.00), ('J7', 10.00), ('J8', 10.00), ('J9', 10.00), ('J10', 10.00);

-- Insert Schedules
INSERT INTO Schedules (movie_id, date) VALUES
(1, '2025-11-01 14:30:00'),
(1, '2025-11-01 18:30:00'),
(2, '2025-11-02 15:00:00'),
(3, '2025-11-02 20:00:00'),
(4, '2025-11-03 13:00:00');

-- Insert Tickets
INSERT INTO Tickets (user_id, seat_id, schedule_id) VALUES
(1, 1, 1),  -- John books seat A1 for Dark Knight
(1, 2, 1),  -- John books seat A2 for Dark Knight
(2, 45, 2),  -- Jane books VIP E5 seat for Dark Knight
(3, 3, 3);  -- Bob books seat for Inception