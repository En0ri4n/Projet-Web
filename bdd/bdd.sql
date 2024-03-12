CREATE TABLE Utilisateur(
                            IdUtilisateur VARCHAR(64),
                            MotDePasse VARCHAR(256) NOT NULL,
                            Nom VARCHAR(64),
                            Prenom VARCHAR(64),
                            MailUtilisateur VARCHAR(64) NOT NULL,
                            TelephoneUtilisateur VARCHAR(20),
                            PRIMARY KEY(IdUtilisateur)
);

CREATE TABLE Entreprise(
                           IdEntreprise INT AUTO_INCREMENT,
                           NomEntreprise VARCHAR(64) NOT NULL,
                           Site VARCHAR(64),
                           DescriptionEntreprise VARCHAR(512) NOT NULL,
                           MailEntreprise VARCHAR(64),
                           TelephoneEntreprise VARCHAR(20),
                           Statut VARCHAR(16),
                           PRIMARY KEY(IdEntreprise)
);

CREATE TABLE Adresse(
                        IdAdresse INT AUTO_INCREMENT,
                        Rue VARCHAR(92) NOT NULL,
                        Ville VARCHAR(64) NOT NULL,
                        CodePostal VARCHAR(16),
                        PRIMARY KEY(IdAdresse),

);

CREATE TABLE Evaluation(
                           IdEvaluation INT,
                           Note INT,
                           Commentaire VARCHAR(512),
                           IdUtilisateur VARCHAR(64) NOT NULL,
                           IdEntreprise INT NOT NULL,
                           PRIMARY KEY(IdEvaluation),
                           FOREIGN KEY(IdUtilisateur) REFERENCES Utilisateur(IdUtilisateur),
                           FOREIGN KEY(IdEntreprise) REFERENCES Entreprise(IdEntreprise)
);

CREATE TABLE Offre(
                      IdOffre INT,
                      DateOffre DATE NOT NULL,
                      DureeOffre INT NOT NULL,
                      TypeDureeOffre VARCHAR(32) NOT NULL,
                      Remuneration CURRENCY NOT NULL,
                      NbPlace INT NOT NULL,
                      NomOffre VARCHAR(64) NOT NULL,
                      NiveauOffre BYTE,
                      DescriptionOffre VARCHAR(512) NOT NULL,
                      IdAdresse INT NOT NULL,
                      IdEntreprise INT NOT NULL,
                      PRIMARY KEY(IdOffre),
                      FOREIGN KEY(IdAdresse) REFERENCES Adresse(IdAdresse),
                      FOREIGN KEY(IdEntreprise) REFERENCES Entreprise(IdEntreprise)
);

CREATE TABLE Competence(
                           IdCompetence INT,
                           NomCompetence VARCHAR(64) NOT NULL,
                           PRIMARY KEY(IdCompetence)
);

CREATE TABLE Secteur(
                        IdSecteur INT,
                        NomSecteur VARCHAR(64) NOT NULL,
                        PRIMARY KEY(IdSecteur)
);

CREATE TABLE Etudiant(
                         IdUtilisateur VARCHAR(64),
                         IdAdresse INT NOT NULL,
                         PRIMARY KEY(IdUtilisateur),
                         FOREIGN KEY(IdUtilisateur) REFERENCES Utilisateur(IdUtilisateur),
                         FOREIGN KEY(IdAdresse) REFERENCES Adresse(IdAdresse)
);

CREATE TABLE Pilote(
                       IdUtilisateur VARCHAR(64),
                       PRIMARY KEY(IdUtilisateur),
                       FOREIGN KEY(IdUtilisateur) REFERENCES Utilisateur(IdUtilisateur)
);

CREATE TABLE Administrateur(
                               IdUtilisateur VARCHAR(64),
                               PRIMARY KEY(IdUtilisateur),
                               FOREIGN KEY(IdUtilisateur) REFERENCES Utilisateur(IdUtilisateur)
);

