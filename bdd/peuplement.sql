DROP PROCEDURE IF EXISTS createAdresse;
CREATE PROCEDURE `createAdresse`()
BEGIN
    INSERT INTO Adresse (Rue, Ville, CodePostal)
    VALUES (CONCAT(FLOOR(RAND() * 10000) + 1, ' ', (SELECT * FROM (VALUES ('Main Street'), ('Oak Avenue'), ('Sunset Boulevard'), ('Wall Street'), ('Broadway'), ('Fifth Avenue'), ('Madison Avenue'), ('Park Avenue'), ('Lexington Avenue'), ('Rodeo Drive')) AS NomRueGenerated ORDER BY RAND() LIMIT 1)),
            (SELECT * FROM (VALUES ('New York'), ('Los Angeles'), ('Chicago'), ('Houston'), ('Phoenix'), ('Philadelphia'), ('San Antonio'), ('San Diego'), ('Dallas'), ('San Jose')) AS NomVilleGenerated ORDER BY RAND() LIMIT 1),
            CONCAT(FLOOR(RAND() * 9000) * 10 + 10000));
END;

DROP PROCEDURE IF EXISTS createPilote;
CREATE PROCEDURE `createPilote`(IN userId VARCHAR(64), IN password VARCHAR(64), IN nomP VARCHAR(32), IN prenomP VARCHAR(32), IN mail VARCHAR(64), IN telephone VARCHAR(16))
BEGIN
    INSERT INTO Utilisateur (IdUtilisateur, MotDePasse, Nom, Prenom, MailUtilisateur, TelephoneUtilisateur)
    VALUES (userId, password, nomP, prenomP, mail, telephone);
    INSERT INTO Pilote (IdUtilisateur) VALUES (userId);
END;

DROP PROCEDURE IF EXISTS createAdministateur;
CREATE PROCEDURE `createAdministateur`(IN userId VARCHAR(64), IN password VARCHAR(64), IN nomP VARCHAR(32), IN prenomP VARCHAR(32), IN mail VARCHAR(64), IN telephone VARCHAR(16))
BEGIN
    INSERT INTO Utilisateur (IdUtilisateur, MotDePasse, Nom, Prenom, MailUtilisateur, TelephoneUtilisateur)
    VALUES (userId, password, nomP, prenomP, mail, telephone);
    INSERT INTO Administrateur (IdUtilisateur, IdPromotion)
    VALUES (userId, (SELECT IdPromotion FROM Promotion ORDER BY RAND() LIMIT 1));
END;

DROP PROCEDURE IF EXISTS createEtudiant;
CREATE PROCEDURE `createEtudiant`(IN userId VARCHAR(64), IN password VARCHAR(64), IN nomP VARCHAR(32), IN prenomP VARCHAR(32), IN mail VARCHAR(64), IN telephone VARCHAR(16), IN idPromotionP INT, IN idAdresseP INT)
BEGIN
    INSERT INTO Utilisateur (IdUtilisateur, MotDePasse, Nom, Prenom, MailUtilisateur, TelephoneUtilisateur) VALUES (userId, password, nomP, prenomP, mail, telephone);
    INSERT INTO Etudiant (IdUtilisateur, IdPromotion, IdAdresse) VALUES (userId, idPromotionP, idAdresseP);
END;

