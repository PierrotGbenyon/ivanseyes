/*==============================================================*/
/* Nom de SGBD :  PostgreSQL 8                                  */
/* Date de cr�ation :  25/07/2018 09:51:10                      */
/*==============================================================*/


drop index if exists achat_denree2_fk;

drop index if exists achat_denree_fk;

drop index if exists achat_denree_pk;

drop table if exists achat_denree;

drop index if exists effectuer3_fk;

drop index if exists action_pk;

drop table if exists action;

drop index if exists ouvrir_fk;

drop index if exists caisse_pk;

drop table if exists caisse;

drop index if exists categorie_pk;

drop table if exists categorie;

drop index if exists correspondre_fk;

drop index if exists chambre_pk;

drop table if exists chambre;

drop index if exists client_pk;

drop table if exists client;

drop index if exists commander_fk;

drop index if exists concerner_fk;

drop index if exists commande_pk;

drop table if exists commande;

drop index if exists constitution_denree2_fk;

drop index if exists constitution_denree_fk;

drop index if exists constitution_denree_pk;

drop table if exists constitution_denree;

drop index if exists denree_pk;

drop table if exists denree;

drop index if exists retirer_fk;

drop index if exists depense_pk;

drop table if exists depense;

drop index if exists ligne_commande2_fk;

drop index if exists ligne_commande_fk;

drop index if exists ligne_commande_pk;

drop table if exists ligne_commande;

drop index if exists ligne_reservation2_fk;

drop index if exists ligne_reservation_fk;

drop index if exists ligne_reservation_pk;

drop table if exists ligne_reservation;

drop index if exists sous_menu_fk;

drop index if exists sur_menu_fk;

drop index if exists menu_pk;

drop table if exists menu;

drop index if exists menu_profil2_fk;

drop index if exists menu_profil_fk;

drop index if exists menu_profil_pk;

drop table if exists menu_profil;

drop index if exists offre_pk;

drop table if exists offre;

drop index if exists verser_fk;

drop index if exists effectuer4_fk;

drop index if exists effectuer2_fk;

drop index if exists paiement_pk;

drop table if exists paiement;

drop index if exists parametre_pk;

drop table if exists parametre;

drop index if exists avoir_fk;

drop index if exists prix_chambre_pk;

drop table if exists prix_chambre;

drop index if exists prix_client2_fk;

drop index if exists prix_client_fk;

drop index if exists prix_client_pk;

drop table if exists prix_client;

drop index if exists avoir2_fk;

drop index if exists prix_denree_pk;

drop table if exists prix_denree;

drop index if exists profil_pk;

drop table if exists profil;

drop index if exists concerner2_fk;

drop index if exists effectuer_fk;

drop index if exists reservation_pk;

drop table if exists reservation;

drop index if exists appartenir_fk;

drop index if exists users_pk;

drop table if exists users;

/*==============================================================*/
/* Table : achat_denree                                         */
/*==============================================================*/
create table achat_denree (
   id_depense           int4                 not null,
   id_denree            int4                 not null,
   qte                  float                not null,
   constraint pk_achat_denree primary key (id_depense, id_denree)
);

/*==============================================================*/
/* Index : achat_denree_pk                                      */
/*==============================================================*/
create unique index achat_denree_pk on achat_denree (
id_depense,
id_denree
);

/*==============================================================*/
/* Index : achat_denree_fk                                      */
/*==============================================================*/
create  index achat_denree_fk on achat_denree (
id_depense
);

/*==============================================================*/
/* Index : achat_denree2_fk                                     */
/*==============================================================*/
create  index achat_denree2_fk on achat_denree (
id_denree
);

/*==============================================================*/
/* Table : action                                               */
/*==============================================================*/
create table action (
   id_action            serial               not null,
   id_user              int4                 null,
   intitule             varchar(80)          not null,
   description          text                 not null,
   created              timestamp            not null default current_timestamp,
   constraint pk_action primary key (id_action)
);

