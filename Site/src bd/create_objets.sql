---------------------------------------------
-- Export file for user INM5001            --
-- Created by uacc on 06.10.2014, 19:59:16 --
---------------------------------------------

set define off
spool c:\distributionBiere.txt

drop table CLIENT CASCADE;
drop table COMMANDE CASCADE;
drop table REGION CASCADE;
drop table CAMION CASCADE;
drop table PRODUIT CASCADE;
drop table COMMANDEDETAIL CASCADE;
drop table LIVRAISON CASCADE;
drop table LIVRAISONDETAIL CASCADE;
drop table USAGER CASCADE;
drop table ROLE CASCADE;


prompt
prompt Creating table CAMION
prompt =====================
prompt
create table CAMION
(
  nocamion    NUMBER not null,
  nbcaissemax NUMBER,
  description VARCHAR2(500),
  disponible  VARCHAR2(1)
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
  nomregion VARCHAR2(500)
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
  nousager    NUMBER not null,
  usrname     VARCHAR2(500),
  password    VARCHAR2(150),
  type        VARCHAR2(2),
  description VARCHAR2(250)
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
  noclient  NUMBER not null,
  nomclient VARCHAR2(500),
  adresse   VARCHAR2(500),
  telephone VARCHAR2(50),
  courriel  VARCHAR2(250),
  noregion  NUMBER,
  confirm   VARCHAR2(1),
  nousager  NUMBER,
  ville     VARCHAR2(20)
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

prompt
prompt Creating table COMMANDE
prompt =======================
prompt
create table COMMANDE
(
  nocommande   NUMBER not null,
  noclient     NUMBER,
  datecommande DATE,
  confirm      VARCHAR2(1)
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
  description     VARCHAR2(500),
  prix            NUMBER,
  quantiteenstock NUMBER,
  furnisseur      VARCHAR2(25),
  alcool          VARCHAR2(50),
  emballage       NUMBER
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
  nocommande NUMBER,
  noproduit  NUMBER,
  quantite   NUMBER
)
;
alter table COMMANDEDETAIL
  add constraint COMMANDEDETAIL_FK01 foreign key (NOCOMMANDE)
  references COMMANDE (NOCOMMANDE);
alter table COMMANDEDETAIL
  add constraint COMMANDEDETAIL_FK02 foreign key (NOPRODUIT)
  references PRODUIT (NOPRODUIT);

prompt
prompt Creating table LIVRAISON
prompt ========================
prompt
create table LIVRAISON
(
  nolivraison   NUMBER not null,
  datelivraison DATE,
  nocamion      NUMBER
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
  nolivraison NUMBER,
  nocommande  NUMBER,
  noproduit   NUMBER,
  qtlivree    NUMBER
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
  nomrole  VARCHAR2(150),
  menuitem VARCHAR2(150)
)
;
alter table ROLE
  add constraint ROLE_PK primary key (NOROLE);


spool off
