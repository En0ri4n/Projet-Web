DROP PROCEDURE IF EXISTS createAdresse;
CREATE PROCEDURE `createAdresse`()
BEGIN
    INSERT INTO Adresse (Rue, Ville, CodePostal, Pays)
    VALUES (CONCAT(FLOOR(RAND() * 10000) + 1, ' ', (SELECT * FROM (VALUES ('Main Street'), ('Oak Avenue'), ('Sunset Boulevard'), ('Wall Street'), ('Broadway'), ('Fifth Avenue'), ('Madison Avenue'), ('Park Avenue'), ('Lexington Avenue'), ('Rodeo Drive')) AS NomRueGenerated ORDER BY RAND() LIMIT 1)),
            (SELECT * FROM (VALUES ('New York'), ('Los Angeles'), ('Chicago'), ('Houston'), ('Phoenix'), ('Philadelphia'), ('San Antonio'), ('San Diego'), ('Dallas'), ('San Jose')) AS NomVilleGenerated ORDER BY RAND() LIMIT 1),
            CONCAT(FLOOR(RAND() * 9000) * 10 + 10000),
            (SELECT * FROM (VALUES ('France'), ('Allemagne'), ('Espagne'), ('Italie'), ('Royaume-Uni'), ('Pays-Bas'), ('Belgique'), ('Suisse'), ('Portugal'), ('Suède')) AS NomPaysGenerated ORDER BY RAND() LIMIT 1));
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
    INSERT INTO Administrateur (IdUtilisateur)
    VALUES (userId);
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
        SET @annee = FLOOR(RAND() * 4 + 2);
        SET @type = (SELECT * FROM (VALUES('BTP'), ('Informatique'),('Systèmes Embarqués'),('Généraliste')) AS type ORDER BY RAND() LIMIT 1);
        SET @centre = (SELECT * FROM (VALUES ('Paris'), ('Lyon'), ('Strasbourg'), ('Toulouse'), ('Nantes'), ('Bordeaux'), ('Lille'), ('Marseille'), ('Rennes'), ('Nice')) AS NomCentreGenerated ORDER BY RAND() LIMIT 1);
            INSERT INTO Promotion (NomPromotion, TypePromotion, DatePromotion, NiveauPromotion, DuréePromotion,
                                   Centre, PilotePromotion)
            VALUES (CONCAT('A', @annee, ' ', @type, ' ', @centre),
                    @type,
                    (SELECT * FROM (VALUES ('2024-04-08'),('2025-01-13'),('2024-09-16'),('2025-01-27')) AS dates ORDER BY RAND() LIMIT 1),
                    @annee,
                    FLOOR(RAND() * 6 + 1),
                    @centre,
                    (SELECT IdUtilisateur
                     FROM Pilote
                     ORDER BY RAND()
                     LIMIT 1));
        END FOR;
END;

DROP PROCEDURE IF EXISTS createRandomEvaluations;
CREATE PROCEDURE `createRandomEvaluations`(IN count INT)
BEGIN
    FOR i IN 1..count DO
            SET @user = (SELECT IdUtilisateur FROM Utilisateur ORDER BY RAND() LIMIT 1);
            SET @entreprise = (SELECT IdEntreprise FROM Entreprise WHERE NOT EXISTS(SELECT IdEntreprise FROM Evaluation WHERE IdUtilisateur = @user AND Evaluation.IdEntreprise = Entreprise.IdEntreprise) ORDER BY RAND() LIMIT 1);
            IF @entreprise IS NOT NULL THEN
                INSERT INTO Evaluation(Note, Commentaire, IdUtilisateur, IdEntreprise)
                VALUES (FLOOR(RAND()*5+1),'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris ac.',@user,@entreprise);
            END IF;
        END FOR;
END;

