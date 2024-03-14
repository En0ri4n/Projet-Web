-- Active: 1710404343123@@cesi-project-web.sitam.me@3306@projet-web-eno
SELECT NomEntreprise FROM Entreprise INNER JOIN Secteur ON Composer.IdEntreprise = Composer.IdSecteur WHERE Secteur='';
SELECT NomEntreprise FROM Offre INNER JOIN Adresse ON Entreprise.IdEntreprise = Adresse.IdAdresse WHERE Ville = '';

