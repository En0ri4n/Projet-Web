-- Active: 1710404343123@@cesi-project-web.sitam.me@3306@projet-web-eno
SELECT Nom, Prenom
FROM Utilisateur
WHERE IdUtilisateur
          IN (SELECT IdUtilisateur FROM Etudiant);


#nom de l'etudiant
#prenom de l'etudiant
SELECT NomPromotion
FROM Promotion
         INNER JOIN Etudiant ON Etudiant.IdPromotion = Promotion.IdPromotion
         INNER JOIN Utilisateur ON Etudiant.IdUtilisateur = Utilisateur.IdUtilisateur
WHERE Utilisateur.IdUtilisateur = Etudiant.IdUtilisateur AND Utilisateur.Nom = 'Doe' AND Utilisateur.Prenom = 'John';
; #promo de l'etudiant


SELECT Centre
FROM Promotion
         INNER JOIN Etudiant ON Promotion.IdPromotion = Etudiant.IdPromotion;


#centre ou etudie l'etudiant
#nbre d'offres en wishlist
#nbre d'offres postulees
/*Cherche les données d'un etudiant basé sur son Id*/
SELECT Utilisateur.Nom, Utilisateur.Prenom, Promotion.NomPromotion, Promotion.Centre
FROM Utilisateur
         INNER JOIN Etudiant ON Utilisateur.IdUtilisateur = Etudiant.IdUtilisateur
         INNER JOIN Promotion ON Etudiant.IdPromotion = Promotion.IdPromotion
WHERE Etudiant.IdUtilisateur = 0;
