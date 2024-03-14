-- Active: 1710404343123@@cesi-project-web.sitam.me@3306@projet-web-eno
SELECT NomOffre FROM Offre INNER JOIN Competence ON Offre.IdOffre = Competence.IdCompetence WHERE Competence = '';
SELECT NomOffre FROM Offre INNER JOIN Adresse ON Offre.IdOffre = Adresse.IdAdresse WHERE Ville = '';
SELECT NomOffre FROM Offre WHERE NiveauOffre ='';
SELECT NomOffre FROM Offre WHERE DureeOffre >= '' AND DureeOffre <= '';
SELECT NomOffre FROM Offre 
