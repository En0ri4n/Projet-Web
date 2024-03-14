-- Active: 1710404343123@@cesi-project-web.sitam.me@3306@projet-web-eno
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

