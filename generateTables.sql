#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: Category
#------------------------------------------------------------

CREATE TABLE Category(
        idCategory Int  Auto_increment  NOT NULL ,
        nom        Varchar (128) NOT NULL
	,CONSTRAINT Category_PK PRIMARY KEY (idCategory)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: City
#------------------------------------------------------------

CREATE TABLE City(
        idCity Int  Auto_increment  NOT NULL ,
        name   Varchar (128) NOT NULL
	,CONSTRAINT City_PK PRIMARY KEY (idCity)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Sexe
#------------------------------------------------------------

CREATE TABLE Sexe(
        idSexe Int  Auto_increment  NOT NULL ,
        name   Varchar (128) NOT NULL
	,CONSTRAINT Sexe_PK PRIMARY KEY (idSexe)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: User
#------------------------------------------------------------

CREATE TABLE User(
        idUser                    Int  Auto_increment  NOT NULL ,
        firstName                 Varchar (50) NOT NULL ,
        lastName                  Varchar (50) NOT NULL ,
        birthDay                  Date ,
        password                  Varchar (128) NOT NULL ,
        description               Text NOT NULL ,
        needPhotoOther            Bool NOT NULL ,
        notificationMailActivated Bool NOT NULL ,
        distanceMaxActivated      Bool NOT NULL ,
        distanceMax               Int NOT NULL ,
        isAdmin                   Bool NOT NULL ,
        idCity                    Int ,
        idSexe                    Int NOT NULL
	,CONSTRAINT User_PK PRIMARY KEY (idUser)

	,CONSTRAINT User_City_FK FOREIGN KEY (idCity) REFERENCES City(idCity)
	,CONSTRAINT User_Sexe0_FK FOREIGN KEY (idSexe) REFERENCES Sexe(idSexe)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Photo
#------------------------------------------------------------

CREATE TABLE Photo(
        idPhoto Int  Auto_increment  NOT NULL ,
        photoUrl     Varchar (128) NOT NULL ,
        order   Smallint NOT NULL ,
        idUser  Int NOT NULL
	,CONSTRAINT Photo_PK PRIMARY KEY (idPhoto)

	,CONSTRAINT Photo_User_FK FOREIGN KEY (idUser) REFERENCES User(idUser)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: like
#------------------------------------------------------------

CREATE TABLE like(
        idUser      Int NOT NULL ,
        idUser_like Int NOT NULL ,
        dateMatch   Date NOT NULL ,
        matched     Bool NOT NULL
	,CONSTRAINT like_PK PRIMARY KEY (idUser,idUser_like)

	,CONSTRAINT like_User_FK FOREIGN KEY (idUser) REFERENCES User(idUser)
	,CONSTRAINT like_User0_FK FOREIGN KEY (idUser_like) REFERENCES User(idUser)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: interestedCategory
#------------------------------------------------------------

CREATE TABLE interestedCategory(
        idUser     Int NOT NULL ,
        idCategory Int NOT NULL
	,CONSTRAINT interestedCategory_PK PRIMARY KEY (idUser,idCategory)

	,CONSTRAINT interestedCategory_User_FK FOREIGN KEY (idUser) REFERENCES User(idUser)
	,CONSTRAINT interestedCategory_Category0_FK FOREIGN KEY (idCategory) REFERENCES Category(idCategory)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: interestedSexe
#------------------------------------------------------------

CREATE TABLE interestedSexe(
        idUser Int NOT NULL ,
        idSexe Int NOT NULL
	,CONSTRAINT interestedSexe_PK PRIMARY KEY (idUser,idSexe)

	,CONSTRAINT interestedSexe_User_FK FOREIGN KEY (idUser) REFERENCES User(idUser)
	,CONSTRAINT interestedSexe_Sexe0_FK FOREIGN KEY (idSexe) REFERENCES Sexe(idSexe)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: dislike
#------------------------------------------------------------

CREATE TABLE dislike(
        idUser         Int NOT NULL ,
        idUser_dislike Int NOT NULL ,
        dateDislike      Date NOT NULL
	,CONSTRAINT dislike_PK PRIMARY KEY (idUser,idUser_dislike)

	,CONSTRAINT dislike_User_FK FOREIGN KEY (idUser) REFERENCES User(idUser)
	,CONSTRAINT dislike_User0_FK FOREIGN KEY (idUser_dislike) REFERENCES User(idUser)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: contact
#------------------------------------------------------------

CREATE TABLE contact(
        idUser         Int NOT NULL ,
        idUser_contact Int NOT NULL ,
        message        Text NOT NULL ,
        dateMessage    Date NOT NULL ,
        isRead         Bool NOT NULL
	,CONSTRAINT contact_PK PRIMARY KEY (idUser,idUser_contact)

	,CONSTRAINT contact_User_FK FOREIGN KEY (idUser) REFERENCES User(idUser)
	,CONSTRAINT contact_User0_FK FOREIGN KEY (idUser_contact) REFERENCES User(idUser)
)ENGINE=InnoDB;

#------------------------------------------------------------
# Table: TypeRestaurant
#------------------------------------------------------------

CREATE TABLE TypeRestaurant(
        idRestaurant Int  Auto_increment  NOT NULL ,
        name         Varchar (500) NOT NULL UNIQUE 
	,CONSTRAINT TypeRestaurant_PK PRIMARY KEY (idRestaurant)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Dish
#------------------------------------------------------------

CREATE TABLE Dish(
        idDish Int  Auto_increment  NOT NULL ,
        name   Varchar (64) NOT NULL UNIQUE,
        iconURL   Varchar (64) NOT NULL
	,CONSTRAINT Dish_PK PRIMARY KEY (idDish)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: PersonalityDish
#------------------------------------------------------------

CREATE TABLE PersonalityDish(
        idDish      Int NOT NULL ,
        description Varchar (128) NOT NULL ,
        name        Varchar (64) NOT NULL UNIQUE,
        iconURL        Varchar (5) NOT NULL
	,CONSTRAINT PersonalityDish_PK PRIMARY KEY (idDish)

	,CONSTRAINT PersonalityDish_Dish_FK FOREIGN KEY (idDish) REFERENCES Dish(idDish)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Hobby
#------------------------------------------------------------

CREATE TABLE Hobby(
        idHobby Int  Auto_increment  NOT NULL ,
        name    Varchar (128) NOT NULL UNIQUE
	,CONSTRAINT Hobby_PK PRIMARY KEY (idHobby)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: firstDate
#------------------------------------------------------------

CREATE TABLE firstDate(
        idRestaurant Int NOT NULL ,
        idUser       Int NOT NULL
	,CONSTRAINT firstDate_PK PRIMARY KEY (idRestaurant,idUser)

	,CONSTRAINT firstDate_TypeRestaurant_FK FOREIGN KEY (idRestaurant) REFERENCES TypeRestaurant(idRestaurant)
	,CONSTRAINT firstDate_User0_FK FOREIGN KEY (idUser) REFERENCES User(idUser)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: likeEat
#------------------------------------------------------------

CREATE TABLE likeEat(
        idDish Int NOT NULL ,
        idUser Int NOT NULL
	,CONSTRAINT likeEat_PK PRIMARY KEY (idDish,idUser)

	,CONSTRAINT likeEat_Dish_FK FOREIGN KEY (idDish) REFERENCES Dish(idDish)
	,CONSTRAINT likeEat_User0_FK FOREIGN KEY (idUser) REFERENCES User(idUser)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: looklike
#------------------------------------------------------------

CREATE TABLE looklike(
        idDish Int NOT NULL ,
        idUser Int NOT NULL
	,CONSTRAINT looklike_PK PRIMARY KEY (idDish,idUser)

	,CONSTRAINT looklike_PersonalityDish_FK FOREIGN KEY (idDish) REFERENCES PersonalityDish(idDish)
	,CONSTRAINT looklike_User0_FK FOREIGN KEY (idUser) REFERENCES User(idUser)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: practice
#------------------------------------------------------------

CREATE TABLE practice(
        idHobby Int NOT NULL ,
        idUser  Int NOT NULL
	,CONSTRAINT practice_PK PRIMARY KEY (idHobby,idUser)

	,CONSTRAINT practice_Hobby_FK FOREIGN KEY (idHobby) REFERENCES Hobby(idHobby)
	,CONSTRAINT practice_User0_FK FOREIGN KEY (idUser) REFERENCES User(idUser)
)ENGINE=InnoDB;

