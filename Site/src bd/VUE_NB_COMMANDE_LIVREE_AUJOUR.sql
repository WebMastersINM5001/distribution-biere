CREATE OR REPLACE VIEW VUE_NB_COMMANDE_LIVREE_AUJOUR AS
SELECT COUNT(distinct nocommande)AS NB_COMMANDE
FROM  VUE_PAGE_LIVREUR t
WHERE upper(CONFIRM) = 'Y'
  and trunc(t.DATECOMMANDE) = trunc(sysdate);
