
INSERT INTO Adresse (Rue, Ville, CodePostal)
SELECT CONCAT(FLOOR(RAND() * 10000) + 1, ' ',
              (IF(RAND() > 0.5, 'Main Street', 'Oak Avenue'))) AS Rue,
       (IF(RAND() > 0.5, 'New York', 'Los Angeles'))           AS Ville,
       CONCAT(FLOOR(RAND() * 90000) + 10000)                   AS CodePostal
FROM information_schema.tables
LIMIT 200;

INSERT INTO Utilisateur (IdUtilisateur, MotDePasse, Nom, Prenom, MailUtilisateur, TelephoneUtilisateur)
SELECT CONCAT('user', LPAD(ROW_NUMBER() OVER (), 3, '0'))                 AS IdUtilisateur,
       SHA2(CONCAT('password', LPAD(ROW_NUMBER() OVER (), 3, '0')), 256)  AS MotDePasse,
       CONCAT('Nom', LPAD(ROW_NUMBER() OVER (), 3, '0'))                  AS Nom,
       CONCAT('Prenom', LPAD(ROW_NUMBER() OVER (), 3, '0'))               AS Prenom,
       CONCAT('user', LPAD(ROW_NUMBER() OVER (), 3, '0'), '@example.com') AS MailUtilisateur,
       CONCAT('555', LPAD(ROW_NUMBER() OVER (), 7, '0'))                  AS TelephoneUtilisateur
FROM information_schema.tables
LIMIT 100;

INSERT INTO Etudiant (IdUtilisateur, IdAdresse)
SELECT CONCAT('user', LPAD(ROW_NUMBER() OVER (), 3, '0')) AS IdUtilisateur,
       FLOOR(RAND() * 99) + 1                             AS IdAdresse
FROM information_schema.tables
LIMIT 80;

INSERT INTO Pilote (IdUtilisateur)
SELECT CONCAT('user', LPAD(ROW_NUMBER() OVER (), 3, '0')) AS IdUtilisateur
FROM information_schema.tables
LIMIT 19 OFFSET 80;

INSERT INTO Utilisateur (IdUtilisateur, MotDePasse, Nom, Prenom, MailUtilisateur, TelephoneUtilisateur)
VALUES ('admin01', SHA2('admin', 256), 'LEY', 'Louise', 'louise.ley@viacesi.fr', '0611111111'),
       ('admin02', SHA2('admin', 256), 'HOOG', 'Cédric', 'cedric.hoog@viacesi.fr', '0622222222'),
       ('admin03', SHA2('admin', 256), 'RAJOELISOA', 'Enorian', 'enorian.rajoelisoa@viacesi.fr', '0633333333'),
       ('admin04', SHA2('admin', 256), 'GIESE', 'Laura', 'laura.giese@viacesi.fr', '0644444444');

INSERT INTO Administrateur (IdUtilisateur)
VALUES ('admin01'),
       ('admin02'),
       ('admin03'),
       ('admin04');

INSERT INTO Entreprise(NomEntreprise, Site, DescriptionEntreprise, MailEntreprise, TelephoneEntreprise, Statut)
VALUES ('IBM', 'https://www.ibm.com',
        'International Business Machines Corporation, connue sous le sigle IBM, est une entreprise multinationale américaine présente dans les domaines du matériel informatique, du logiciel et des services informatiques.',
        'contact@ibm.com', '+33 805 54 20 07', 'Disponible'),
       ('Strasbourg Eurométropole', 'https://www.strasbourg.eu/',
        'L''Eurométropole de Strasbourg (EMS) est une métropole française située dans la collectivité européenne d''Alsace. Créée le 4 décembre 1967 sous le nom de communauté urbaine de Strasbourg (CUS), elle devient une métropole le 1er janvier 2015.',
        'contact@strasbourg.eu', '+33 (0)3 68 98 50 00', 'Disponible');