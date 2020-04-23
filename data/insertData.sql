INSERT INTO sex VALUES('Femme');
INSERT INTO sex VALUES('Homme');
INSERT INTO city VALUES(default, 'Evry', '91000'),(default,'Choisy-le-Roi', '94600');
INSERT INTO FeediieUser VALUES
    (default, 'jzpeerz58aze', 'Leanna', 'Ji', '1999-04-11','leiina77410@gmail.com','$2y$10$DMjYUV76Y7GYJlC45pTOKOG8UjFw.tnEfm1WgIqlLzoiImYEKf4ra', 'balbalbal', 
        default, default, default, default, 'token', default, 1, default, 'Femme');


INSERT INTO FeediieUser VALUES
    (default, 'arjaze98e58a5ab','Leanna', 'Ji', '1999-04-11','leiina77185@gmail.com','$2y$10$DMjYUV76Y7GYJlC45pTOKOG8UjFw.tnEfm1WgIqlLzoiImYEKf4ra', 'balbalbal', 
        default, default, default, default, 'token2', default, 1, default, 'Femme');

INSERT INTO FeediieUser VALUES
    (default, 'brjaze98e58a5ab','Naruto', 'Uzumaki', '1992-01-30','naruto@gmail.com','$2y$10$DMjYUV76Y7GYJlC45pTOKOG8UjFw.tnEfm1WgIqlLzoiImYEKf4ra', 'balbalbal',
        default, default, default, default, 'token3', default, 1, default, 'Homme');

INSERT INTO FeediieUser VALUES
    (default, 'crjaze98e58a5ab','Sakura', 'Haruno', '1999-04-11','Sakura@gmail.com','$2y$10$DMjYUV76Y7GYJlC45pTOKOG8UjFw.tnEfm1WgIqlLzoiImYEKf4ra', 'balbalbal',
        default, default, default, default, 'token4', default, 1, default, 'Femme');

INSERT INTO FeediieUser VALUES
    (default, 'drjaze98e58a5ab','Sasuke', 'Uchiha', '1999-04-11','sasuke@gmail.com','$2y$10$DMjYUV76Y7GYJlC45pTOKOG8UjFw.tnEfm1WgIqlLzoiImYEKf4ra', 'balbalbal',
        default, default, default, default, 'token5', default, 1, default, 'Homme');

INSERT INTO FeediieUser VALUES
    (default, 'erjaze98e58a5ab','Itachi', 'Uchiha', '1985-04-11','itachi@gmail.com','$2y$10$DMjYUV76Y7GYJlC45pTOKOG8UjFw.tnEfm1WgIqlLzoiImYEKf4ra', 'balbalbal',
        default, default, default, default, 'token6', default, 1, default, 'Homme');

INSERT INTO LikedUser VALUES (1, 3, '2020-04-18 15:35:36', true);
INSERT INTO LikedUser VALUES (3, 1, '2020-04-18 15:35:36', true);

INSERT INTO LikedUser VALUES (1, 4, '2020-04-18 13:54:36', true);
INSERT INTO LikedUser VALUES (4, 1, '2020-04-18 13:54:36', true);

INSERT INTO LikedUser VALUES (1, 5, '2020-04-18 13:54:36', false);

INSERT INTO LikedUser VALUES (6, 1, '2020-04-18 13:54:36', false);



INSERT INTO Photo VALUES
    (default, '/Images/UserUpload/jzpeerz58aze/1.jpg', true, 1), (default, '/Images/UserUpload/jzpeerz58aze/2.jpg', default,1);

INSERT INTO Photo VALUES
    (default, '/Images/UserUpload/crjaze98e58a5ab/1.jpeg', true, 4);

INSERT INTO Dish VALUES (default, 'Pizza', '/Images/Dish/pizza.png');
INSERT INTO PersonalityDish VALUES (default, 'Sportif et en forme!', 'Sportif', '/Images/Dish/salad.png');
INSERT INTO Hobby VALUES(default, 'Musique');

INSERT INTO likeEat VALUES (1,1);
INSERT INTO looklike VALUES (1,1);
INSERT INTO practice VALUES(1,1);