/*==============================================================*/
/* Index : action_pk                                            */
/*==============================================================*/
create unique index action_pk on action (
id_action
);

/*==============================================================*/
/* Index : effectuer3_fk                                        */
/*==============================================================*/
create  index effectuer3_fk on action (
id_user
);

/*==============================================================*/
/* Table : caisse                                               */
/*==============================================================*/
create table caisse (
   id_caisse            serial               not null,
   id_user              int4                 not null,
   montant_ov           numeric(8)           not null,
   montant_fr           numeric(8)           not null,
   date_caisse          date                 not null,
   piscine              smallint             not null,
   created              timestamp            not null default current_timestamp,
   constraint pk_caisse primary key (id_caisse)
);

/*==============================================================*/
/* Index : caisse_pk                                            */
/*==============================================================*/
create unique index caisse_pk on caisse (
id_caisse
);

/*==============================================================*/
/* Index : ouvrir_fk                                            */
/*==============================================================*/
create  index ouvrir_fk on caisse (
id_user
);

/*==============================================================*/
/* Table : categorie                                            */
/*==============================================================*/
create table categorie (
   id_categorie         serial               not null,
   libelle              varchar(50)          not null,
   creator              int                  not null,
   created              timestamp            not null default current_timestamp,
   updated              timestamp,
   deleted              timestamp,
   constraint pk_categorie primary key (id_categorie)
);

/*==============================================================*/
/* Index : categorie_pk                                         */
/*==============================================================*/
create unique index categorie_pk on categorie (
id_categorie
);

/*==============================================================*/
/* Table : chambre                                              */
/*==============================================================*/
create table chambre (
   id_chambre           serial               not null,
   id_categorie         int4                 not null,
   code                 text                 not null,
   creator              int                  not null,
   created              timestamp            not null default current_timestamp,
   updated              timestamp,
   deleted              timestamp,
   constraint pk_chambre primary key (id_chambre)
);

/*==============================================================*/
/* Index : chambre_pk                                           */
/*==============================================================*/
create unique index chambre_pk on chambre (
id_chambre
);

/*==============================================================*/
/* Index : correspondre_fk                                      */
/*==============================================================*/
create  index correspondre_fk on chambre (
id_categorie
);

/*==============================================================*/
/* Table : client                                               */
/*==============================================================*/
create table client (
   id_client            serial               not null,
   id_moral             int4                 null,
   nom                  varchar(30)          not null,
   prenom               varchar(50)          not null,
   date_naiss           date                 not null,
   lieu_naiss           varchar(50)          not null,
   cni                  varchar(30)          not null,
   profession           varchar(100)         not null,
   nationalite          varchar(50)          not null,
   sexe                 char(1)              not null,
   date_delivrance      date                 not null,
   date_expiration      date                 not null,
   contact1             varchar(20)          not null,
   contact2             varchar(20)          null,
   adresse              varchar(150)         null,
   pap                  varchar(100)         null,
   num_pap              varchar(60)          null,
   fidele               smallint             null,
   creator              int                  not null,
   created              timestamp            not null default current_timestamp,
   updated              timestamp,
   deleted              timestamp,
   constraint pk_client primary key (id_client)
);

/*==============================================================*/
/* Index : client_pk                                            */
/*==============================================================*/
create unique index client_pk on client (
id_client
);

/*==============================================================*/
/* Table : client_moral                                         */
/*==============================================================*/
create table client_moral (
   id_moral             serial               not null,
   raison_sociale       text                 not null,
   responsable          text                 not null,
   email                text                 null,
   site_web             text                 null,
   contact              text                 not null,
   creator              int                  not null,
   created              timestamp            not null default current_timestamp,
   updated              timestamp,
   deleted              timestamp,
   constraint pk_client_moral primary key (id_moral)
);

