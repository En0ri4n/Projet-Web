-- Active: 1710404343123@@cesi-project-web.sitam.me@3306@projet-web-eno
SELECT Nom 
FROM Utilisateur 
WHERE IdUtilisateur 
IN Etudiant; #nom de l'etudiant
SELECT Prenom 
FROM Utilisateur 
WHERE IdUtilisateur 
IN Etudiant; #prenom de l'etudiant
SELECT  NomPromotion 
FROM Promotion 
INNER JOIN Etudiant ON Appartenir.IdPromotion = Appartenir.IdUtilisateur; #promo de l'etudiant
SELECT Centre 
FROM Promotion 
INNER JOIN Etudiant ON Appartenir.IdPromotion = Appartenir.IdUtilisateur; #centre ou etudie l'etudiant