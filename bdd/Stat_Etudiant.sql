-- Active: 1710404343123@@cesi-project-web.sitam.me@3306@projet-web-eno
SELECT Nom FROM Utilisateur WHERE IdUtilisateur IN Etudiant;
SELECT Prenom FROM Utilisateur WHERE IdUtilisateur IN Etudiant;
SELECT  NomPromotion FROM Promotion INNER JOIN Etudiant ON Appartenir.IdPromotion = Appartenir.IdUtilisateur;
SELECT Centre FROM Promotion INNER JOIN Etudiant ON Appartenir.IdPromotion = Appartenir.IdUtilisateur;