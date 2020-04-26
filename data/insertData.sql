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

INSERT INTO city VALUES(default, 'Evry', '91000'),(default,'Choisy-le-Roi', '94600');
INSERT INTO FeediieUser VALUES
    (default, 'jzpeerz58aze', 'Leanna', '1999-04-11','leiina77410@gmail.com','$2y$10$DMjYUV76Y7GYJlC45pTOKOG8UjFw.tnEfm1WgIqlLzoiImYEKf4ra', 'balbalbal', 
        default, default, default, 'token', default, 1, default, 'Femme');


INSERT INTO FeediieUser VALUES
    (default, 'arjaze98e58a5ab','Valentin', '1998-02-14','valentinbgdu54@gmail.com','$2y$10$DMjYUV76Y7GYJlC45pTOKOG8UjFw.tnEfm1WgIqlLzoiImYEKf4ra', 'Je suis valentin je viens de Nancy',
        default, default, default , 'token2', default, 1, default, 'Homme');

INSERT INTO Photo VALUES
    (default, '/Images/UserUpload/jzpeerz58aze/1.jpg', true, 1);

INSERT INTO Photo VALUES
    (default, '/Images/UserUpload/arjaze98e58a5ab/1.jpg', true, 2);

INSERT INTO Dish VALUES (default, 'Pizza', '/Images/Dish/pizza.png');

INSERT INTO PersonalityDish VALUES (default, 'Sportif et en forme!', 'Sportif', '/Images/Dish/salad.png');
INSERT INTO PersonalityDish VALUES (default, 'Sportif et en forme!', 'Gourmand', '/Images/Dish/chocolat.jpg');
INSERT INTO PersonalityDish VALUES (default, 'Sportif et en forme!', 'Pas de prise de tête', '/Images/Dish/burger.png');
INSERT INTO PersonalityDish VALUES (default, 'Sportif et en forme!', 'Partager avant tout', '/Images/Dish/pizza.png');
INSERT INTO PersonalityDish VALUES (default, 'Sportif et en forme!', 'Sans ami? Impossible', '/Images/Dish/raclette.jpg');
INSERT INTO PersonalityDish VALUES (default, 'Sportif et en forme!', 'Attentionné', '/Images/Dish/pommeAmour.jpg');

INSERT INTO Hobby VALUES(default, 'Musique');
INSERT INTO Hobby VALUES(default, 'Jeux-vidéos');
INSERT INTO Hobby VALUES(default, 'Film');
INSERT INTO Hobby VALUES(default, 'Série');
INSERT INTO Hobby VALUES(default, 'Sport');
INSERT INTO Hobby VALUES(default, 'Art Martial');
INSERT INTO Hobby VALUES(default, 'Technologie');

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

INSERT INTO rangeDistance VALUES (2,'66');

INSERT INTO rangeAge VALUES (2,'20','25');