DROP PROCEDURE IF EXISTS createRandomOffres;
CREATE PROCEDURE `createRandomOffres`(IN count INT)
BEGIN
    FOR i IN 1..count DO
            INSERT INTO Offre (DateOffre, DureeOffre, Remuneration, NbPlace, NomOffre, NiveauOffre, DescriptionOffre, IdSecteur, IdAdresse, IdEntreprise)
            VALUES ((SELECT CURRENT_DATE + INTERVAL FLOOR(RAND() * 200) DAY),FLOOR(RAND()*6+1),(4.35+ROUND(RAND()*2,2)),FLOOR(RAND()*5+1),CONCAT('Poste', LPAD(i, 2, '0')),FLOOR(RAND()*5+1),'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent felis ex, dapibus sit amet efficitur at, porta vitae sem. Aenean augue nibh, sollicitudin eu sem quis, lobortis pretium sapien. Morbi quis nunc luctus, tempus quam fermentum, faucibus quam. Praesent ut mollis nunc, quis consequat diam. Nam condimentum urna vitae velit.',
                    (SELECT IdSecteur FROM Secteur ORDER BY RAND() LIMIT 1),(SELECT IdAdresse FROM Adresse ORDER BY RAND() LIMIT 1),(SELECT IdEntreprise FROM Entreprise ORDER BY RAND() LIMIT 1));
        END FOR;
END;

DROP PROCEDURE IF EXISTS createRandomCandidatures;
CREATE PROCEDURE `createRandomCandidatures`(IN count INT)
BEGIN
    FOR i IN 1..count DO
            INSERT INTO Candidature(CV, LettreMotivation, StatutCandidature, IdEtudiant, IdOffre)
            VALUES ('/storage/cv_exemple.docx','/storage/lettre_de_motivation_exemple.docx',
                    (SELECT * FROM (VALUES('Acceptée'), ('Refusée'),('En attente')) AS statut ORDER BY RAND() LIMIT 1),
                    (SELECT IdUtilisateur
                     FROM Etudiant
                     ORDER BY RAND()
                     LIMIT 1),
                    (SELECT IdOffre
                     FROM Offre
                     ORDER BY RAND()
                     LIMIT 1));
        END FOR;
END;

DROP PROCEDURE IF EXISTS createRandomCompetencesOffres;
CREATE PROCEDURE `createRandomCompetencesOffres`(IN count INT)
BEGIN
FOR i IN 1..count DO
        SET @nbCompetences=FLOOR(RAND()*3+1);
        FOR j IN 1..@nbCompetences DO
                SET @offre = (SELECT IdOffre FROM Offre ORDER BY RAND() LIMIT 1);
                SET @competence = (SELECT IdCompetence FROM Competence WHERE NOT EXISTS(SELECT IdCompetence FROM Demander WHERE IdOffre = @offre AND Demander.IdCompetence = Competence.IdCompetence) ORDER BY RAND() LIMIT 1);
                INSERT INTO Demander(IdOffre, IdCompetence)
                VALUES (@offre,@competence);
            END FOR;
    END FOR;
END;

DROP PROCEDURE IF EXISTS createRandomWishlist;
CREATE PROCEDURE `createRandomWishlist`(IN count INT)
BEGIN
    FOR i IN 1..count DO
            SET @nbOffres=FLOOR(RAND()*5+1);
            FOR j IN 1..@nbOffres DO
                    SET @offre = (SELECT IdOffre FROM Offre ORDER BY RAND() LIMIT 1);
                    SET @user = (SELECT IdUtilisateur FROM Etudiant WHERE NOT EXISTS(SELECT IdUtilisateur FROM Wishlist WHERE IdOffre = @offre AND Wishlist.IdUtilisateur = Etudiant.IdUtilisateur) ORDER BY RAND() LIMIT 1);
                    INSERT INTO Wishlist(IdOffre, IdUtilisateur)
                    VALUES (@offre,@user);
                END FOR;
        END FOR;
END;

CALL createRandomPromotions(10);


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


CALL createAdministateur('louise.ley', SHA2('admin', 256), 'LEY', 'Louise', 'louise.ley@viacesi.fr', '0611111111');
CALL createAdministateur('cedric.hoog', SHA2('admin', 256), 'HOOG', 'Cédric', 'cedric.hoog@viacesi.fr', '0622222222');
CALL createAdministateur('enorian.rajoelisoa', SHA2('admin', 256), 'RAJOELISOA', 'Enorian', 'enorian.rajoelisoa@viacesi.fr', '0633333333');
CALL createAdministateur('laura.giese', SHA2('admin', 256), 'GIESE', 'Laura', 'laura.giese@viacesi.fr', '0644444444');

