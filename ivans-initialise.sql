/* Consultation Ajout Modification Suppression Restauration scram*/
insert into MENU (ID_MENU,SUR_ID_MENU,MEN_ID_MENU, NOM_MENU, URL_MENU, ICONE,DROIT_DISPO) values
  (1,null,null,'Accueil','accueil','md md-home','C'),

  (2,null,null,'Menu principal',null,'fa fa-medium',null),

      (3,2,null,'Service room',null,'md md-hotel',null),
          (4,2,3,'R&eacute;servation','room/reservation',null,'CAS'),
          (5,2,3,'Nos chambres','room/chambre',null,'CAS'),
          (6,2,3,'Nos cat&eacute;gories','room/categorie',null,'CAS'),

      (7,2,null,'Restauration',null,'md md-restaurant-menu',null),
          (8,2,7,'Nouvelle commande','resto/commande/nouveau',null,'CAS'),
          (9,2,7,'Nos commandes','resto/commande',null,'CAS'),
          (10,2,7,'Nos mets','resto/mets',null,'CAS'),
          (11,2,7,'Stock','resto/stock',null,'CAS'),

      (12,2,null,'Caisse',null,'md md-local-atm',null),
          (13,2,12,'Versement','caisse/versement',null,'CA'),
          (14,2,12,'D&eacute;pense','caisse/depense',null,'CA'),
          (15,2,12,'Solde','caisse',null,'C'),

      (16,2,null,'Client&egrave;le',null,'md md-group',null),
          (17,2,16,'Nos clients','client',null,'CAS'),
          (18,2,16,'Fid&eacute;lisation','client/fidelisation',null,'CAS'),

      (19,2,null,'Offre',null,'md md-event-note',null),
          (20,2,19,'Nos offres','offre',null,'CAS'),
          (21,2,19,'Nos clients morales','offre/client',null,'CAS'),

  (22,null,null,'Piscine',null,'md md-local-parking',null),

      (23,22,null,'Restauration',null,'md md-restaurant-menu',null),
          (24,22,23,'Nouvelle commande','commande/nouveau',null,'CAS'),
          (25,22,23,'Nos commandes','commande',null,'CAS'),
          (26,22,23,'Nos mets','plat',null,'CAS'),
          (27,22,23,'Stock','stock',null,'CAS'),

      (28,22,null,'Caisse',null,'fa fa-money',null),
          (29,22,28,'Versement','caisse/versement',null,'CA'),
          (30,22,28,'D&eacute;pense','caisse/depense',null,'CA'),
          (31,22,28,'Solde','caisse',null,'C'),

      (32,22,null,'Client&egrave;le',null,'md md-group',null),
          (33,22,32,'Nos clients','client',null,'CAS'),
          (34,22,32,'Fid&eacute;lisation','client/fidelisation',null,'CAS'),

  (35,null,null,'Administration',null,'md md-security',null),

      (36,35,null,'Profil','profil','fa fa-user','CAS'),
      (37,35,null,'Utilisateur','utilisateur','fa fa-group','CAS'),
      (38,35,null,'Param&egrave;tre','parametre','fa fa-cog','CAS'),
      (39,35,null,'Historique des actions','journal','fa fa-history','CS'),
      (40,35,null,'Corbeille','corbeille','fa fa-trash','CSR'),
      (41,35,null,'Sauvegarde','sauvegarde','fa fa-cloud-upload','CA');

/*Profil admin*/
INSERT INTO profil (ID_PROFIL,NOM_PROFIL, DESC_PROFIL, CREATOR) VALUES
   (1,'Administrateur', 'Ce profil dispose de tous les droits', 0);

 INSERT INTO menu_profil (ID_MENU, ID_PROFIL, DROIT) VALUES
    (1, 1, 'C'),
    (4, 1, 'CAS'),
    (5, 1, 'CAS'),
    (6, 1, 'CAS'),
    (8, 1, 'CAS'),
    (9, 1, 'CAS'),
    (10, 1, 'CAS'),
    (11, 1, 'CAS'),
    (13, 1, 'CA'),
    (14, 1, 'CA'),
    (15, 1, 'C'),
    (17, 1, 'CAS'),
    (18, 1, 'CAS'),
    (20, 1, 'CAS'),
    (21, 1, 'CAS'),
    (24, 1, 'CAS'),
    (25, 1, 'CA'),
    (26, 1, 'CAS'),
    (27, 1, 'CAS'),
    (29, 1, 'CA'),
    (30, 1, 'CA'),
    (31, 1, 'C'),
    (33, 1, 'CAS'),
    (34, 1, 'CAS'),

    (36, 1, 'CAS'),
    (37, 1, 'CAS'),
    (38, 1, 'CAS'),
    (39, 1, 'CS'),
    (40, 1, 'CSR'),
    (41, 1, 'CAS');

 INSERT INTO users (ID_PROFIL, NOM, PRENOM, LOGIN, PASSWORD, ACTIF,CREATOR) VALUES
   ('1','HODOR',' Jsoif Jean-Paul' ,'Jsoif', '$2y$13$j6sEo3UX.5/q/p0OpEM1Le4deomkC3WF7xKZ2PJLvjy0nuGIw/552',1,0),
   ('1','GBENYON', 'Pierre' , 'Pierre', '$2y$13$uE7tlKfou4BlRjN3uDOTR.tzobFjQwS8H2jFP625YD3CDFvMmNHoG',1,0);

 INSERT INTO parametre (id_param,liste_pays,liste_nationalite,liste_categorie) VALUES
   (1,'Togo,Bénin,Ghana,','Togolaise,Béninoise,Ghanéenne,','Boisson,Entrée,Plat');
