INSERT INTO sex VALUES('Femme');
INSERT INTO sex VALUES('Homme');
INSERT INTO sex VALUES('Non-binaire');
INSERT INTO sex VALUES('Genderfluid');
INSERT INTO sex VALUES('Pangender');
INSERT INTO sex VALUES('Trans');
INSERT INTO sex VALUES('Pinguoin');
INSERT INTO sex VALUES('Other');

INSERT INTO diet VALUES(default, 'Végétarien');
INSERT INTO diet VALUES(default, 'Sans gluten');
INSERT INTO diet VALUES(default, 'Halal');
INSERT INTO diet VALUES(default, 'Végan');
INSERT INTO diet VALUES(default, 'Sans arachide');
INSERT INTO diet VALUES(default, 'Casher');

INSERT INTO RelationType VALUES(default,'Plan cul régulier','Tu cherches un plan Q régulier car tu aimes croquer la vie à pleine dent');
INSERT INTO RelationType VALUES(default,'Amitié', 'Tu cherches de l amitié rien que de l amitié pour un moment convivial');
INSERT INTO RelationType VALUES(default,'Relation sérieuse', 'Tu recherches quelque chose de sérieux');
INSERT INTO RelationType VALUES(default, 'Juste un soir','Tu cherches un coup d un soir pour ne nuit... caliente !');


INSERT INTO city VALUES(default, 'Evry', '91000'),(default,'Choisy-le-Roi', '94600');
INSERT INTO FeediieUser VALUES
    (default, 'jzpeerz58aze', 'Leanna', '1999-04-11','leiina77410@gmail.com','$2y$10$DMjYUV76Y7GYJlC45pTOKOG8UjFw.tnEfm1WgIqlLzoiImYEKf4ra', 'balbalbal', 
        default, default, default, 'token', true, 1, default, 'Femme');


INSERT INTO FeediieUser VALUES
    (default, 'arjaze98e58a5ab','Valentin', '1998-02-14','valentinbgdu54@gmail.com','$2y$10$DMjYUV76Y7GYJlC45pTOKOG8UjFw.tnEfm1WgIqlLzoiImYEKf4ra', 'Je suis valentin je viens de Nancy',
        default, default, default , 'token2', true, 1, 5, 'Homme');

INSERT INTO FeediieUser VALUES
    (default, 'brjaze98e58a5ab','Naruto', '1992-01-30','naruto@gmail.com','$2y$10$DMjYUV76Y7GYJlC45pTOKOG8UjFw.tnEfm1WgIqlLzoiImYEKf4ra', 'balbalbal',
        default, default, default, 'token3', default, 1, default, 'Homme');

INSERT INTO FeediieUser VALUES
    (default, 'crjaze98e58a5ab','Sakura', '1999-04-11','Sakura@gmail.com','$2y$10$DMjYUV76Y7GYJlC45pTOKOG8UjFw.tnEfm1WgIqlLzoiImYEKf4ra', 'balbalbal',
        default, default, default, 'token4', default, 1, default, 'Femme');

INSERT INTO FeediieUser VALUES
    (default, 'drjaze98e58a5ab','Sasuke', '1999-04-11','sasuke@gmail.com','$2y$10$DMjYUV76Y7GYJlC45pTOKOG8UjFw.tnEfm1WgIqlLzoiImYEKf4ra', 'balbalbal',
        default, default, default, 'token5', default, 1, default, 'Homme');

INSERT INTO FeediieUser VALUES
    (default, 'erjaze98e58conta5ab','Itachi', '1985-04-11','itachi@gmail.com','$2y$10$DMjYUV76Y7GYJlC45pTOKOG8UjFw.tnEfm1WgIqlLzoiImYEKf4ra', 'balbalbal',
        default, default, default, 'token6', default, 1, default, 'Homme');

INSERT INTO LikedUser VALUES (2, 3, '2020-04-18 15:35:36', true);
INSERT INTO LikedUser VALUES (3, 2, '2020-04-18 15:35:36', true);

INSERT INTO LikedUser VALUES (2, 4, '2020-04-18 13:54:36', true);
INSERT INTO LikedUser VALUES (4, 2, '2020-04-18 13:54:36', true);

INSERT INTO LikedUser VALUES (2, 5, '2020-04-18 13:54:36', false);