CREATE TABLE Promotion(
                          IdPromotion INT,
                          NomPromotion VARCHAR(64),
                          TypePromotion VARCHAR(64) NOT NULL,
                          DatePromotion DATE NOT NULL,
                          NiveauPromotion BYTE NOT NULL,
                          DuréePromotion INT NOT NULL,
                          TypeDureePromotion VARCHAR(32) NOT NULL,
                          Centre VARCHAR(64),
                          IdUtilisateur VARCHAR(64) NOT NULL,
                          IdUtilisateur_1 VARCHAR(64) NOT NULL,
                          PRIMARY KEY(IdPromotion),
                          FOREIGN KEY(IdUtilisateur) REFERENCES Administrateur(IdUtilisateur),
                          FOREIGN KEY(IdUtilisateur_1) REFERENCES Pilote(IdUtilisateur)
);

CREATE TABLE Candidature(
                            IdCandidature INT,
                            CV VARCHAR(64),
                            LettreMotivation VARCHAR(50),
                            IdUtilisateur VARCHAR(64) NOT NULL,
                            IdUtilisateur_1 VARCHAR(64) NOT NULL,
                            IdOffre INT NOT NULL,
                            PRIMARY KEY(IdCandidature),
                            FOREIGN KEY(IdUtilisateur) REFERENCES Etudiant(IdUtilisateur),
                            FOREIGN KEY(IdUtilisateur_1) REFERENCES Administrateur(IdUtilisateur),
                            FOREIGN KEY(IdOffre) REFERENCES Offre(IdOffre)
);

CREATE TABLE Appartenir(
                           IdPromotion INT,
                           IdUtilisateur VARCHAR(64),
                           PRIMARY KEY(IdPromotion, IdUtilisateur),
                           FOREIGN KEY(IdPromotion) REFERENCES Promotion(IdPromotion),
                           FOREIGN KEY(IdUtilisateur) REFERENCES Etudiant(IdUtilisateur)
);

CREATE TABLE Localiser(
                          IdEntreprise INT,
                          IdAdresse INT,
                          PRIMARY KEY(IdEntreprise, IdAdresse),
                          FOREIGN KEY(IdEntreprise) REFERENCES Entreprise(IdEntreprise),
                          FOREIGN KEY(IdAdresse) REFERENCES Adresse(IdAdresse)
);

CREATE TABLE Demander(
                         IdOffre INT,
                         IdCompetence INT,
                         PRIMARY KEY(IdOffre, IdCompetence),
                         FOREIGN KEY(IdOffre) REFERENCES Offre(IdOffre),
                         FOREIGN KEY(IdCompetence) REFERENCES Competence(IdCompetence)
);

CREATE TABLE Wishlist(
                         IdOffre INT,
                         IdUtilisateur VARCHAR(64),
                         PRIMARY KEY(IdOffre, IdUtilisateur),
                         FOREIGN KEY(IdOffre) REFERENCES Offre(IdOffre),
                         FOREIGN KEY(IdUtilisateur) REFERENCES Etudiant(IdUtilisateur)
);

CREATE TABLE Composer(
                         IdEntreprise INT,
                         IdSecteur INT,
                         PRIMARY KEY(IdEntreprise, IdSecteur),
                         FOREIGN KEY(IdEntreprise) REFERENCES Entreprise(IdEntreprise),
                         FOREIGN KEY(IdSecteur) REFERENCES Secteur(IdSecteur)
);

CREATE TABLE Wishlist1(
                          IdOffre INT,
                          IdUtilisateur VARCHAR(64),
                          PRIMARY KEY(IdOffre, IdUtilisateur),
                          FOREIGN KEY(IdOffre) REFERENCES Offre(IdOffre),
                          FOREIGN KEY(IdUtilisateur) REFERENCES Administrateur(IdUtilisateur)
);

CREATE TABLE Appartenir1(
                            IdPromotion INT,
                            IdUtilisateur VARCHAR(64),
                            PRIMARY KEY(IdPromotion, IdUtilisateur),
                            FOREIGN KEY(IdPromotion) REFERENCES Promotion(IdPromotion),
                            FOREIGN KEY(IdUtilisateur) REFERENCES Administrateur(IdUtilisateur)
);


