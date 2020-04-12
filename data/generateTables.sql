------------------------------------------------------------
--        Script Postgre 
------------------------------------------------------------



------------------------------------------------------------
-- Table: Category
------------------------------------------------------------
CREATE TABLE public.Category(
	idCategory   SERIAL NOT NULL ,
	nom          VARCHAR (128) NOT NULL  ,
	CONSTRAINT Category_PK PRIMARY KEY (idCategory)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: City
------------------------------------------------------------
CREATE TABLE public.City(
	idCity   SERIAL NOT NULL ,
	name     VARCHAR (128) NOT NULL  ,
	CONSTRAINT City_PK PRIMARY KEY (idCity)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: Sexe
------------------------------------------------------------
CREATE TABLE public.Sexe(
	idSexe   SERIAL NOT NULL ,
	name     VARCHAR (128) NOT NULL  ,
	CONSTRAINT Sexe_PK PRIMARY KEY (idSexe)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: User
------------------------------------------------------------
CREATE TABLE public.User(
	idUser                      SERIAL NOT NULL ,
	firstName                   VARCHAR (50) NOT NULL ,
	lastName                    VARCHAR (50) NOT NULL ,
	birthDay                    DATE   ,
	password                    VARCHAR (128) NOT NULL ,
	description                 VARCHAR (2000)  NOT NULL ,
	needPhotoOther              BOOL  NOT NULL ,
	notificationMailActivated   BOOL  NOT NULL ,
	distanceMaxActivated        BOOL  NOT NULL ,
	distanceMax                 INT  NOT NULL ,
	isAdmin                     BOOL  NOT NULL ,
	idCity                      INT   ,
	idSexe                      INT  NOT NULL  ,
	CONSTRAINT User_PK PRIMARY KEY (idUser)

	,CONSTRAINT User_City_FK FOREIGN KEY (idCity) REFERENCES public.City(idCity)
	,CONSTRAINT User_Sexe0_FK FOREIGN KEY (idSexe) REFERENCES public.Sexe(idSexe)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: Photo
------------------------------------------------------------
CREATE TABLE public.Photo(
	idPhoto    SERIAL NOT NULL ,
	url        VARCHAR (128) NOT NULL ,
	priority   INT2  NOT NULL ,
	idUser     INT  NOT NULL  ,
	CONSTRAINT Photo_PK PRIMARY KEY (idPhoto)

	,CONSTRAINT Photo_User_FK FOREIGN KEY (idUser) REFERENCES public.User(idUser)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: like
------------------------------------------------------------
CREATE TABLE public.like(
	idUser        INT  NOT NULL ,
	idUser_like   INT  NOT NULL ,
	dateMatch     DATE  NOT NULL ,
	matched       BOOL  NOT NULL  ,
	CONSTRAINT like_PK PRIMARY KEY (idUser,idUser_like)

	,CONSTRAINT like_User_FK FOREIGN KEY (idUser) REFERENCES public.User(idUser)
	,CONSTRAINT like_User0_FK FOREIGN KEY (idUser_like) REFERENCES public.User(idUser)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: interestedCategory
------------------------------------------------------------
CREATE TABLE public.interestedCategory(
	idUser       INT  NOT NULL ,
	idCategory   INT  NOT NULL  ,
	CONSTRAINT interestedCategory_PK PRIMARY KEY (idUser,idCategory)

	,CONSTRAINT interestedCategory_User_FK FOREIGN KEY (idUser) REFERENCES public.User(idUser)
	,CONSTRAINT interestedCategory_Category0_FK FOREIGN KEY (idCategory) REFERENCES public.Category(idCategory)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: interestedSexe
------------------------------------------------------------
CREATE TABLE public.interestedSexe(
	idUser   INT  NOT NULL ,
	idSexe   INT  NOT NULL  ,
	CONSTRAINT interestedSexe_PK PRIMARY KEY (idUser,idSexe)

	,CONSTRAINT interestedSexe_User_FK FOREIGN KEY (idUser) REFERENCES public.User(idUser)
	,CONSTRAINT interestedSexe_Sexe0_FK FOREIGN KEY (idSexe) REFERENCES public.Sexe(idSexe)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: dislike
------------------------------------------------------------
CREATE TABLE public.dislike(
	idUser           INT  NOT NULL ,
	idUser_dislike   INT  NOT NULL ,
	dateMatch        DATE  NOT NULL  ,
	CONSTRAINT dislike_PK PRIMARY KEY (idUser,idUser_dislike)

	,CONSTRAINT dislike_User_FK FOREIGN KEY (idUser) REFERENCES public.User(idUser)
	,CONSTRAINT dislike_User0_FK FOREIGN KEY (idUser_dislike) REFERENCES public.User(idUser)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: contact
------------------------------------------------------------
CREATE TABLE public.contact(
	idUser           INT  NOT NULL ,
	idUser_contact   INT  NOT NULL ,
	message          VARCHAR (2000)  NOT NULL ,
	dateMessage      DATE  NOT NULL ,
	isRead           BOOL  NOT NULL  ,
	CONSTRAINT contact_PK PRIMARY KEY (idUser,idUser_contact)

	,CONSTRAINT contact_User_FK FOREIGN KEY (idUser) REFERENCES public.User(idUser)
	,CONSTRAINT contact_User0_FK FOREIGN KEY (idUser_contact) REFERENCES public.User(idUser)
)WITHOUT OIDS;

------------------------------------------------------------
-- Table: TypeRestaurant
------------------------------------------------------------
CREATE TABLE public.TypeRestaurant(
	idRestaurant   SERIAL NOT NULL ,
	name           VARCHAR (500) NOT NULL  ,
	CONSTRAINT TypeRestaurant_PK PRIMARY KEY (idRestaurant)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: Dish
------------------------------------------------------------
CREATE TABLE public.Dish(
	idDish    SERIAL NOT NULL ,
	name      VARCHAR (64) NOT NULL ,
	iconURL   VARCHAR (64) NOT NULL  ,
	CONSTRAINT Dish_PK PRIMARY KEY (idDish)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: PersonalityDish
------------------------------------------------------------
CREATE TABLE public.PersonalityDish(
	idDish        INT  NOT NULL ,
	description   VARCHAR (128) NOT NULL ,
	name          VARCHAR (64) NOT NULL ,
	iconURL       VARCHAR (64) NOT NULL  ,
	CONSTRAINT PersonalityDish_PK PRIMARY KEY (idDish)

	,CONSTRAINT PersonalityDish_Dish_FK FOREIGN KEY (idDish) REFERENCES public.Dish(idDish)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: Hobby
------------------------------------------------------------
CREATE TABLE public.Hobby(
	idHobby   SERIAL NOT NULL ,
	name      VARCHAR (128) NOT NULL  ,
	CONSTRAINT Hobby_PK PRIMARY KEY (idHobby)
)WITHOUT OIDS;

------------------------------------------------------------
-- Table: firstDate
------------------------------------------------------------
CREATE TABLE public.firstDate(
	idUser         INT  NOT NULL ,
	idRestaurant   INT  NOT NULL  ,
	CONSTRAINT firstDate_PK PRIMARY KEY (idUser,idRestaurant)

	,CONSTRAINT firstDate__User_FK FOREIGN KEY (idUser) REFERENCES public.User(idUser)
	,CONSTRAINT firstDate_TypeRestaurant0_FK FOREIGN KEY (idRestaurant) REFERENCES public.TypeRestaurant(idRestaurant)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: likeEat
------------------------------------------------------------
CREATE TABLE public.likeEat(
	idUser   INT  NOT NULL ,
	idDish   INT  NOT NULL  ,
	CONSTRAINT likeEat_PK PRIMARY KEY (idUser,idDish)

	,CONSTRAINT likeEat__User_FK FOREIGN KEY (idUser) REFERENCES public.User(idUser)
	,CONSTRAINT likeEat_Dish0_FK FOREIGN KEY (idDish) REFERENCES public.Dish(idDish)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: looklike
------------------------------------------------------------
CREATE TABLE public.looklike(
	idUser   INT  NOT NULL ,
	idDish   INT  NOT NULL  ,
	CONSTRAINT looklike_PK PRIMARY KEY (idUser,idDish)

	,CONSTRAINT looklike__User_FK FOREIGN KEY (idUser) REFERENCES public.User(idUser)
	,CONSTRAINT looklike_PersonalityDish0_FK FOREIGN KEY (idDish) REFERENCES public.PersonalityDish(idDish)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: practice
------------------------------------------------------------
CREATE TABLE public.practice(
	idUser    INT  NOT NULL ,
	idHobby   INT  NOT NULL  ,
	CONSTRAINT practice_PK PRIMARY KEY (idUser,idHobby)

	,CONSTRAINT practice__User_FK FOREIGN KEY (idUser) REFERENCES public.User(idUser)
	,CONSTRAINT practice_Hobby0_FK FOREIGN KEY (idHobby) REFERENCES public.Hobby(idHobby)
)WITHOUT OIDS;



