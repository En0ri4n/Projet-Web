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