/*==============================================================*/
/* Index : client_moral_pk                                            */
/*==============================================================*/
create unique index client_moral_pk on client_moral (
id_moral
);


/*==============================================================*/
/* Table : commande                                             */
/*==============================================================*/
create table commande (
   id_commande          serial               not null,
   id_offre             int4                 null,
   id_client            int4                 null,
   date_commande        date                 not null,
   montant              numeric(16)          not null,
   qte                  int4                 not null,
   remise               numeric              null,
   annule               smallint             null,
   paye                 smallint             null,
   piscine              smallint             not null,
   creator              int                  not null,
   created              timestamp            not null default current_timestamp,
   updated              timestamp,
   deleted              timestamp,
   constraint pk_commande primary key (id_commande)
);

/*==============================================================*/
/* Index : commande_pk                                          */
/*==============================================================*/
create unique index commande_pk on commande (
id_commande
);

/*==============================================================*/
/* Index : concerner_fk                                         */
/*==============================================================*/
create  index concerner_fk on commande (
id_offre
);

/*==============================================================*/
/* Index : commander_fk                                         */
/*==============================================================*/
create  index commander_fk on commande (
id_client
);

/*==============================================================*/
/* Table : constitution_denree                                  */
/*==============================================================*/
create table constitution_denree (
   id_denree            int4                 not null,
   den_id_denree        int4                 not null,
   qte                  float                not null,
   constraint pk_constitution_denree primary key (id_denree, den_id_denree)
);

/*==============================================================*/
/* Index : constitution_denree_pk                               */
/*==============================================================*/
create unique index constitution_denree_pk on constitution_denree (
id_denree,
den_id_denree
);

/*==============================================================*/
/* Index : constitution_denree_fk                               */
/*==============================================================*/
create  index constitution_denree_fk on constitution_denree (
id_denree
);

/*==============================================================*/
/* Index : constitution_denree2_fk                              */
/*==============================================================*/
create  index constitution_denree2_fk on constitution_denree (
den_id_denree
);

/*==============================================================*/
/* Table : corbeille                                               */
/*==============================================================*/
create table corbeille (
   id_corbeille         serial               not null,
   icone                varchar(50)          not null,
   id                   int4                 not null,
   model                varchar(20)          not null,
   description          text                 not null,
   deleted              timestamp            not null default current_timestamp,
   constraint pk_corbeille primary key (id_corbeille)
);

/*==============================================================*/
/* Table : denree                                               */
/*==============================================================*/
create table denree (
   id_denree            serial               not null,
   libelle              varchar(50)          not null,
   qte                  float                null,
   seuil                int4                 null,
   categorie            varchar(30)          not null,
   unite                varchar(10)          null,
   piscine              smallint             not null,
   creator              int                  not null,
   created              timestamp            not null default current_timestamp,
   updated              timestamp,
   deleted              timestamp,
   constraint pk_denree primary key (id_denree)
);

/*==============================================================*/
/* Index : denree_pk                                            */
/*==============================================================*/
create unique index denree_pk on denree (
id_denree
);

/*==============================================================*/
/* Table : depense                                              */
/*==============================================================*/
create table depense (
   id_depense           serial               not null,
   id_caisse            int4                 not null,
   date_depense         date                 not null,
   montant              numeric(8)           not null,
   type                 text                 not null,
   piscine              smallint             not null,
   creator              int                  not null,
   created              timestamp            not null default current_timestamp,
   deleted              timestamp,
   constraint pk_depense primary key (id_depense)
);

/*==============================================================*/
/* Index : depense_pk                                           */
/*==============================================================*/
create unique index depense_pk on depense (
id_depense
);

/*==============================================================*/
/* Index : retirer_fk                                           */
/*==============================================================*/
create  index retirer_fk on depense (
id_caisse
);

/*==============================================================*/
/* Table : ligne_commande                                       */
/*==============================================================*/
create table ligne_commande (
   id_commande          int4                 not null,
   id_denree            int4                 not null,
   qte                  int4                 not null,
   constraint pk_ligne_commande primary key (id_commande, id_denree)
);

