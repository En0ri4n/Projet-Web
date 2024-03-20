CREATE TABLE Utilisateur
(
    IdUtilisateur        VARCHAR(64)  NOT NULL,
    MotDePasse           VARCHAR(256) NOT NULL,
    Nom                  VARCHAR(64),
    Prenom               VARCHAR(64),
    MailUtilisateur      VARCHAR(64)  NOT NULL,
    TelephoneUtilisateur VARCHAR(20),
    PRIMARY KEY (IdUtilisateur)
);

CREATE TABLE Pilote
(
    IdUtilisateur VARCHAR(64) NOT NULL,
    PRIMARY KEY (IdUtilisateur),
    FOREIGN KEY (IdUtilisateur) REFERENCES Utilisateur (IdUtilisateur)
);

CREATE TABLE Administrateur
(
    IdUtilisateur VARCHAR(64) NOT NULL,
    IdPromotion   INT,
    PRIMARY KEY (IdUtilisateur),
    FOREIGN KEY (IdUtilisateur) REFERENCES Utilisateur (IdUtilisateur)
);

CREATE TABLE Promotion
(
    IdPromotion             INT AUTO_INCREMENT NOT NULL,
    NomPromotion            VARCHAR(64),
    TypePromotion           VARCHAR(64)        NOT NULL,
    DatePromotion           DATE               NOT NULL,
    NiveauPromotion         INT                NOT NULL,
    DuréePromotion          INT                NOT NULL,
    Centre                  VARCHAR(64),
    PilotePromotion         VARCHAR(64),
    PRIMARY KEY (IdPromotion),
    FOREIGN KEY (PilotePromotion) REFERENCES Pilote (IdUtilisateur)
);

ALTER TABLE Administrateur
    ADD CONSTRAINT FOREIGN KEY (IdPromotion) REFERENCES Promotion (IdPromotion); /* Add foreign key to Administrateur because we need promotion before */


CREATE TABLE Entreprise
(
    IdEntreprise          INT AUTO_INCREMENT NOT NULL,
    NomEntreprise         VARCHAR(64)        NOT NULL,
    Site                  VARCHAR(64),
    DescriptionEntreprise VARCHAR(512)       NOT NULL,
    MailEntreprise        VARCHAR(64),
    TelephoneEntreprise   VARCHAR(20),
    Statut                VARCHAR(16),
    PRIMARY KEY (IdEntreprise)
);

CREATE TABLE Adresse
(
    IdAdresse  INT AUTO_INCREMENT NOT NULL,
    Rue        VARCHAR(92)        NOT NULL,
    Ville      VARCHAR(64)        NOT NULL,
    CodePostal VARCHAR(16),
    PRIMARY KEY (IdAdresse)
);

CREATE TABLE Secteur
(
    IdSecteur  INT AUTO_INCREMENT NOT NULL,
    NomSecteur VARCHAR(64)        NOT NULL,
    PRIMARY KEY (IdSecteur)
);

CREATE TABLE Offre
(
    IdOffre          INT AUTO_INCREMENT NOT NULL,
    DateOffre        DATE               NOT NULL,
    DureeOffre       INT                NOT NULL,
    Remuneration     FLOAT(8, 2)        NOT NULL,
    NbPlace          INT                NOT NULL,
    NomOffre         VARCHAR(64)        NOT NULL,
    NiveauOffre      INT,
    DescriptionOffre VARCHAR(512)       NOT NULL,
    IdSecteur        INT                NOT NULL,
    IdAdresse        INT                NOT NULL,
    IdEntreprise     INT                NOT NULL,
    PRIMARY KEY (IdOffre),
    FOREIGN KEY (IdSecteur) REFERENCES Secteur (IdSecteur),
    FOREIGN KEY (IdAdresse) REFERENCES Adresse (IdAdresse),
    FOREIGN KEY (IdEntreprise) REFERENCES Entreprise (IdEntreprise)
);

CREATE TABLE Evaluation
(
    IdEvaluation  INT AUTO_INCREMENT NOT NULL,
    Note          INT,
    Commentaire   VARCHAR(512),
    IdUtilisateur VARCHAR(64)        NOT NULL,
    IdEntreprise  INT                NOT NULL,
    PRIMARY KEY (IdEvaluation),
    FOREIGN KEY (IdUtilisateur) REFERENCES Utilisateur (IdUtilisateur),
    FOREIGN KEY (IdEntreprise) REFERENCES Entreprise (IdEntreprise)
);

CREATE TABLE Competence
(
    IdCompetence  INT AUTO_INCREMENT NOT NULL,
    NomCompetence VARCHAR(64)        NOT NULL,
    PRIMARY KEY (IdCompetence)
);

CREATE TABLE Etudiant
(
    IdUtilisateur VARCHAR(64) NOT NULL,
    IdPromotion   INT,
    IdAdresse     INT         NOT NULL,
    PRIMARY KEY (IdUtilisateur),
    FOREIGN KEY (IdUtilisateur) REFERENCES Utilisateur (IdUtilisateur),
    FOREIGN KEY (IdPromotion) REFERENCES Promotion (IdPromotion),
    FOREIGN KEY (IdAdresse) REFERENCES Adresse (IdAdresse)
);

CREATE TABLE Candidature
(
    IdCandidature            INT AUTO_INCREMENT NOT NULL,
    CV                       VARCHAR(64),
    LettreMotivation         VARCHAR(50),
    StatutCandidature        VARCHAR(16),
    IdEtudiant               VARCHAR(64),
    IdOffre                  INT                NOT NULL,
    PRIMARY KEY (IdCandidature),
    FOREIGN KEY (IdEtudiant) REFERENCES Etudiant (IdUtilisateur),
    FOREIGN KEY (IdOffre) REFERENCES Offre (IdOffre)
);

CREATE TABLE Localiser
(
    IdEntreprise INT,
    IdAdresse    INT,
    PRIMARY KEY (IdEntreprise, IdAdresse),
    FOREIGN KEY (IdEntreprise) REFERENCES Entreprise (IdEntreprise),
    FOREIGN KEY (IdAdresse) REFERENCES Adresse (IdAdresse)
);

CREATE TABLE Demander
(
    IdOffre      INT,
    IdCompetence INT,
    PRIMARY KEY (IdOffre, IdCompetence),
    FOREIGN KEY (IdOffre) REFERENCES Offre (IdOffre),
    FOREIGN KEY (IdCompetence) REFERENCES Competence (IdCompetence)
);

CREATE TABLE Wishlist
(
    IdOffre       INT,
    IdUtilisateur VARCHAR(64),
    PRIMARY KEY (IdOffre, IdUtilisateur),
    FOREIGN KEY (IdOffre) REFERENCES Offre (IdOffre),
    FOREIGN KEY (IdUtilisateur) REFERENCES Etudiant (IdUtilisateur)
);

CREATE TABLE Composer
(
    IdEntreprise INT,
    IdSecteur    INT,
    PRIMARY KEY (IdEntreprise, IdSecteur),
    FOREIGN KEY (IdEntreprise) REFERENCES Entreprise (IdEntreprise),
    FOREIGN KEY (IdSecteur) REFERENCES Secteur (IdSecteur)
);

CREATE TABLE AdminWishlist
(
    IdOffre       INT,
    IdUtilisateur VARCHAR(64),
    PRIMARY KEY (IdOffre, IdUtilisateur),
    FOREIGN KEY (IdOffre) REFERENCES Offre (IdOffre),
    FOREIGN KEY (IdUtilisateur) REFERENCES Administrateur (IdUtilisateur)
);