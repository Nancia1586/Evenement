-- Artiste
CREATE or REPLACE VIEW v_artiste as
select a.*,f.frequence from artiste a join frequence f on a.frequenceId = f.id where f.etat = 0;

CREATE or REPLACE VIEW v_sonorisation as
select s.*,t.type,f.frequence
from sonorisation s
    join typesonorisation t on s.typesonorisationid = t.id
    join frequence f on s.frequenceid = f.id where t.etat = 0 and f.etat = 0;

CREATE or REPLACE VIEW v_logistique as
select l.*,t.type,f.frequence
from logistique l
    join typelogistique t on l.typelogistiqueid = t.id
    join frequence f on l.frequenceid = f.id where t.etat = 0 and f.etat = 0;

CREATE or REPLACE VIEW v_lieu as
select l.*,t.type from lieu l join typelieu t on l.typelieuid = t.id where t.etat = 0;

CREATE or REPLACE VIEW v_sonorisationspectacle as
select ss.*,sono.tarif,sono.type,sono.frequence from sonorisationspectacle ss join v_sonorisation sono on ss.typesonorisationid = sono.typesonorisationid where ss.etat = 0 and sono.etat = 0;

CREATE or REPLACE VIEW v_logistiquespectacle as
select ss.*,log.tarif,log.type,log.frequence from logistiquespectacle ss join v_logistique log on ss.typelogistiqueid = log.typelogistiqueid where ss.etat = 0 and log.etat = 0;

CREATE or REPLACE VIEW v_artistespectacle as
select asp.*,a.nom,a.tarif,a.frequence,a.photo from artistespectacle asp join v_artiste a on asp.artisteid = a.id where asp.etat = 0 and a.etat = 0;

CREATE or REPLACE VIEW v_diversspectacle as
select ds.*,d.designation from diversspectacle ds join divers d on ds.diversid = d.id where ds.etat = 0 and d.etat = 0;;

CREATE or REPLACE VIEW v_spectacle as
select s.*,l.nom as nomlieu,l.nbplace,l.photo as photolieu,l.type as typelieu from spectacle s join v_lieu l on l.id = s.lieuid;

-- //DEVIS
CREATE or REPLACE VIEW v_devisartiste as
select s.*,a.id as artistespectacleid,a.artisteid,a.duree,a.nom,a.tarif,a.frequence,a.photo from spectacle s join v_artistespectacle a on s.id = a.spectacleid;

CREATE or REPLACE VIEW v_devissonorisation as
select s.*,sono.id as sonorisationspectacleid,sono.typesonorisationid,sono.duree,sono.tarif,sono.type,sono.frequence from spectacle s join v_sonorisationspectacle sono on s.id = sono.spectacleid;

CREATE or REPLACE VIEW v_devislogistique as
select s.*,l.id as logistiquespectacleid,l.typelogistiqueid,l.duree,l.tarif,l.type,l.frequence from spectacle s join v_logistiquespectacle l on s.id = l.spectacleid;

CREATE or REPLACE VIEW v_devisdivers as
select s.*,d.id as diversspectacleid,d.diversid,d.montant as tarif,d.designation from spectacle s join v_diversspectacle d on s.id = d.spectacleid;


-- //PLACE
CREATE or REPLACE VIEW v_categorielieu as
select cl.*,c.categorie,l.nom from categorielieu cl join lieu l on cl.lieuid = l.id join categorie c on cl.categorieid = c.id;

CREATE or REPLACE VIEW v_tariflieu as
select t.*,s.titre,s.date,s.heure,s.lieuid,s.montant,c.categorie from tariflieu t join spectacle s on t.spectacleid = s.id join categorie c on t.categorieid = c.id where s.etat = 0;

CREATE or REPLACE VIEW v_tarifcategorielieu as
select c.*,t.spectacleid,coalesce(t.tarif,0) as tarif,t.titre,t.date,t.heure,t.montant from v_categorielieu c left join v_tariflieu t on c.categorieid = t.categorieid and c.lieuid = t.lieuid;



CREATE or REPLACE VIEW v_placedefini as
select lieuid,sum(nbplace) as nbplace from v_categorielieu group by lieuid;

CREATE or REPLACE VIEW v_totalplace as
select id as lieuid,sum(nbplace) as totalplace from lieu group by id;

CREATE or REPLACE VIEW v_nombreplacelieu as
select t.lieuid,t.totalplace,coalesce(p.nbplace,0) as defini,(t.totalplace - coalesce(p.nbplace,0)) as nondefini from v_totalplace t left join v_placedefini p on t.lieuid = p.lieuid;


-- //RECETTE
CREATE or REPLACE VIEW v_recettespectacle as
select spectacleid,sum(nbplace * tarif) as recette from v_tarifcategorielieu group by spectacleid;
drop view v_totalrecettespectacle;


CREATE or REPLACE VIEW v_totalrecettespectacle as
select s.*,coalesce(r.recette,0) as recette from spectacle s left join v_recettespectacle r on s.id = r.spectacleid;

-- PLACE vendue et tarif
CREATE or REPLACE VIEW v_venteplace as
select t.*,(tarif * nbplace) as somme from tariflieu t join vente v on t.spectacleid = v.spectacleid and t.categorieid = v.categorieid;

CREATE or REPLACE VIEW v_totalrecettereel as
select s.*,coalesce(r.recette,0) as recette from spectacle s left join v_recettespectacle r on s.id = r.spectacleid;


-- //VENTE
CREATE or REPLACE VIEW v_spectaclecategorie as
select s.*,c.id as categorieid,c.categorie from categorie c,spectacle s where c.etat = 0 and s.etat = 0;


CREATE or REPLACE VIEW v_placevenduespectacle as
select sc.*,coalesce(v.nbplace,0) as placevendue from v_spectaclecategorie sc left join vente v on sc.id = v.spectacleid and sc.categorieid = v.categorieid where sc.etat = 0;


CREATE or REPLACE VIEW v_vente as
select v.*,s.lieuid from vente v join spectacle s on v.spectacleid = s.id;

CREATE or REPLACE VIEW v_placespectacle as
select v.spectacleid,v.categorieid,c.nbplace as placetotal,v.nbplace as placevendue,(c.nbplace - v.nbplace) as placerestant from categorielieu c join v_vente v on c.categorieid = v.categorieid and c.lieuid = v.lieuid;
