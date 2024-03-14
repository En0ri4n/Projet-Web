-- Active: 1710404343123@@cesi-project-web.sitam.me@3306@projet-web-eno
SELECT NomEntreprise 
FROM Entreprise 
INNER JOIN Secteur ON Secteur.IdSecteur = Composer.IdSecteur 
INNER JOIN Entreprise ON Entreprise.IdEntreprise = Composer.IdEntreprise
WHERE Secteur.NomSecteur=''; #trier les entreprises par secteur
SELECT NomEntreprise 
FROM Entreprise 
INNER JOIN Adresse ON Adresse.IdAdresse = Localiser.IdAdresse 
INNER JOIN Entreprise ON Entreprise.IdEntreprise = Localiser.IdEntreprise
WHERE Adresse.Ville = ''; #trier les entreprises par ville
SELECT AVG(Note)
FROM Evaluation 
INNER JOIN Entreprise ON Evaluation.IdEvaluation = Entreprise.IdEntreprise 
GROUP BY NomEntreprise
WHERE IdEntreprise = '';#moyenne evaluation entreprise 
/*Cherche Entreprise via Secteur*/
SELECT NomEntreprise 
FROM Entreprise
INNER JOIN Composer ON Entreprise.IdEntreprise = Composer.IdEntreprise
INNER JOIN Secteur ON Composer.IdSecteur = Secteur.IdSecteur 
WHERE Secteur.NomSecteur='';
/*Cherche Entreprise via Ville*/
SELECT NomEntreprise 
FROM Entreprise
INNER JOIN Localiser ON Entreprise.IdEntreprise = Localiser.IdEntreprise 
INNER JOIN Adresse ON Localiser.IdAdresse = Adresse.IdAdresse 
WHERE Ville = '';

