--
-- Database: mustache_adventure_db
--

DROP DATABASE mustache_adventure_db;
CREATE DATABASE mustache_adventure_db;
USE mustache_adventure_db;

-- --------------------------------------------------------

--
-- Table structure for table user
--

CREATE TABLE user (
  user_id int unsigned NOT NULL AUTO_INCREMENT,
  user_name varchar(15) NOT NULL DEFAULT '',
  email varchar(100) NOT NULL DEFAULT '',
  `password` char(41) NOT NULL DEFAULT '',
  `timestamp` timestamp NOT NULL,
  PRIMARY KEY (user_id)
);

-- 
-- Table structure for table comment
--

CREATE TABLE comment (
    comment_id int unsigned NOT NULL AUTO_INCREMENT,
    user_id int unsigned NOT NULL,
    message varchar(255) NOT NULL DEFAULT 'man up!',
    `timestamp` timestamp NOT NULL,
    PRIMARY KEY (comment_id),
    FOREIGN KEY (user_id) REFERENCES user(user_id)
);

-- 
-- Table structure for table man_point
--

CREATE TABLE man_point (
    user_id int unsigned NOT NULL,
    comment_id int unsigned NOT NULL,
    points int NOT NULL,
    `timestamp` timestamp,
    PRIMARY KEY (user_id, comment_id),
    FOREIGN KEY (user_id) REFERENCES user (user_id),
    FOREIGN KEY (comment_id) REFERENCES comment (comment_id)
);

-- --------------------------------------------------------

--
-- Dumping data for table user
--

INSERT INTO 
    user (user_name, email, `password`)
    VALUES 
        ('LindseyGirl', 'lindsey@jones.com',
            PASSWORD(CONCAT('LindseyGirl', 'abc123'))),
        ('Smithy', 'dave@smith.com',
            PASSWORD(CONCAT('Smithy', 'abc124'))),
        ('H4X0R', 'hkd@l33t.com',
            PASSWORD(CONCAT('H4X0R', 'abc123'))),
        ('Nathan', 'bwestfall@glitter.com',
            PASSWORD(CONCAT('Nathan', 'password'))),
        ('Mark', 'mark@toughguy.com',
            PASSWORD(CONCAT('Mark', 'password'))),
        ('Brad', 'bflahive@glitter.com',
            PASSWORD(CONCAT('Brad', 'password'))),
        ('John', 'John@cox.com',
            PASSWORD(CONCAT('John', 'password')));

INSERT INTO
    comment (user_id, message)
    VALUES
        (1, 'I love manly men!'),
        (1, 'http://imgur.com/r/funny/RgTbcpr'),
        (5, 'Demoing the deck and putting in the hottub'),
        (3, 'Used a straight edge razor to shave while flying'),
        (2, 'Scaled mount everest in a speedo...'),
        (6, 'Made a spear and went fishing'),
        (4, 'Watching the All Blacks game...on the field.'),
        (1, 'How many points can a WOman get on this forum!'),
        (3, 'Cut my toenails with a chainsaw'),
        (6, 'Just changed a tire without a car jack'),
        (4, 'BBQing like a crazy man. One hog and 50 chickens slowly cooking since yesterday'),
        (7, 'Played Mike Tysons Punchout...with Mike Tyson'),
        (3, 'Hacked the website'),
        (2, 'Ate steel for breakfast this morning'),
        (5, 'Called Chuck Norris a wuss and survived. Doctors are hopeful I will regain feeling below my neck again someday');
        -- doesn't like the below line.  Like seems to be a reserved word? Also, punctuation
        -- (1, 'I don't like to brag but...'),

INSERT INTO
    man_point (user_id, comment_id, points)
    VALUES
        (1, 3, 5), (1, 4, 5), (1, 1, 5), (2, 1, 5), (3, 2, 5), (6, 6, 5), (6, 7, 5), (6, 8, 5), (6, 9, 5), (6, 10, 5), (6, 11, 5), (6, 12, 5), (6, 13, 1000000), (6, 14, 5), (4, 5, 5);

REPLACE INTO
    man_point (user_id, comment_id, points)
    VALUES (3, 5, 15);

