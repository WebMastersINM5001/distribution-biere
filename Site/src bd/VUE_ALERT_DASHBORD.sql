create or replace view vue_alert_dashbord as
select 'Commande(s) en cours'           TXT
      ,t.NB_COMMANDE_EN_COURS         NB
      ,'info'                         TYPE
from VUE_NB_COMMANDE_EN_COURS t
union all
select 'Commande(s) non livrée(s)'   TXT
      ,t.NB_COMMANDE_EN_COURS        NB
      ,'warning'                     TYPE
 from VUE_NB_COMMANDE_NON_LIVRER t
union all
select 'Commande(s) livrée(s)'       TXT
      ,t.NB_COMMANDE        NB
      ,'succes'                      TYPE
 from VUE_NB_COMMANDE_LIVREE_AUJOUR t
union all
select 'Client(s) non confirmé(s)'       TXT
      ,t.DEMANDE_CONFIRMATION         NB
      , 'danger'                      TYPE
 from VUE_NB_CLIENT_NON_CONFIRMER t
union all
select 'Client(s) non livré(s)'           TXT
      ,count(distinct t.NOCLIENT)     NB
      ,'warning'                         TYPE
 from  VUE_CLIENT_NON_LIVRER t
union all
select 'stock(s) de produit en bas'  TXT
      ,count(distinct t.NOPRODUIT)    NB
      ,'warning'                      TYPE
from VUE_STOCK_BAS t
;
