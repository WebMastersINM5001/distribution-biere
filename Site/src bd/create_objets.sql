---------------------------------------------
-- Export file for user INM5001            --
-- Created by uacc on 06.10.2014, 19:59:16 --
---------------------------------------------
SET ECHO ON
/
SET SERVEROUTPUT ON
/
set define off
spool distributionBiere.txt

DROP TABLE LIVRAISONDETAIL;
DROP TABLE COMMANDEDETAIL;
DROP TABLE LIVRAISON;
DROP TABLE COMMANDE;
DROP TABLE CLIENT;
DROP TABLE REGION;
DROP TABLE PRODUIT;
DROP TABLE CAMION;
DROP TABLE USAGER;
DROP TABLE ROLE;

prompt
prompt Creating table CAMION
prompt =====================
prompt
create table CAMION
(
  nocamion    NUMBER     not null,
  nbcaissemax NUMBER     not null,
  description VARCHAR2(50),
  disponible  VARCHAR2(1) not null
)
;
alter table CAMION
  add constraint CAMION_PK primary key (NOCAMION);
alter table CAMION
  add constraint CAMION_CHK01
  check ((NBCAISSEMAX >0));

prompt
prompt Creating table REGION
prompt =====================
prompt
create table REGION
(
  noregion  NUMBER not null,
  nomregion VARCHAR2(20) not null
)
;
alter table REGION
  add constraint REGION_PK primary key (NOREGION);

prompt
prompt Creating table USAGER
prompt =====================
prompt
create table USAGER
(
  nousager    NUMBER        NOT NULL,
  username    VARCHAR2(50) NOT NULL,
  password    VARCHAR2(50) NOT NULL,
  type        VARCHAR2(50)   NOT NULL,
  description VARCHAR2(50)
)
;
alter table USAGER
  add constraint USAGER_PK primary key (NOUSAGER);

prompt
prompt Creating table CLIENT
prompt =====================
prompt
create table CLIENT
(
  noclient  NUMBER 		not null,
  nomclient VARCHAR2(50)	not null,
  adresse   VARCHAR2(50)	not null,
  telephone VARCHAR2(15)        not null,
  courriel  VARCHAR2(60),
  noregion  NUMBER		not null,
  confirm   CHAR(1),
  nousager  NUMBER,
  ville     VARCHAR2(20)	not null
)
;
alter table CLIENT
  add constraint CLIENT_PK primary key (NOCLIENT);
alter table CLIENT
  add constraint CLIENT_FK01 foreign key (NOREGION)
  references REGION (NOREGION);
alter table CLIENT
  add constraint CLIENT_FK02 foreign key (NOUSAGER)
  references USAGER (NOUSAGER);
alter table CLIENT
  add constraint CLIENT_PK2 UNIQUE(telephone);


prompt
prompt Creating table COMMANDE
prompt =======================
prompt
create table COMMANDE
(
  nocommande   NUMBER not null,
  noclient     NUMBER not null,
  datecommande DATE   not null,
  confirm      CHAR(1)
)
;
alter table COMMANDE
  add constraint COMMANDE_PK primary key (NOCOMMANDE);
alter table COMMANDE
  add constraint COMMANDE_FK01 foreign key (NOCLIENT)
  references CLIENT (NOCLIENT);

prompt
prompt Creating table PRODUIT
prompt ======================
prompt
create table PRODUIT
(
  noproduit       NUMBER not null,
  description     VARCHAR2(50)  not null,
  prix    	  DECIMAL(10,2)	 NOT NULL,
  quantiteenstock NUMBER
       CHECK (quantiteenstock >= 0),
  fournisseur     VARCHAR2(30),
  alcool          VARCHAR2(50),
  emballage       NUMBER not null
)
;
alter table PRODUIT
  add constraint PRODUIT_PK primary key (NOPRODUIT);

prompt
prompt Creating table COMMANDEDETAIL
prompt =============================
prompt
create table COMMANDEDETAIL
(
  noligne    NUMBER,
  nocommande NUMBER not null,
  noproduit  NUMBER not null,
  quantite   NUMBER NOT NULL
      CHECK (quantite > 0)
)
;
alter table COMMANDEDETAIL
  add constraint COMMANDEDETAIL_FK01 foreign key (NOCOMMANDE)
  references COMMANDE (NOCOMMANDE);
alter table COMMANDEDETAIL
  add constraint COMMANDEDETAIL_FK02 foreign key (NOPRODUIT)
  references PRODUIT (NOPRODUIT);
alter table COMMANDEDETAIL
  add constraint COMMANDEDETAIL_PK primary key (NOCOMMANDE, NOPRODUIT);

prompt
prompt Creating table LIVRAISON
prompt ========================
prompt
create table LIVRAISON
(
  nolivraison   NUMBER not null,
  datelivraison DATE   not null,
  nocamion      NUMBER not null
)
;
alter table LIVRAISON
  add constraint LIVRAISON_PK primary key (NOLIVRAISON);
alter table LIVRAISON
  add constraint LIVRAISON_FK01 foreign key (NOCAMION)
  references CAMION (NOCAMION);

prompt
prompt Creating table LIVRAISONDETAIL
prompt ==============================
prompt
create table LIVRAISONDETAIL
(
  noligne     NUMBER,
  nolivraison NUMBER    NOT NULL,
  nocommande  NUMBER    NOT NULL,
  noproduit   NUMBER    NOT NULL,
  qtlivree    NUMBER    NOT NULL
       CHECK (qtLivree > 0),
  CONSTRAINT pk_LivraisonDetail PRIMARY KEY (nolivraison, nocommande, noproduit)
)
;
alter table LIVRAISONDETAIL
  add constraint LIVRAISONDETAIL_FK01 foreign key (NOLIVRAISON)
  references LIVRAISON (NOLIVRAISON);
alter table LIVRAISONDETAIL
  add constraint LIVRAISONDETAIL_FK02 foreign key (NOCOMMANDE)
  references COMMANDE (NOCOMMANDE);
alter table LIVRAISONDETAIL
  add constraint LIVRAISONDETAIL_FK03 foreign key (NOPRODUIT)
  references PRODUIT (NOPRODUIT);

prompt
prompt Creating table ROLE
prompt ===================
prompt
create table ROLE
(
  norole   NUMBER not null,
  nomrole  VARCHAR2(50),
  menuitem VARCHAR2(50)
)
;
alter table ROLE
  add constraint ROLE_PK primary key (NOROLE);


SET	ECHO OFF
SPOOL	OFF
