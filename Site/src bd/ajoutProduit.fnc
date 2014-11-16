create or replace function ajoutProduit
(
    p_noproduit            in   PRODUIT.noproduit %type
  , p_description          in   PRODUIT.description %type
  , p_prix                 in   PRODUIT.prix %type
  , p_quantiteenstock      in   PRODUIT.quantiteenstock %type
  , p_fournisseur          in   PRODUIT.fournisseur%type
  , p_alcool               in   PRODUIT.alcool  %type
  , p_emballage            in   PRODUIT.emballage%type
) return varchar2
 is
 --
 v_noproduit           PRODUIT.noproduit %type := p_noproduit;        
 -- 
 begin
   
   if v_noproduit is null 
   then
     select USAGER_NO_SEQ.nextval into v_noproduit from dual;
    end if; 
    
    insert into PRODUIT
      (
       NOPRODUIT
      ,DESCRIPTION
      ,PRIX
      ,QUANTITEENSTOCK
      ,FOURNISSEUR
      ,ALCOOL
      ,EMBALLAGE
      )
       values
      (
       v_noproduit
      ,p_description
      ,p_prix
      ,p_quantiteenstock
      ,p_fournisseur
      ,p_alcool
      ,p_emballage
      );
  return('TRUE');
exception
  when others then
    return sqlerrm;
end ajoutProduit;
/
