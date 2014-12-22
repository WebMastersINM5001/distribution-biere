CREATE OR REPLACE VIEW VUE_LIVRAISON_NEXT_CAMION AS
with CAMION_DISP as
(select   TROUV_CAMION_DISP(l.nolivraison) nocamion
         ,l.NOLIVRAISON 
         ,l.DATELIVRAISON
  from  LIVRAISON l
 where verifier_camion_plein(l.nolivraison) != -1)
 select  d.NOLIVRAISON 
        ,d.DATELIVRAISON
        ,c.NOCAMION
        ,c.DESCRIPTION
        ,c.NBCAISSEMAX
        ,c.DISPONIBLE
   from CAMION_DISP d
      , CAMION      c
    where d.nocamion = c.NOCAMION    ;