INSERT INTO LikedUser VALUES (6, 2, '2020-04-18 13:54:36', false);


INSERT INTO Contact VALUES (default, 2, 3, 'Salut beau renard', '2020-04-18 17:35:36', true);
INSERT INTO Contact VALUES (default, 3, 2, 'Salut dattebayo!', '2020-04-18 17:38:36', false);

INSERT INTO Contact VALUES (default, 2, 4, 'Salut la planche!', '2020-04-18 17:35:36', true);


INSERT INTO Photo VALUES
    (default, '/Images/UserUpload/jzpeerz58aze/1.jpg', true, 1);

INSERT INTO Photo VALUES
    (default, '/Images/UserUpload/arjaze98e58a5ab/1.jpg', true, 2);

INSERT INTO Photo VALUES
    (default, '/Images/UserUpload/crjaze98e58a5ab/1.jpeg', true, 4);

INSERT INTO Dish VALUES (default, 'Pizza', '/Images/Dish/pizza.png');
INSERT INTO Dish VALUES (default, 'Chocolat', '/Images/Dish/chocolat.jpg');
INSERT INTO Dish VALUES (default, 'Raclette', '/Images/Dish/raclette.jpg');

INSERT INTO PersonalityDish VALUES (default, 'Sportif et en forme!', 'Sportif', '/Images/Dish/salad.png');
INSERT INTO PersonalityDish VALUES (default, 'Sportif et en forme!', 'Gourmand', '/Images/Dish/chocolat.jpg');
INSERT INTO PersonalityDish VALUES (default, 'Sportif et en forme!', 'Pas de prise de tête', '/Images/Dish/burger.png');
INSERT INTO PersonalityDish VALUES (default, 'Sportif et en forme!', 'Partager avant tout', '/Images/Dish/pizza.png');
INSERT INTO PersonalityDish VALUES (default, 'Sportif et en forme!', 'Sans ami? Impossible', '/Images/Dish/raclette.jpg');
INSERT INTO PersonalityDish VALUES (default, 'Sportif et en forme!', 'Attentionné', '/Images/Dish/pommeAmour.jpg');