/*==============================================================*/
/* Index : ligne_commande_pk                                    */
/*==============================================================*/
create unique index ligne_commande_pk on ligne_commande (
id_commande,
id_denree
);

/*==============================================================*/
/* Index : ligne_commande_fk                                    */
/*==============================================================*/
create  index ligne_commande_fk on ligne_commande (
id_commande
);

/*==============================================================*/
/* Index : ligne_commande2_fk                                   */
/*==============================================================*/
create  index ligne_commande2_fk on ligne_commande (
id_denree
);

/*==============================================================*/
/* Table : ligne_reservation                                    */
/*==============================================================*/
create table ligne_reservation (
   id_reservation       int4                 not null,
   id_chambre           int4                 not null,
   date_debut           date                 not null,
   date_fin             date                 not null,
   duree                int4           not null,
   constraint pk_ligne_reservation primary key (id_reservation, id_chambre)
);

/*==============================================================*/
/* Index : ligne_reservation_pk                                 */
/*==============================================================*/
create unique index ligne_reservation_pk on ligne_reservation (
id_reservation,
id_chambre
);

/*==============================================================*/
/* Index : ligne_reservation_fk                                 */
/*==============================================================*/
create  index ligne_reservation_fk on ligne_reservation (
id_reservation
);

/*==============================================================*/
/* Index : ligne_reservation2_fk                                */
/*==============================================================*/
create  index ligne_reservation2_fk on ligne_reservation (
id_chambre
);

/*==============================================================*/
/* Table : menu                                                 */
/*==============================================================*/
create table menu (
   id_menu              serial               not null,
   men_id_menu          int4                 null,
   sur_id_menu          int4                 null,
   nom_menu             text                 not null,
   url_menu             text                 null,
   icone                text                 null,
   droit_dispo          varchar(3)           null,
   constraint pk_menu primary key (id_menu)
);

/*==============================================================*/
/* Index : menu_pk                                              */
/*==============================================================*/
create unique index menu_pk on menu (
id_menu
);

/*==============================================================*/
/* Index : sur_menu_fk                                          */
/*==============================================================*/
create  index sur_menu_fk on menu (
sur_id_menu
);

/*==============================================================*/
/* Index : sous_menu_fk                                         */
/*==============================================================*/
create  index sous_menu_fk on menu (
men_id_menu
);

/*==============================================================*/
/* Table : menu_profil                                          */
/*==============================================================*/
create table menu_profil (
   id_menu              int4                 not null,
   id_profil            int4                 not null,
   droit                varchar(6)           not null,
   constraint pk_menu_profil primary key (id_menu, id_profil)
);

/*==============================================================*/
/* Index : menu_profil_pk                                       */
/*==============================================================*/
create unique index menu_profil_pk on menu_profil (
id_menu,
id_profil
);

/*==============================================================*/
/* Index : menu_profil_fk                                       */
/*==============================================================*/
create  index menu_profil_fk on menu_profil (
id_menu
);

/*==============================================================*/
/* Index : menu_profil2_fk                                      */
/*==============================================================*/
create  index menu_profil2_fk on menu_profil (
id_profil
);

/*==============================================================*/
/* Table : offre                                                */
/*==============================================================*/
create table offre (
   id_offre             serial               not null,
   id_moral             int4                 not null,
   libelle              varchar(50)          not null,
   date_debut           date                 not null,
   date_fin             date                 not null,
   montant              numeric(8)           not null,
   creator              int                  not null,
   created              timestamp            not null default current_timestamp,
   updated              timestamp,
   deleted              timestamp,
   constraint pk_offre primary key (id_offre)
);

/*==============================================================*/
/* Index : offre_pk                                             */
/*==============================================================*/
create unique index offre_pk on offre (
id_offre
);

