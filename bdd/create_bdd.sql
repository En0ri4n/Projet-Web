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
   IdEntreprise INT,
   NomEntreprise VARCHAR(64) NOT NULL,
   Site VARCHAR(64),
   DescriptionEntreprise VARCHAR(512) NOT NULL,
   MailEntreprise VARCHAR(64),
   TelephoneEntreprise VARCHAR(20),
   Statut VARCHAR(16),
   PRIMARY KEY(IdEntreprise)
);

CREATE TABLE Adresse(
   IdAdresse INT,
   Rue VARCHAR(92) NOT NULL,
   Ville VARCHAR(64) NOT NULL,
   CodePostal VARCHAR(16),
   PRIMARY KEY(IdAdresse)
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
   Remuneration CURRENCY NOT NULL,
   NbPlace INT NOT NULL,
   NomOffre VARCHAR(64) NOT NULL,
   NiveauOffre INT,
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
   NiveauPromotion INT NOT NULL,
   DuréePromotion INT NOT NULL,
   TypeDureePromotion VARCHAR(32) NOT NULL,
   Centre VARCHAR(64),
   IdUtilisateur VARCHAR(64),
   IdUtilisateur_1 VARCHAR(64),
   PRIMARY KEY(IdPromotion),
   FOREIGN KEY(IdUtilisateur) REFERENCES Administrateur(IdUtilisateur),
   FOREIGN KEY(IdUtilisateurAdmin) REFERENCES Pilote(IdUtilisateur)
);

CREATE TABLE Etudiant(
   IdUtilisateur VARCHAR(64),
   IdPromotion INT,
   IdAdresse INT NOT NULL,
   PRIMARY KEY(IdUtilisateur),
   FOREIGN KEY(IdUtilisateur) REFERENCES Utilisateur(IdUtilisateur),
   FOREIGN KEY(IdPromotion) REFERENCES Promotion(IdPromotion),
   FOREIGN KEY(IdAdresse) REFERENCES Adresse(IdAdresse)
);

CREATE TABLE Candidature(
   IdCandidature INT,
   CV VARCHAR(64),
   LettreMotivation VARCHAR(50),
   IdUtilisateur VARCHAR(64),
   IdUtilisateur_1 VARCHAR(64),
   IdOffre INT NOT NULL,
   PRIMARY KEY(IdCandidature),
   FOREIGN KEY(IdUtilisateur) REFERENCES Etudiant(IdUtilisateur),
   FOREIGN KEY(IdUtilisateurAdmin) REFERENCES Administrateur(IdUtilisateur),
   FOREIGN KEY(IdOffre) REFERENCES Offre(IdOffre)
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

CREATE TABLE AdminWishlist(
   IdOffre INT,
   IdUtilisateur VARCHAR(64),
   PRIMARY KEY(IdOffre, IdUtilisateur),
   FOREIGN KEY(IdOffre) REFERENCES Offre(IdOffre),
   FOREIGN KEY(IdUtilisateur) REFERENCES Administrateur(IdUtilisateur)
);

CREATE TABLE AdminAppartenir(
   IdPromotion INT,
   IdUtilisateur VARCHAR(64),
   PRIMARY KEY(IdPromotion, IdUtilisateur),
   FOREIGN KEY(IdPromotion) REFERENCES Promotion(IdPromotion),
   FOREIGN KEY(IdUtilisateur) REFERENCES Administrateur(IdUtilisateur)
);