INSERT INTO Entreprise(NomEntreprise, Site, DescriptionEntreprise, MailEntreprise, TelephoneEntreprise, Statut)
VALUES ('IBM','https://www.ibm.com','International Business Machines Corporation, connue sous le sigle IBM, est une entreprise multinationale américaine présente dans les domaines du matériel informatique, du logiciel et des services informatiques.',
        'contact@ibm.com','+33 805 54 20 07','Disponible'),
       ('Strasbourg Eurométropole', 'https://www.strasbourg.eu/', 'L''Eurométropole de Strasbourg (EMS) est une métropole française située dans la collectivité européenne d''Alsace. Créée le 4 décembre 1967 sous le nom de communauté urbaine de Strasbourg (CUS), elle devient une métropole le 1er janvier 2015.',
        'contact@strasbourg.eu','+33 (0)3 68 98 50 00','Disponible'),
       ('Dalim Software','https://www.dalim.com','Notre équipe internationale de développeurs donne vie à nos solutions innovantes de flux de production depuis notre siège situé à Kehl, soit à la frontière entre l’Allemagne et la France. Notre équipe multilingue de support est présente dans le monde entier pour répondre plus rapidement aux besoins de nos clients internationaux.',
        'jobs@dalim.com','+49785191960','Disponible'),
       ('Alcatel','https://www.al-enterprise.com','Alcatel (acronyme d''Alsacienne de constructions atomiques, de télécommunications et d''électronique) était une entreprise française spécialisée dans le secteur des télécommunications. Elle fusionne avec Lucent Technologies au mois de décembre 2006 pour devenir « Alcatel-Lucent ». Alcatel-Lucent est rachetée par Nokia en 2015 et n''a plus d''existence propre en 2016.',
        'contact@alcatel.com','0820 820 217','Disponible'),
       ('Cherry Pick','https://app.cherry-pick.io','Cherry Pick a développé un véritable système de matching se basant sur les besoins de l’entreprise et les compétences de chaque talent (hard & soft skills).',
        'contact@cherry-pick.io','06 62 97 21 64','Disponible');

CALL createRandomEvaluations(100);

INSERT INTO Secteur (NomSecteur)
VALUES ('Aérospatial'),('Aéronautique'),('Automobile'),('Métallurgie'),('Bâtiment'),('Electromécanique'),('Mécanique'),('Electronique'),('Electricité'),('Développement'),('Réseau'),('Cybersécurité'),('Web'),('Robotique');

CALL createRandomOffres(50);

INSERT INTO Competence  (NomCompetence)
VALUES ('Sérieux'),('Autonomie'),('Curiosité'),('Esprit d\'équipe'),('Flexibilité'),('Créativité'),('Communication'),('Organisation'),('Leadership'),('Concentration');

CALL createRandomCandidatures(25);

FOR i IN 1..5 DO
    SET @nbAdresses=FLOOR(RAND()*5+1);
    FOR j IN 1..@nbAdresses DO
        SET @adresse = (SELECT IdAdresse FROM Adresse WHERE NOT EXISTS(SELECT IdAdresse FROM Localiser WHERE IdEntreprise = i AND Localiser.IdAdresse = Adresse.IdAdresse) ORDER BY RAND() LIMIT 1);
        INSERT INTO Localiser(idEntreprise, idAdresse)
        VALUES (i,@adresse);
        END FOR;
    END FOR;

CALL createRandomCompetencesOffres(40);

CALL createRandomWishlist(50);

FOR i IN 1..5 DO
        SET @nbSecteurs=FLOOR(RAND()*5+1);
        FOR j IN 1..@nbSecteurs DO
                SET @secteur = (SELECT IdSecteur FROM Secteur WHERE NOT EXISTS(SELECT IdSecteur FROM Composer WHERE IdEntreprise = i AND Composer.IdSecteur = Secteur.IdSecteur) ORDER BY RAND() LIMIT 1);
                INSERT INTO Composer(idEntreprise, IdSecteur)
                VALUES (i,@secteur);
            END FOR;
    END FOR;