/*==============================================================*/
/* Table : paiement                                             */
/*==============================================================*/
create table paiement (
   id_paiement          serial               not null,
   id_client            int4                 null,
   id_caisse            int4                 not null,
   id_offre             int4                 null,
   date_paiement        date                 not null,
   etat                 text                 null,
   remise               numeric              not null default 0,
   creator              int                  not null,
   created              timestamp            not null default current_timestamp,
   deleted              timestamp,
   constraint pk_paiement primary key (id_paiement)
);

/*==============================================================*/
/* Index : paiement_pk                                          */
/*==============================================================*/
create unique index paiement_pk on paiement (
id_paiement
);

/*==============================================================*/
/* Index : effectuer2_fk                                        */
/*==============================================================*/
create  index effectuer2_fk on paiement (
id_client
);

/*==============================================================*/
/* Index : effectuer4_fk                                        */
/*==============================================================*/
create  index effectuer4_fk on paiement (
id_offre
);

/*==============================================================*/
/* Index : verser_fk                                            */
/*==============================================================*/
create  index verser_fk on paiement (
id_caisse
);

/*==============================================================*/
/* Table : parametre                                            */
/*==============================================================*/
create table parametre (
   id_param             serial               not null,
   liste_categorie      text                 null,
   liste_depense        text                 null,
   liste_nationalite    text                 null,
   liste_pays           text                 null,
   liste_unite          text                 null,
   sauvegarde           smallint             not null default 3,
   corbeille            smallint             not null default 3,
   constraint pk_parametre primary key (id_param)
);

/*==============================================================*/
/* Index : parametre_pk                                         */
/*==============================================================*/
create unique index parametre_pk on parametre (
id_param
);

/*==============================================================*/
/* Table : prix_chambre                                         */
/*==============================================================*/
create table prix_chambre (
   id_prix_chambre      serial               not null,
   id_categorie         int4                 not null,
   prix                 numeric(8)           not null,
   date_prix            date                 not null,
   actif                smallint             not null,
   creator              int                  not null,
   created              timestamp            not null default current_timestamp,
   constraint pk_prix_chambre primary key (id_prix_chambre)
);

/*==============================================================*/
/* Index : prix_chambre_pk                                      */
/*==============================================================*/
create unique index prix_chambre_pk on prix_chambre (
id_prix_chambre
);

/*==============================================================*/
/* Index : avoir_fk                                             */
/*==============================================================*/
create  index avoir_fk on prix_chambre (
id_categorie
);

/*==============================================================*/
/* Table : prix_client                                          */
/*==============================================================*/
create table prix_client (
   id_client            int4                 not null,
   id_categorie         int4                 not null,
   prix                 numeric(8)           not null,
   creator              int                  not null,
   created              timestamp            not null default current_timestamp,
   constraint pk_prix_client primary key (id_client, id_categorie)
);

/*==============================================================*/
/* Index : prix_client_pk                                       */
/*==============================================================*/
create unique index prix_client_pk on prix_client (
id_client,
id_categorie
);

/*==============================================================*/
/* Index : prix_client_fk                                       */
/*==============================================================*/
create  index prix_client_fk on prix_client (
id_client
);

/*==============================================================*/
/* Index : prix_client2_fk                                      */
/*==============================================================*/
create  index prix_client2_fk on prix_client (
id_categorie
);

/*==============================================================*/
/* Table : prix_denree                                          */
/*==============================================================*/
create table prix_denree (
   id_prix_denree       serial               not null,
   id_denree            int4                 not null,
   prix                 numeric(8)           not null,
   date_prix            date                 not null,
   actif                smallint             not null,
   creator              int                  not null,
   created              timestamp            not null default current_timestamp,
   constraint pk_prix_denree primary key (id_prix_denree)
);

/*==============================================================*/
/* Index : prix_denree_pk                                       */
/*==============================================================*/
create unique index prix_denree_pk on prix_denree (
id_prix_denree
);

