-- Active: 1710404343123@@cesi-project-web.sitam.me@3306@projet-web-eno
SELECT NomOffre 
FROM Offre 
INNER JOIN Competence ON Offre.IdOffre = Competence.IdCompetence 
WHERE Competence.IdCompetence = ''; #trier les offres par competence
SELECT NomOffre 
FROM Offre 
INNER JOIN Adresse ON Offre.IdOffre = Adresse.IdAdresse 
WHERE Ville = ''; #trier les offres par ville
SELECT NomOffre 
FROM Offre 
WHERE NiveauOffre =''; #trier les offres par niveau
SELECT NomOffre 
FROM Offre 
WHERE DureeOffre >= '' AND DureeOffre <= ''; #trier les offres par durée
SELECT NomOffre 
FROM Offre 
INNER JOIN Wishlist ON Wishlist.IdOffre = Offre.IdOffre 
WHERE Offre.NomOffre = '';  #recuperer les offres les plus placees dans une wishlist
/*Cherche les offres ayant une certaine compétence*/
SELECT Offre.NomOffre 
FROM Offre 
INNER JOIN Demander ON Offre.IdOffre = Demander.IdOffre
INNER JOIN Competence ON Demander.IdCompetence = Competence.IdCompetence 
WHERE Competence.NomCompetence = '';

/*Cherche Offres ayant une certaine adresse*/
SELECT Offre.NomOffre 
FROM Offre 
INNER JOIN Adresse ON Offre.IdAdresse = Adresse.IdAdresse
WHERE Adresse.Ville = '';

/*Cherche Offres d'un domaine*/
SELECT Offre.NomOffre 
FROM Offre 
INNER JOIN Secteur ON Offre.IdSecteur = Secteur.IdSecteur
WHERE Secteur.NomSecteur = '';

/*Cherche Offres par niveau*/
SELECT NomOffre 
FROM Offre 
WHERE NiveauOffre ='';

/*Cherche Offre par duree*/
SELECT NomOffre 
FROM Offre 
WHERE DureeOffre >= 0 AND DureeOffre <= 1;

/*Cherche Top des offres*/
/*TODO : A tester*/
SELECT Offre.NomOffre 
FROM Offre
INNER JOIN Candidature ON Offre.IdOffre = Candidature.IdOffre
Order BY count(Candidature.IdOffre);