INSERT INTO Adresse (Rue, Ville, CodePostal)
SELECT
    CONCAT(FLOOR(RAND() * 10000) + 1, ' ',
           (CASE WHEN RAND() > 0.5 THEN 'Main Street' ELSE 'Oak Avenue' END)) AS Rue,
    (CASE WHEN RAND() > 0.5 THEN 'New York' ELSE 'Los Angeles' END) AS Ville,
    CONCAT(FLOOR(RAND() * 90000) + 10000) AS CodePostal
FROM
    information_schema.tables
        LIMIT 200;

INSERT INTO Utilisateur (IdUtilisateur, MotDePasse, Nom, Prenom, MailUtilisateur, TelephoneUtilisateur)
SELECT
    CONCAT('user', LPAD(ROW_NUMBER() OVER (), 3, '0')) AS IdUtilisateur,
    SHA2(CONCAT('password', LPAD(ROW_NUMBER() OVER (), 3, '0')), 256) AS MotDePasse,
    CONCAT('Nom', LPAD(ROW_NUMBER() OVER (), 3, '0')) AS Nom,
    CONCAT('Prenom', LPAD(ROW_NUMBER() OVER (), 3, '0')) AS Prenom,
    CONCAT('user', LPAD(ROW_NUMBER() OVER (), 3, '0'), '@example.com') AS MailUtilisateur,
    CONCAT('555', LPAD(ROW_NUMBER() OVER (), 7, '0')) AS TelephoneUtilisateur
FROM
    information_schema.tables
        LIMIT 100;

INSERT INTO Etudiant (IdUtilisateur, IdAdresse)
SELECT
    CONCAT('user', LPAD(ROW_NUMBER() OVER (), 3, '0')) AS IdUtilisateur,
    FLOOR(RAND() * 99) + 1 AS IdAdresse
FROM
    information_schema.tables
        LIMIT 80;

INSERT INTO Pilote (IdUtilisateur)
SELECT
    CONCAT('user', LPAD(ROW_NUMBER() OVER (), 3, '0')) AS IdUtilisateur
FROM
    information_schema.tables
        LIMIT 19 OFFSET 80;

INSERT INTO Utilisateur (IdUtilisateur, MotDePasse, Nom, Prenom, MailUtilisateur, TelephoneUtilisateur)
VALUES
    ('admin01',SHA2('admin', 256),'LEY','Louise','louise.ley@viacesi.fr','0611111111'),
    ('admin02',SHA2('admin', 256),'HOOG','Cédric','cedric.hoog@viacesi.fr','0622222222'),
    ('admin03',SHA2('admin', 256),'RAJOELISOA','Enorian','enorian.rajoelisoa@viacesi.fr','0633333333'),
    ('admin04',SHA2('admin', 256),'GIESE','Laura','laura.giese@viacesi.fr','0644444444');

INSERT INTO Administrateur (IdUtilisateur)
VALUES
    ('admin01'),
    ('admin02'),
    ('admin03'),
    ('admin04');

INSERT INTO Entreprise(NomEntreprise,Site,DescriptionEntreprise,MailEntreprise,TelephoneEntreprise,Statut)
VALUES ('IBM','https://www.ibm.com','International Business Machines Corporation, connue sous le sigle IBM, est une entreprise multinationale américaine présente dans les domaines du matériel informatique, du logiciel et des services informatiques.',
        'contact@ibm.com','+33 805 54 20 07','Disponible'),
       ('Strasbourg Eurométropole', 'https://www.strasbourg.eu/', 'L''Eurométropole de Strasbourg (EMS) est une métropole française située dans la collectivité européenne d''Alsace. Créée le 4 décembre 1967 sous le nom de communauté urbaine de Strasbourg (CUS), elle devient une métropole le 1er janvier 2015.',
        'contact@strasbourg.eu','+33 (0)3 68 98 50 00','Disponible');