/*==============================================================*/
/* Index : avoir2_fk                                            */
/*==============================================================*/
create  index avoir2_fk on prix_denree (
id_denree
);

/*==============================================================*/
/* Table : profil                                               */
/*==============================================================*/
create table profil (
   id_profil            serial               not null,
   nom_profil           varchar(25)          not null,
   desc_profil          text                 null,
   creator              int                  not null,
   created              timestamp            not null default current_timestamp,
   updated              timestamp,
   deleted              timestamp,
   constraint pk_profil primary key (id_profil)
);

/*==============================================================*/
/* Index : profil_pk                                            */
/*==============================================================*/
create unique index profil_pk on profil (
id_profil
);

/*==============================================================*/
/* Table : reservation                                          */
/*==============================================================*/
create table reservation (
   id_reservation       serial               not null,
   id_client            int4                 null,
   id_offre             int4                 null,
   date_reseration      date                 not null,
   montant              numeric(8)           not null,
   motif                text                 null,
   remise               numeric              null,
   annule               smallint             null,
   paye                 smallint             null,
   creator              int                  not null,
   created              timestamp            not null default current_timestamp,
   updated              timestamp,
   deleted              timestamp,
   constraint pk_reservation primary key (id_reservation)
);

/*==============================================================*/
/* Index : reservation_pk                                       */
/*==============================================================*/
create unique index reservation_pk on reservation (
id_reservation
);

/*==============================================================*/
/* Index : effectuer_fk                                         */
/*==============================================================*/
create  index effectuer_fk on reservation (
id_client
);

/*==============================================================*/
/* Index : concerner2_fk                                        */
/*==============================================================*/
create  index concerner2_fk on reservation (
id_offre
);

/*==============================================================*/
/* Table : sauvegarde                                               */
/*==============================================================*/
create table sauvegarde (
   id_sauvegarde        serial               not null,
   description          text                 not null,
   created              timestamp            not null default current_timestamp,
   creator              int                  not null,
   constraint pk_sauvegarde primary key (id_sauvegarde)
);

/*==============================================================*/
/* Table : users                                                */
/*==============================================================*/
create table users (
   id_user              serial               not null,
   id_profil            int4                 not null,
   nom                  varchar(30)          not null,
   prenom               varchar(50)          not null,
   login                varchar(30)          not null,
   password             text                 not null,
   photo                varchar(40)          not null default 'avatar.jpg',
   first_use            smallint             not null default 1,
   actif                smallint             not null default 0,
   creator              int                  not null,
   created              timestamp            not null default current_timestamp,
   updated              timestamp,
   deleted              timestamp,
   constraint pk_users primary key (id_user)
);

/*==============================================================*/
/* Index : users_pk                                             */
/*==============================================================*/
create unique index users_pk on users (
id_user
);

/*==============================================================*/
/* Index : appartenir_fk                                        */
/*==============================================================*/
create  index appartenir_fk on users (
id_profil
);

alter table achat_denree
   add constraint fk_achat_de_achat_den_depense foreign key (id_depense)
      references depense (id_depense) on delete cascade on update restrict;

alter table achat_denree
   add constraint fk_achat_de_achat_den_denree foreign key (id_denree)
      references denree (id_denree) on delete cascade on update restrict;

alter table action
   add constraint fk_action_effectuer_users foreign key (id_user)
      references users (id_user) on delete cascade on update restrict;

alter table caisse
   add constraint fk_caisse_ouvrir_users foreign key (id_user)
      references users (id_user) on delete cascade on update restrict;

alter table chambre
   add constraint fk_chambre_correspon_categori foreign key (id_categorie)
      references categorie (id_categorie) on delete cascade on update restrict;

alter table commande
   add constraint fk_commande_commander_client foreign key (id_client)
      references client (id_client) on delete cascade on update restrict;