DROP PROCEDURE IF EXISTS createRandomPromotions;
CREATE PROCEDURE `createRandomPromotions`(IN count INT)
BEGIN
    FOR i IN 1..count DO
            INSERT INTO Promotion (NomPromotion, TypePromotion, DatePromotion, NiveauPromotion, DuréePromotion, TypeDureePromotion,
                                   Centre, AdministrateurPromotion, PilotePromotion)
            VALUES (CONCAT('Promotion ', LPAD(i, 2, '0')),
                    (IF(RAND() > 0.5, 'BTP', 'Informatique')),
                    DATE_ADD('2020-01-01', INTERVAL FLOOR(RAND() * 5) YEAR),
                    (RAND() * 4 + 2),
                    (RAND() * 9 + 1),
                    (IF(RAND() > 0.5, 'Mois', 'Semaines')),
                    (SELECT * FROM (VALUES ('Paris'), ('Lyon'), ('Strasbourg'), ('Toulouse'), ('Nantes'), ('Bordeaux'), ('Lille'), ('Marseille'), ('Rennes'), ('Nice')) AS NomCentreGenerated ORDER BY RAND() LIMIT 1),
                    (SELECT IdUtilisateur
                     FROM Administrateur
                     ORDER BY RAND()
                     LIMIT 1),
                    (SELECT IdUtilisateur
                     FROM Pilote
                     ORDER BY RAND()
                     LIMIT 1));
        END FOR;
END;

FOR i IN 1..100 DO
        CALL createAdresse();
    END FOR;

FOR i IN 1..10 DO
        CALL createPilote(CONCAT('pilote', LPAD(i, 2, '0')), SHA2('pilote', 256), CONCAT('Pilote', LPAD(i, 2, '0')), 'Pilote', CONCAT('pilote', LPAD(i, 2, '0'), '@viacesi.fr'), CONCAT('06', LPAD(i, 8, '0')));
    END FOR;

FOR i IN 1..10 DO
        CALL createEtudiant(CONCAT('etudiant', LPAD(i, 2, '0')), SHA2('etudiant', 256), CONCAT('Etudiant', LPAD(i, 2, '0')), 'Etudiant', CONCAT('etudiant', LPAD(i, 2, '0'), '@viacesi.fr'), CONCAT('06', LPAD(i, 8, '0')), (SELECT IdPromotion FROM Promotion ORDER BY RAND() LIMIT 1), (SELECT IdAdresse FROM Adresse ORDER BY RAND() LIMIT 1));
    END FOR;

FOR i IN 1..10 DO
        CALL createAdministateur(CONCAT('admin', LPAD(i, 2, '0')), SHA2('admin', 256), CONCAT('Admin', LPAD(i, 2, '0')), 'Admin', CONCAT('admin', LPAD(i, 2, '0'), '@viacesi.fr'), CONCAT('06', LPAD(i, 8, '0')));
    END FOR;

CALL createRandomPromotions(10);

CALL createAdministateur('Louise.Ley', SHA2('admin', 256), 'LEY', 'Louise', 'louise.ley@viacesi.fr', '0611111111');
CALL createAdministateur('Cédric.Hoog', SHA2('admin', 256), 'HOOG', 'Cédric', 'cedric.hoog@viacesi.fr', '0622222222');
CALL createAdministateur('Enorian.Rajoelisoa', SHA2('admin', 256), 'RAJOELISOA', 'Enorian', 'enorian.rajoelisoa@viacesi.fr', '0633333333');
CALL createAdministateur('Laura.Giese', SHA2('admin', 256), 'GIESE', 'Laura', 'laura.giese@viacesi.fr', '0644444444');

INSERT INTO Entreprise(NomEntreprise, Site, DescriptionEntreprise, MailEntreprise, TelephoneEntreprise, Statut)
VALUES ('IBM', 'https://www.ibm.com',
        'International Business Machines Corporation, connue sous le sigle IBM, est une entreprise multinationale américaine présente dans les domaines du matériel informatique, du logiciel et des services informatiques.',
        'contact@ibm.com', '+33 805 54 20 07', 'Disponible'),
       ('Strasbourg Eurométropole', 'https://www.strasbourg.eu/',
        'L''Eurométropole de Strasbourg (EMS) est une métropole française située dans la collectivité européenne d''Alsace. Créée le 4 décembre 1967 sous le nom de communauté urbaine de Strasbourg (CUS), elle devient une métropole le 1er janvier 2015.',
        'contact@strasbourg.eu', '+33 (0)3 68 98 50 00', 'Disponible');