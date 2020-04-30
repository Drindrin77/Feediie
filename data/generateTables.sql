------------------------------------------------------------
--        Script Postgre 
------------------------------------------------------------



------------------------------------------------------------
-- Table: Category
------------------------------------------------------------
CREATE TABLE RelationType(
	idRelationType   SERIAL NOT NULL ,
	/*iconURL			VARCHAR (128),*/
	name          VARCHAR (128) NOT NULL  ,
	CONSTRAINT RelationType_PK PRIMARY KEY (idRelationType)
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
	uniqID						VARCHAR(128) NOT NULL UNIQUE,
	firstName                   VARCHAR (50) NOT NULL ,
	birthDay                    DATE   ,
	email						VARCHAR (128) NOT NULL UNIQUE,
	password                    VARCHAR (128) NOT NULL ,
	description                 VARCHAR (500) ,
	needPhotoOther              BOOL  NOT NULL DEFAULT FALSE,
	notificationMailActivated   BOOL  NOT NULL DEFAULT FALSE,
	distanceMax                 INT  NOT NULL DEFAULT 15,
    token                       VARCHAR (128) UNIQUE,
	isAdmin                     BOOL  NOT NULL DEFAULT FALSE,
	idCity                      INT,
    nbReport                    INT DEFAULT 0,
	sex                         VARCHAR,
	CONSTRAINT User_PK PRIMARY KEY (idUser)

	,CONSTRAINT User_City_FK FOREIGN KEY (idCity) REFERENCES City(idCity)
	,CONSTRAINT User_sex0_FK FOREIGN KEY (sex) REFERENCES sex(name)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: Photo
------------------------------------------------------------
CREATE TABLE Photo(
	idPhoto    SERIAL NOT NULL ,
	url        VARCHAR (128) NOT NULL UNIQUE,
	priority   BOOL DEFAULT FALSE,
	idUser     INT  NOT NULL  ,
	CONSTRAINT Photo_PK PRIMARY KEY (idPhoto)

	,CONSTRAINT Photo_User_FK FOREIGN KEY (idUser) REFERENCES FeediieUser(idUser)  ON DELETE CASCADE
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: like
------------------------------------------------------------
CREATE TABLE likedUser(
	idUser        INT  NOT NULL ,
	idUser_liked   INT  NOT NULL ,
	dateMatch    TIMESTAMP ,
	matched       BOOL  NOT NULL  ,
	CONSTRAINT like_PK PRIMARY KEY (idUser,idUser_liked)

	,CONSTRAINT like_User_FK FOREIGN KEY (idUser) REFERENCES FeediieUser(idUser)  ON DELETE CASCADE
	,CONSTRAINT like_User0_FK FOREIGN KEY (idUser_liked) REFERENCES FeediieUser(idUser)  ON DELETE CASCADE
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: interestedRelationType
------------------------------------------------------------
CREATE TABLE interestedRelationType(
	idUser       INT  NOT NULL ,
	idRelationType   INT  NOT NULL  ,
	CONSTRAINT interestedRelationType_PK PRIMARY KEY (idUser,idRelationType)

	,CONSTRAINT interestedCategory_User_FK FOREIGN KEY (idUser) REFERENCES FeediieUser(idUser)  ON DELETE CASCADE 
	,CONSTRAINT interestedRelationType_FK FOREIGN KEY (idRelationType) REFERENCES RelationType(idRelationType)  ON DELETE CASCADE
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: interestedsex
------------------------------------------------------------
CREATE TABLE interestedsex(
	idUser   INT  NOT NULL ,
	sex   VARCHAR(128)  NOT NULL  ,
	CONSTRAINT interestedsex_PK PRIMARY KEY (idUser,sex)

	,CONSTRAINT interestedsex_User_FK FOREIGN KEY (idUser) REFERENCES FeediieUser(idUser)  ON DELETE CASCADE
	,CONSTRAINT interestedsex_sex0_FK FOREIGN KEY (sex) REFERENCES sex(name)  ON DELETE CASCADE
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: dislike
------------------------------------------------------------
CREATE TABLE dislike(
	idUser           INT  NOT NULL ,
	idUser_dislike   INT  NOT NULL ,
	dateMatch        TIMESTAMP  NOT NULL  ,
	CONSTRAINT dislike_PK PRIMARY KEY (idUser,idUser_dislike)

	,CONSTRAINT dislike_User_FK FOREIGN KEY (idUser) REFERENCES FeediieUser(idUser)  ON DELETE CASCADE
	,CONSTRAINT dislike_User0_FK FOREIGN KEY (idUser_dislike) REFERENCES FeediieUser(idUser)  ON DELETE CASCADE
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: contact
------------------------------------------------------------
CREATE TABLE contact(
    idMessage        SERIAL NOT NULL,
	idAuthor         INT  NOT NULL ,
	idRecipient      INT  NOT NULL ,
	message          VARCHAR (512)  NOT NULL ,
	dateMessage      TIMESTAMP  NOT NULL ,
	isRead           BOOL  NOT NULL DEFAULT FALSE,
	CONSTRAINT contact_PK PRIMARY KEY (idMessage)

	,CONSTRAINT contact_User_FK FOREIGN KEY (idAuthor) REFERENCES FeediieUser(idUser)  ON DELETE CASCADE
	,CONSTRAINT contact_User0_FK FOREIGN KEY (idRecipient) REFERENCES FeediieUser(idUser)  ON DELETE CASCADE
)WITHOUT OIDS;

------------------------------------------------------------
-- Table: idea
------------------------------------------------------------
CREATE TABLE idea(
    idIdea        SERIAL NOT NULL,
	idUser         INT  NOT NULL ,
	message          VARCHAR (500)  NOT NULL ,
	CONSTRAINT idea_PK PRIMARY KEY (idIdea)

	,CONSTRAINT idea_User_FK FOREIGN KEY (idUser) REFERENCES FeediieUser(idUser)  ON DELETE CASCADE
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
	idDish        SERIAL  NOT NULL ,
	description   VARCHAR (128) ,
	name          VARCHAR (64) NOT NULL ,
	iconURL       VARCHAR (64) NOT NULL  ,
	CONSTRAINT PersonalityDish_PK PRIMARY KEY (idDish)
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
-- Table: likeEat
------------------------------------------------------------
CREATE TABLE likeEat(
	idUser   INT  NOT NULL ,
	idDish   INT  NOT NULL  ,
	CONSTRAINT likeEat_PK PRIMARY KEY (idUser,idDish)

	,CONSTRAINT likeEat__User_FK FOREIGN KEY (idUser) REFERENCES FeediieUser(idUser)  ON DELETE CASCADE
	,CONSTRAINT likeEat_Dish0_FK FOREIGN KEY (idDish) REFERENCES Dish(idDish)  ON DELETE CASCADE
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: looklike
------------------------------------------------------------
CREATE TABLE looklike(
	idUser   INT  NOT NULL ,
	idDish   INT  NOT NULL  ,
	CONSTRAINT looklike_PK PRIMARY KEY (idUser,idDish)

	,CONSTRAINT looklike__User_FK FOREIGN KEY (idUser) REFERENCES FeediieUser(idUser)  ON DELETE CASCADE
	,CONSTRAINT looklike_PersonalityDish0_FK FOREIGN KEY (idDish) REFERENCES PersonalityDish(idDish)  ON DELETE CASCADE
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: practice
------------------------------------------------------------
CREATE TABLE practice(
	idUser    INT  NOT NULL ,
	idHobby   INT  NOT NULL  ,
	CONSTRAINT practice_PK PRIMARY KEY (idUser,idHobby)

	,CONSTRAINT practice__User_FK FOREIGN KEY (idUser) REFERENCES FeediieUser(idUser)  ON DELETE CASCADE
	,CONSTRAINT practice_Hobby0_FK FOREIGN KEY (idHobby) REFERENCES Hobby(idHobby)   ON DELETE CASCADE
)WITHOUT OIDS;

------------------------------------------------------------
-- Table: diet
------------------------------------------------------------
CREATE TABLE diet(
    idDiet   SERIAL NOT NULL ,
    name     VARCHAR (128) NOT NULL,
    CONSTRAINT diet_PK PRIMARY KEY (idDiet)
)WITHOUT OIDS;
-----------------------------------------------------------
-- Table : interesteddiet
-----------------------------------------------------------
CREATE TABLE interesteddiet(
    idUser   INT  NOT NULL ,
    idDiet   INT  NOT NULL ,
    CONSTRAINT interesteddiet_PK PRIMARY KEY (idUser,idDiet)

    ,CONSTRAINT interesteddiet_User_FK FOREIGN KEY (idUser) REFERENCES FeediieUser(idUser)  ON DELETE CASCADE
    ,CONSTRAINT interesteddiet_diet0_FK FOREIGN KEY (idDiet) REFERENCES diet(idDiet)  ON DELETE CASCADE
)WITHOUT OIDS;

-----------------------------------------------------------
-- Table : rangeDistance
-----------------------------------------------------------
CREATE TABLE rangeDistance(
    idUser   INT  NOT NULL ,
    distance   INT  NOT NULL DEFAULT 50,
    CONSTRAINT rangedistance_PK PRIMARY KEY (idUser,distance)

    ,CONSTRAINT rangedistance_User_FK FOREIGN KEY (idUser) REFERENCES FeediieUser(idUser)  ON DELETE CASCADE
)WITHOUT OIDS;

-----------------------------------------------------------
-- Table : rangeAge
-----------------------------------------------------------
CREATE TABLE rangeAge(
    idUser   INT  NOT NULL ,
    ageMin   INT  NOT NULL DEFAULT 18,
    ageMax   INT  NOT NULL DEFAULT 30,
    CONSTRAINT rangeage_PK PRIMARY KEY (idUser,ageMin,ageMax)

    ,CONSTRAINT rangeage_User_FK FOREIGN KEY (idUser) REFERENCES FeediieUser(idUser)  ON DELETE CASCADE
)WITHOUT OIDS;

CREATE TABLE userDiet(
    idUser   INT  NOT NULL ,
    idDiet   INT  NOT NULL ,
    CONSTRAINT userDiet_PK PRIMARY KEY (idUser,idDiet)

    ,CONSTRAINT userDiet_User_FK FOREIGN KEY (idUser) REFERENCES FeediieUser(idUser)  ON DELETE CASCADE
    ,CONSTRAINT userDiet_diet0_FK FOREIGN KEY (idDiet) REFERENCES diet(idDiet)  ON DELETE CASCADE
)WITHOUT OIDS;