alter table commande
   add constraint fk_commande_concerner_offre foreign key (id_offre)
      references offre (id_offre) on delete cascade on update restrict;

alter table constitution_denree
   add constraint fk_constitu_constitut_denree2 foreign key (id_denree)
      references denree (id_denree) on delete cascade on update restrict;

alter table constitution_denree
   add constraint fk_constitu_constitut_denree foreign key (den_id_denree)
      references denree (id_denree) on delete cascade on update restrict;

alter table depense
   add constraint fk_depense_retirer_caisse foreign key (id_caisse)
      references caisse (id_caisse) on delete cascade on update restrict;

alter table ligne_commande
   add constraint fk_ligne_co_ligne_com_commande foreign key (id_commande)
      references commande (id_commande) on delete cascade on update restrict;

alter table ligne_commande
   add constraint fk_ligne_co_ligne_com_denree foreign key (id_denree)
      references denree (id_denree) on delete cascade on update restrict;

alter table ligne_reservation
   add constraint fk_ligne_re_ligne_res_reservat foreign key (id_reservation)
      references reservation (id_reservation) on delete cascade on update restrict;

alter table ligne_reservation
   add constraint fk_ligne_re_ligne_res_chambre foreign key (id_chambre)
      references chambre (id_chambre) on delete cascade on update restrict;

alter table menu
   add constraint fk_menu_sous_menu_menu foreign key (men_id_menu)
      references menu (id_menu) on delete cascade on update restrict;

alter table menu
   add constraint fk_menu_sur_menu_menu foreign key (sur_id_menu)
      references menu (id_menu) on delete cascade on update restrict;

alter table menu_profil
   add constraint fk_menu_pro_menu_prof_menu foreign key (id_menu)
      references menu (id_menu) on delete cascade on update restrict;

alter table menu_profil
   add constraint fk_menu_pro_menu_prof_profil foreign key (id_profil)
      references profil (id_profil) on delete cascade on update restrict;

alter table paiement
   add constraint fk_paiement_effectuer_client foreign key (id_client)
      references client (id_client) on delete cascade on update restrict;

alter table paiement
   add constraint fk_paiement_effectuer_offre foreign key (id_offre)
      references offre (id_offre) on delete cascade on update restrict;

alter table paiement
   add constraint fk_paiement_verser_caisse foreign key (id_caisse)
      references caisse (id_caisse) on delete cascade on update restrict;

alter table prix_chambre
   add constraint fk_prix_cha_avoir_categori foreign key (id_categorie)
      references categorie (id_categorie) on delete cascade on update restrict;

alter table prix_client
   add constraint fk_prix_cli_prix_clie_client foreign key (id_client)
      references client (id_client) on delete cascade on update restrict;

alter table prix_client
   add constraint fk_prix_cli_prix_clie_categori foreign key (id_categorie)
      references categorie (id_categorie) on delete cascade on update restrict;

alter table prix_denree
   add constraint fk_prix_den_avoir2_denree foreign key (id_denree)
      references denree (id_denree) on delete cascade on update restrict;

alter table reservation
   add constraint fk_reservat_concerner_offre foreign key (id_offre)
      references offre (id_offre) on delete cascade on update restrict;

alter table reservation
   add constraint fk_reservat_effectuer_client foreign key (id_client)
      references client (id_client) on delete cascade on update restrict;

alter table users
   add constraint fk_users_apparteni_profil foreign key (id_profil)
      references profil (id_profil) on delete cascade on update restrict;

CREATE TABLE "ci_sessions" (
        "id" varchar(128) NOT NULL,
        "ip_address" varchar(45) NOT NULL,
        "timestamp" bigint DEFAULT 0 NOT NULL,
        "data" text DEFAULT '' NOT NULL
);

CREATE INDEX "ci_sessions_timestamp" ON "ci_sessions" ("timestamp");

ALTER TABLE ci_sessions ADD PRIMARY KEY (id);
