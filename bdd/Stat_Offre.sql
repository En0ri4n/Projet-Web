-- Active: 1710404343123@@cesi-project-web.sitam.me@3306@projet-web-eno
SELECT NomOffre 
FROM Offre 
INNER JOIN Competence ON Offre.IdOffre = Competence.IdCompetence 
WHERE Competence = ''; #trier les offres par competence
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
WHERE  #recuperer les offres les plus placees dans une wishlist
