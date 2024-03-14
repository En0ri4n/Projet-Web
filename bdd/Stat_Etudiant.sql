/*Cherche les données d'un etudiant basé sur son Id*/
SELECT Utilisateur.Nom, Utilisateur.Prenom, Promotion.NomPromotion, Promotion.Centre
FROM Utilisateur
INNER JOIN Etudiant ON Utilisateur.IdUtilisateur = Etudiant.IdUtilisateur
INNER JOIN Promotion ON Etudiant.IdPromotion = Promotion.IdPromotion
WHERE Etudiant.IdUtilisateur = 0;