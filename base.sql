CREATE TABLE Admin(
    id SERIAL PRIMARY KEY,
    email varchar(200),
    mdp varchar(50)
);
INSERT INTO Admin(email,mdp)
VALUES
    ('admin@gmail.com',md5('admin'));

CREATE TABLE Employe(
    id SERIAL PRIMARY KEY,
    nom varchar(200),
    email varchar(200),
    mdp varchar(50),
    etat int
);
INSERT INTO Employe(nom,email,mdp,etat)
VALUES
    ('E1','e1@gmail.com',md5('1234'),0),
    ('E2','e2@gmail.com',md5('1234'),0),
    ('E3','e3@gmail.com',md5('1234'),0);

CREATE TABLE Frequence(
    id SERIAL PRIMARY KEY,
    frequence varchar(50),
    etat int
);
INSERT INTO Frequence(frequence,etat)
VALUES
    ('heure',0),
    ('jour',0);

CREATE TABLE TypeSonorisation(
    id SERIAL PRIMARY KEY,
    type varchar(50),
    etat int
);
INSERT INTO TypeSonorisation(type,etat)
VALUES
    ('standart',0),
    ('premium',0);

CREATE TABLE TypeLogistique(
    id SERIAL PRIMARY KEY,
    type varchar(50),
    etat int
);
INSERT INTO TypeLogistique(type,etat)
VALUES
    ('standart',0),
    ('premium',0);


CREATE TABLE Artiste(
    id SERIAL PRIMARY KEY,
    nom varchar(255) unique,
    tarif double precision,
    frequenceId int,
    photo text,
    etat int,
    FOREIGN KEY (frequenceId) REFERENCES Frequence(id)
);
INSERT INTO Artiste(nom,tarif,frequenceId,photo,etat)
VALUES
    ('Melky',100000,1,'photo1.jpg',0),
    ('Skaiz',120000,1,'photo2.jpg',0),
    ('Black Nadia',130000,1,'photo5.jpg',0),
    ('Agrad',120000,1,'photo4.jpg',0);

CREATE TABLE Sonorisation(
    id SERIAL PRIMARY KEY,
    typeSonorisationId int,
    tarif double precision,
    frequenceId int,
    etat int,
    FOREIGN KEY (typeSonorisationId) REFERENCES TypeSonorisation(id),
    FOREIGN KEY (frequenceId) REFERENCES Frequence(id)
);
INSERT INTO Sonorisation(typeSonorisationId,tarif,frequenceId,etat)
VALUES
    (1,150000,1,0),
    (2,200000,1,0);

CREATE TABLE Logistique(
    id SERIAL PRIMARY KEY,
    typeLogistiqueId int,
    tarif double precision,
    frequenceId int,
    etat int,
    FOREIGN KEY (typeLogistiqueId) REFERENCES TypeLogistique(id),
    FOREIGN KEY (frequenceId) REFERENCES Frequence(id)
);
INSERT INTO Logistique(typeLogistiqueId,tarif,frequenceId,etat)
VALUES
    (1,300000,2,0),
    (2,500000,2,0);

CREATE TABLE TypeLieu(
    id SERIAL PRIMARY KEY,
    type varchar(50),
    etat int
);
INSERT INTO TypeLieu(type,etat)
VALUES
    ('Terrain',0),
    ('Espace',0),
    ('Salle',0);

CREATE TABLE Lieu(
    id SERIAL PRIMARY KEY,
    nom varchar(200),
    typeLieuId int,
    nbPlace int,
    photo text,
    etat int,
    FOREIGN KEY (typeLieuId) REFERENCES TypeLieu(id)
);
INSERT INTO Lieu(nom,typeLieuId,nbPlace,photo,etat)
VALUES
    ('Palais de sport',1,1000,'lieu1.jpg',0),
    ('Espace Rose',2,500,'lieu2.jpg',0),
    ('Vohitriniaina',3,200,'lieu3.jpg',0);

CREATE TABLE Divers(
    id SERIAL PRIMARY KEY,
    designation varchar(200),
    etat int
);
INSERT INTO Divers(designation,etat)
VALUES
    ('Communication',0),
    ('Transport',0);

