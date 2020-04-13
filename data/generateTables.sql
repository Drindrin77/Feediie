------------------------------------------------------------
--        Script Postgre 
------------------------------------------------------------



------------------------------------------------------------
-- Table: Category
------------------------------------------------------------
CREATE TABLE Category(
	idCategory   SERIAL NOT NULL ,
	nom          VARCHAR (128) NOT NULL  ,
	CONSTRAINT Category_PK PRIMARY KEY (idCategory)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: City
------------------------------------------------------------
CREATE TABLE City(
	idCity   SERIAL NOT NULL ,
	name     VARCHAR (128) NOT NULL  ,
    zipCode  VARCHAR (24) NOT NULL,
	CONSTRAINT City_PK PRIMARY KEY (idCity)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: sex
------------------------------------------------------------
CREATE TABLE sex(
	name     VARCHAR (128) NOT NULL UNIQUE,
	CONSTRAINT sex_PK PRIMARY KEY (name)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: FeediieUser
------------------------------------------------------------
CREATE TABLE FeediieUser(
	idUser                      SERIAL NOT NULL ,
	firstName                   VARCHAR (50) NOT NULL ,
	lastName                    VARCHAR (50) NOT NULL ,
	birthDay                    DATE   ,
	email						VARCHAR (128) NOT NULL UNIQUE,
	password                    VARCHAR (128) NOT NULL ,
	description                 VARCHAR (500) ,
	needPhotoOther              BOOL  NOT NULL DEFAULT FALSE,
	notificationMailActivated   BOOL  NOT NULL DEFAULT FALSE,
	distanceMaxActivated        BOOL  NOT NULL DEFAULT TRUE,
	distanceMax                 INT  NOT NULL DEFAULT 15,
    token                       VARCHAR (128),
	isAdmin                     BOOL  NOT NULL DEFAULT FALSE,
	idCity                      INT   NOT NULL,
    nbReport                    INT DEFAULT 0,
	sex                         VARCHAR  NOT NULL,
	CONSTRAINT User_PK PRIMARY KEY (idUser)

	,CONSTRAINT User_City_FK FOREIGN KEY (idCity) REFERENCES City(idCity)
	,CONSTRAINT User_sex0_FK FOREIGN KEY (sex) REFERENCES sex(name)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: Photo
------------------------------------------------------------
CREATE TABLE Photo(
	idPhoto    SERIAL NOT NULL ,
	url        VARCHAR (128) NOT NULL ,
	priority   INT2  NOT NULL ,
	idUser     INT  NOT NULL  ,
	CONSTRAINT Photo_PK PRIMARY KEY (idPhoto)

	,CONSTRAINT Photo_User_FK FOREIGN KEY (idUser) REFERENCES FeediieUser(idUser)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: like
------------------------------------------------------------
CREATE TABLE likedUser(
	idUser        INT  NOT NULL ,
	idUser_like   INT  NOT NULL ,
	dateMatch     DATE  NOT NULL ,
	matched       BOOL  NOT NULL  ,
	CONSTRAINT like_PK PRIMARY KEY (idUser,idUser_like)

	,CONSTRAINT like_User_FK FOREIGN KEY (idUser) REFERENCES FeediieUser(idUser)
	,CONSTRAINT like_User0_FK FOREIGN KEY (idUser_like) REFERENCES FeediieUser(idUser)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: interestedCategory
------------------------------------------------------------
CREATE TABLE interestedCategory(
	idUser       INT  NOT NULL ,
	idCategory   INT  NOT NULL  ,
	CONSTRAINT interestedCategory_PK PRIMARY KEY (idUser,idCategory)

	,CONSTRAINT interestedCategory_User_FK FOREIGN KEY (idUser) REFERENCES FeediieUser(idUser)
	,CONSTRAINT interestedCategory_Category0_FK FOREIGN KEY (idCategory) REFERENCES Category(idCategory)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: interestedsex
------------------------------------------------------------
CREATE TABLE interestedsex(
	idUser   INT  NOT NULL ,
	sex   VARCHAR(24)  NOT NULL  ,
	CONSTRAINT interestedsex_PK PRIMARY KEY (idUser,sex)

	,CONSTRAINT interestedsex_User_FK FOREIGN KEY (idUser) REFERENCES FeediieUser(idUser)
	,CONSTRAINT interestedsex_sex0_FK FOREIGN KEY (sex) REFERENCES sex(name)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: dislike
------------------------------------------------------------
CREATE TABLE dislike(
	idUser           INT  NOT NULL ,
	idUser_dislike   INT  NOT NULL ,
	dateMatch        DATE  NOT NULL  ,
	CONSTRAINT dislike_PK PRIMARY KEY (idUser,idUser_dislike)

	,CONSTRAINT dislike_User_FK FOREIGN KEY (idUser) REFERENCES FeediieUser(idUser)
	,CONSTRAINT dislike_User0_FK FOREIGN KEY (idUser_dislike) REFERENCES FeediieUser(idUser)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: contact
------------------------------------------------------------
CREATE TABLE contact(
	idUser           INT  NOT NULL ,
	idUser_contact   INT  NOT NULL ,
	message          VARCHAR (500)  NOT NULL ,
	dateMessage      DATE  NOT NULL ,
	isRead           BOOL  NOT NULL  ,
	CONSTRAINT contact_PK PRIMARY KEY (idUser,idUser_contact)

	,CONSTRAINT contact_User_FK FOREIGN KEY (idUser) REFERENCES FeediieUser(idUser)
	,CONSTRAINT contact_User0_FK FOREIGN KEY (idUser_contact) REFERENCES FeediieUser(idUser)
)WITHOUT OIDS;

------------------------------------------------------------
-- Table: TypeRestaurant
------------------------------------------------------------
CREATE TABLE TypeRestaurant(
	idRestaurant   SERIAL NOT NULL ,
	name           VARCHAR (500) NOT NULL  ,
	CONSTRAINT TypeRestaurant_PK PRIMARY KEY (idRestaurant)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: Dish
------------------------------------------------------------
CREATE TABLE Dish(
	idDish    SERIAL NOT NULL ,
	name      VARCHAR (64) NOT NULL ,
	iconURL   VARCHAR (64) NOT NULL  ,
	CONSTRAINT Dish_PK PRIMARY KEY (idDish)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: PersonalityDish
------------------------------------------------------------
CREATE TABLE PersonalityDish(
	idDish        INT  NOT NULL ,
	description   VARCHAR (128) NOT NULL ,
	name          VARCHAR (64) NOT NULL ,
	iconURL       VARCHAR (64) NOT NULL  ,
	CONSTRAINT PersonalityDish_PK PRIMARY KEY (idDish)

	,CONSTRAINT PersonalityDish_Dish_FK FOREIGN KEY (idDish) REFERENCES Dish(idDish)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: Hobby
------------------------------------------------------------
CREATE TABLE Hobby(
	idHobby   SERIAL NOT NULL ,
	name      VARCHAR (128) NOT NULL  ,
	CONSTRAINT Hobby_PK PRIMARY KEY (idHobby)
)WITHOUT OIDS;

------------------------------------------------------------
-- Table: firstDate
------------------------------------------------------------
CREATE TABLE firstDate(
	idUser         INT  NOT NULL ,
	idRestaurant   INT  NOT NULL  ,
	CONSTRAINT firstDate_PK PRIMARY KEY (idUser,idRestaurant)

	,CONSTRAINT firstDate__User_FK FOREIGN KEY (idUser) REFERENCES FeediieUser(idUser)
	,CONSTRAINT firstDate_TypeRestaurant0_FK FOREIGN KEY (idRestaurant) REFERENCES TypeRestaurant(idRestaurant)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: likeEat
------------------------------------------------------------
CREATE TABLE likeEat(
	idUser   INT  NOT NULL ,
	idDish   INT  NOT NULL  ,
	CONSTRAINT likeEat_PK PRIMARY KEY (idUser,idDish)

	,CONSTRAINT likeEat__User_FK FOREIGN KEY (idUser) REFERENCES FeediieUser(idUser)
	,CONSTRAINT likeEat_Dish0_FK FOREIGN KEY (idDish) REFERENCES Dish(idDish)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: looklike
------------------------------------------------------------
CREATE TABLE looklike(
	idUser   INT  NOT NULL ,
	idDish   INT  NOT NULL  ,
	CONSTRAINT looklike_PK PRIMARY KEY (idUser,idDish)

	,CONSTRAINT looklike__User_FK FOREIGN KEY (idUser) REFERENCES FeediieUser(idUser)
	,CONSTRAINT looklike_PersonalityDish0_FK FOREIGN KEY (idDish) REFERENCES PersonalityDish(idDish)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: practice
------------------------------------------------------------
CREATE TABLE practice(
	idUser    INT  NOT NULL ,
	idHobby   INT  NOT NULL  ,
	CONSTRAINT practice_PK PRIMARY KEY (idUser,idHobby)

	,CONSTRAINT practice__User_FK FOREIGN KEY (idUser) REFERENCES FeediieUser(idUser)
	,CONSTRAINT practice_Hobby0_FK FOREIGN KEY (idHobby) REFERENCES Hobby(idHobby)
)WITHOUT OIDS;



