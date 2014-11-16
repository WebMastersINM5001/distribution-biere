create or replace function ajoutClient
(
    p_noclient       in   CLIENT.noclient %type
  , p_nomclient      in   CLIENT.nomclient %type
  , p_adresse        in   CLIENT.adresse   %type
  , p_telephone      in   CLIENT.telephone %type
  , p_courriel       in   CLIENT.courriel %type
  , p_noregion       in   CLIENT.noregion %type
  , p_nousager       in   CLIENT.nousager %type
  , p_ville          in   CLIENT.ville    %type
 ) return varchar2
 is
   --
   v_noclient           CLIENT.noclient %type := p_noclient;        
   -- 
 begin
   
   if v_noclient is null 
   then
     select CLIENT_NO_SEQ.nextval into v_noclient from dual;
    end if; 
    --
    insert into CLIENT
      (
       NOCLIENT
      ,NOMCLIENT
      ,ADRESSE
      ,TELEPHONE
      ,COURRIEL
      ,NOREGION
      ,CONFIRM
      ,NOUSAGER
      ,VILLE
      )
      values
            (
             v_noclient
            ,p_nomclient
            ,p_adresse
            ,p_telephone
            ,p_courriel
            ,p_noregion
            ,'Y'
            ,p_nousager
            ,p_ville
            );
  --
  return('TRUE');
  --
exception
  when others then
    return sqlerrm;
end ajoutClient;
/