CREATE TABLE Spectacle(
    id SERIAL PRIMARY KEY,
    titre varchar(255),
    date date,
    heure time,
    lieuId int,
    montant double precision,
    etat int,
    FOREIGN KEY (lieuId) REFERENCES Lieu(id)
);

CREATE TABLE ArtisteSpectacle(
    id SERIAL PRIMARY KEY,
    spectacleId int,
    artisteId int,
    duree double precision,
    etat int,
    FOREIGN KEY (spectacleId) REFERENCES Spectacle(id),
    FOREIGN KEY (artisteId) REFERENCES Artiste(id)
);

CREATE TABLE SonorisationSpectacle(
    id SERIAL PRIMARY KEY,
    spectacleId int,
    typeSonorisationId int,
    duree double precision,
    etat int,
    FOREIGN KEY (spectacleId) REFERENCES Spectacle(id),
    FOREIGN KEY (typeSonorisationId) REFERENCES TypeSonorisation(id)
);

CREATE TABLE LogistiqueSpectacle(
    id SERIAL PRIMARY KEY,
    spectacleId int,
    typeLogistiqueId int,
    duree double precision,
    etat int,
    FOREIGN KEY (spectacleId) REFERENCES Spectacle(id),
    FOREIGN KEY (typeLogistiqueId) REFERENCES TypeLogistique(id)
);

CREATE TABLE DiversSpectacle(
    id SERIAL PRIMARY KEY,
    spectacleId int,
    diversId int,
    montant double precision,
    etat int,
    FOREIGN KEY (spectacleId) REFERENCES Spectacle(id),
    FOREIGN KEY (diversId) REFERENCES Divers(id)
);

CREATE TABLE Categorie(
    id SERIAL PRIMARY KEY,
    categorie varchar(100),
    etat int
);
INSERT INTO Categorie(categorie,etat)
VALUES
    ('VIP',0),
    ('Reserve',0),
    ('Normal',0);

CREATE TABLE CategorieLieu(
    id SERIAL PRIMARY KEY,
    lieuId int,
    categorieId int,
    nbplace int,
    etat int,
    FOREIGN KEY (lieuId) REFERENCES Lieu(id),
    FOREIGN KEY (categorieId) REFERENCES Categorie(id)
);

CREATE TABLE TarifLieu(
    id SERIAL PRIMARY KEY,
    spectacleId int,
    categorieId int,
    tarif double precision,
    etat int,
    FOREIGN KEY (spectacleId) REFERENCES Spectacle(id),
    FOREIGN KEY (categorieId) REFERENCES Categorie(id)
);

CREATE TABLE Taxe(
    id SERIAL PRIMARY KEY,
    taxe double precision
);

CREATE TABLE Vente(
    id SERIAL PRIMARY KEY,
    spectacleId int,
    categorieId int,
    nbplace int,
    etat int,
    FOREIGN KEY (spectacleId) REFERENCES Spectacle(id),
    FOREIGN KEY (categorieId) REFERENCES Categorie(id)
);

CREATE TABLE TaxeBenefice(
    id SERIAL PRIMARY KEY,
    min double precision,
    max double precision,
    taxe double precision
);
INSERT INTO TaxeBenefice(min,max,taxe)
VALUES
    (0,5000000,3),
    (5000001,50000000,8),
    (50000001,1000000000,12);















-- CREATE TABLE TypePrestation(
--     id SERIAL PRIMARY KEY,
--     type varchar(100)
-- );
-- INSERT INTO TypePrestation(type)
-- VALUES
--     ('Fete'),
--     ('Spectacle'),
--     ('Tournee'),
--     ('Ticketing'),
--     ('Location de materiel'),
--     ('Communication');

-- CREATE TABLE Client(
--     id SERIAL PRIMARY KEY,
--     nom varchar(100),
--     contact varchar(100),
--     etat int
-- );
-- INSERT INTO Client(nom,contact,etat)
-- VALUES
--     ('C1','0341122233',0),
--     ('C2','0342233344',0),
--     ('C3','0343344455',0);

-- CREATE TABLE Prestation(
--     id SERIAL PRIMARY KEY,
--     typePrestationId int,
--     debut date,
--     fin date,
--     clientId int,
--     etat int,
--     FOREIGN KEY (typePrestationId) REFERENCES TypePrestation(id),
--     FOREIGN KEY (clientId) REFERENCES Client(id)
-- );