INSERT INTO Hobby VALUES(default, 'Animation japonaise');
INSERT INTO Hobby VALUES(default, 'Jeux-vidéos');
INSERT INTO Hobby VALUES(default, 'Cinema');
INSERT INTO Hobby VALUES(default, 'Série');
INSERT INTO Hobby VALUES(default, 'Cuisine');
INSERT INTO Hobby VALUES(default, 'Art Martial');
INSERT INTO Hobby VALUES(default, 'Technologie');
INSERT INTO Hobby VALUES(default, 'Danse');
INSERT INTO Hobby VALUES(default, 'Origami');
INSERT INTO Hobby VALUES(default, 'Maquillage');
INSERT INTO Hobby VALUES(default, 'Peinture');
INSERT INTO Hobby VALUES(default, 'Ping-pong');
INSERT INTO Hobby VALUES(default, 'Badminton');
INSERT INTO Hobby VALUES(default, 'Natation');
INSERT INTO Hobby VALUES(default, 'Rugby');
INSERT INTO Hobby VALUES(default, 'Foot');
INSERT INTO Hobby VALUES(default, 'Bowling');
INSERT INTO Hobby VALUES(default, 'Karate');
INSERT INTO Hobby VALUES(default, 'Jogging');
INSERT INTO Hobby VALUES(default, 'Electronique');
INSERT INTO Hobby VALUES(default, 'Potterie');
INSERT INTO Hobby VALUES(default, 'Photographie');
INSERT INTO Hobby VALUES(default, 'Tennis');
INSERT INTO Hobby VALUES(default, 'Billard');
INSERT INTO Hobby VALUES(default, 'Jeux de cartes');
INSERT INTO Hobby VALUES(default, 'Magie');
INSERT INTO Hobby VALUES(default, 'Puzzle');
INSERT INTO Hobby VALUES(default, 'Shopping');
INSERT INTO Hobby VALUES(default, 'Mechanique');
INSERT INTO Hobby VALUES(default, 'Tir à l''arc');
INSERT INTO Hobby VALUES(default, 'Pêche');
INSERT INTO Hobby VALUES(default, 'BasketBall');
INSERT INTO Hobby VALUES(default, 'HandBall');
INSERT INTO Hobby VALUES(default, 'Randonné');
INSERT INTO Hobby VALUES(default, 'Chasse');
INSERT INTO Hobby VALUES(default, 'Surf');
INSERT INTO Hobby VALUES(default, 'Ski');
INSERT INTO Hobby VALUES(default, 'BMX');
INSERT INTO Hobby VALUES(default, 'Equitation');
INSERT INTO Hobby VALUES(default, 'Boxe');
INSERT INTO Hobby VALUES(default, 'Jeux de société');
INSERT INTO Hobby VALUES(default, 'Kart');
INSERT INTO Hobby VALUES(default, 'Science');
INSERT INTO Hobby VALUES(default, 'Animaux');
INSERT INTO Hobby VALUES(default, 'Parachute');
INSERT INTO Hobby VALUES(default, 'Taekwondo');
INSERT INTO Hobby VALUES(default, 'Judo');
INSERT INTO Hobby VALUES(default, 'Soccer');
INSERT INTO Hobby VALUES(default, 'Yoga');
INSERT INTO Hobby VALUES(default, 'Dessin');
INSERT INTO Hobby VALUES(default, 'Sculpture');
INSERT INTO Hobby VALUES(default, 'Collection');
INSERT INTO Hobby VALUES(default, 'Calligraphie');
INSERT INTO Hobby VALUES(default, 'Parkour');
INSERT INTO Hobby VALUES(default, 'Canoë');
INSERT INTO Hobby VALUES(default, 'Kayak');
INSERT INTO Hobby VALUES(default, 'Escalade');
INSERT INTO Hobby VALUES(default, 'Alpinisme');
INSERT INTO Hobby VALUES(default, 'Camping');
INSERT INTO Hobby VALUES(default, 'Paintball');
INSERT INTO Hobby VALUES(default, 'Mode');
INSERT INTO Hobby VALUES(default, 'Jouets');
INSERT INTO Hobby VALUES(default, 'VolleyBall');
INSERT INTO Hobby VALUES(default, 'Skateboard');
INSERT INTO Hobby VALUES(default, 'Laser Game');
INSERT INTO Hobby VALUES(default, 'Water Polo');
INSERT INTO Hobby VALUES(default, 'Gymnastique');
INSERT INTO Hobby VALUES(default, 'Musculation');
INSERT INTO Hobby VALUES(default, 'Cross Fit');
INSERT INTO Hobby VALUES(default, 'Astronomie');
INSERT INTO Hobby VALUES(default, 'Chant');
INSERT INTO Hobby VALUES(default, 'Patin sur glace');
INSERT INTO Hobby VALUES(default, 'Roller');
INSERT INTO Hobby VALUES(default, 'Voyage');

INSERT INTO likeEat VALUES (1,1);
INSERT INTO looklike VALUES (1,1);
INSERT INTO looklike VALUES (2,1);
INSERT INTO looklike VALUES (2,2);
INSERT INTO looklike VALUES (2,4);
INSERT INTO looklike VALUES (2,5);
INSERT INTO looklike VALUES (2,6);

INSERT INTO practice VALUES(1,1);
INSERT INTO interesteddiet VALUES (1,1);
INSERT INTO interesteddiet VALUES (1,2);
INSERT INTO interesteddiet VALUES (1,3);
INSERT INTO interesteddiet VALUES (1,4);
INSERT INTO interesteddiet VALUES (2,1);
INSERT INTO interesteddiet VALUES (2,2);
INSERT INTO interesteddiet VALUES (2,3);
INSERT INTO interesteddiet VALUES (2,4);

INSERT INTO interestedsex VALUES (2,'Femme');
INSERT INTO interestedsex VALUES (2,'Pangender');
INSERT INTO interestedsex VALUES (2,'Pinguoin');

INSERT INTO interestedRelationType VALUES (2,'1');
INSERT INTO interestedRelationType VALUES (2,'2');
INSERT INTO interestedRelationType VALUES (1,'1');
INSERT INTO interestedRelationType VALUES (1,'2');
INSERT INTO rangeDistance VALUES (2,'66');
INSERT INTO rangeDistance VALUES (1,'88');

INSERT INTO rangeAge VALUES (2,'20','25');
INSERT INTO rangeAge VALUES (1,'20','25');



