--
-- Database: `mustache_adventure_db`
--

DROP DATABASE mustache_adventure_db;
CREATE DATABASE mustache_adventure_db;
USE mustache_adventure_db;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_name` varchar(15) NOT NULL DEFAULT '',
  `email` varchar(100) NOT NULL DEFAULT '',
  `password` varchar(32) NOT NULL DEFAULT '',
  `datetime_added` timestamp NOT NULL,
  PRIMARY KEY (`user_id`)
);

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `first_name`, `last_name`, `email`, `password`, `datetime_added`) VALUES
(1, 'Lindsey', 'Jones', 'lindsey@jones.com', 'abc123', '2014-10-08 00:00:00'),
(2, 'Dave', 'Smith', 'dave@smith.com', 'abc123', '2014-10-23 00:00:00');

-- 
-- Table structure for table `friend`
--

CREATE TABLE `friend` (
    `friend_id_1` int unsigned NOT NULL,
    `friend_id_2` int unsigned NOT NULL,
    FOREIGN KEY (`friend_id_1`) REFERENCES user (`user_id`),
    FOREIGN KEY (`friend_id_2`) REFERENCES user (`user_id`)
);

-- 
-- Table structure for table `comment`
--

CREATE TABLE `comment_type` (
    `comment_type_id` int unsigned NOT NULL AUTO_INCREMENT,
    `name` varchar(15),
    `description` varchar(255),
    PRIMARY KEY (`comment_type_id`)
);

-- 
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
    `comment_id` int unsigned NOT NULL AUTO_INCREMENT,
    `comment_to_user_id` int unsigned NOT NULL,
    `comment_from_user_id` int unsigned NOT NULL,
    `comment_type_id` int unsigned NOT NULL,
    `message` varchar(255) NOT NULL DEFAULT 'man up!',
    `timestamp` timestamp,
    PRIMARY KEY (`comment_id`),
    FOREIGN KEY (`comment_to_user_id`) REFERENCES user (user_id),
    FOREIGN KEY (`comment_from_user_id`) REFERENCES user (user_id),
    FOREIGN KEY (`comment_type_id`) REFERENCES comment_type (comment_type_id)
);

-- 
-- Table structure for table `man_point`
--

CREATE TABLE `man_point` (
    `give_user_id` int unsigned NOT NULL,
    `receive_user_id` int unsigned NOT NULL,
    `comment_id` int unsigned NOT NULL,
    `points` int NOT NULL,
    `timestamp` timestamp,
    FOREIGN KEY (give_user_id) REFERENCES user (user_id),
    FOREIGN KEY (receive_user_id) REFERENCES user (user_id),
    FOREIGN KEY (comment_id) REFERENCES comment (comment_id)
);

-- 
-- Table structure for table `give_point`
--

CREATE TABLE `give_point` (
    `give_point_id` int unsigned NOT NULL,
    `user_id` int unsigned NOT NULL,
    `points` int NOT NULL,
    `timestamp` timestamp,
    `description` varchar(255),
    PRIMARY KEY (`give_point_id`),
    FOREIGN KEY (`user_id`) REFERENCES user (user_id)
);
