#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: User
#------------------------------------------------------------

CREATE TABLE User(
        id_user   Int  Auto_increment  NOT NULL ,
        firstname Char (100) NOT NULL ,
        lastname  Char (100) NOT NULL ,
        email     Char (200) NOT NULL ,
        pseudo    Char (100) NOT NULL ,
        password  Char (100) NOT NULL ,
        role      Bool NOT NULL
	,CONSTRAINT User_PK PRIMARY KEY (id_user)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Article
#------------------------------------------------------------

CREATE TABLE Article(
        id_article        Int  Auto_increment  NOT NULL ,
        title             Char (100) NOT NULL ,
        chapo             Char (150) NOT NULL ,
        content           Text NOT NULL ,
        date_publication  Date NOT NULL ,
        date_modification Date NOT NULL ,
        image             Char (255) NOT NULL ,
        delete_article    Bool ,
        alt               Char (5) NOT NULL ,
        id_user           Int NOT NULL
	,CONSTRAINT Article_PK PRIMARY KEY (id_article)

	,CONSTRAINT Article_User_FK FOREIGN KEY (id_user) REFERENCES User(id_user)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Comment
#------------------------------------------------------------

CREATE TABLE Comment(
        id_comment        Int  Auto_increment  NOT NULL ,
        content           Text NOT NULL ,
        date_publication  Date NOT NULL ,
        date_modification Date NOT NULL ,
        statut            Bool ,
        delete_comment    Bool NOT NULL ,
        id_article        Int NOT NULL ,
        id_user           Int NOT NULL
	,CONSTRAINT Comment_PK PRIMARY KEY (id_comment)

	,CONSTRAINT Comment_Article_FK FOREIGN KEY (id_article) REFERENCES Article(id_article)
	,CONSTRAINT Comment_User0_FK FOREIGN KEY (id_user) REFERENCES User(id_user)
)ENGINE=InnoDB;

