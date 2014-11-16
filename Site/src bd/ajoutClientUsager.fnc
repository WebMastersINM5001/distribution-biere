create or replace function ajoutClientUsager
(
    p_nousager    in out  USAGER.nousager %type
  , p_noclient    in out  CLIENT.noclient %type
  , p_username    in      USAGER.username %type
  , p_password    in      USAGER.password %type
  , p_nomclient   in      CLIENT.nomclient%type
  , p_adresse     in      CLIENT.adresse  %type
  , p_telephone   in      CLIENT.telephone%type
  , p_courriel    in      CLIENT.courriel %type
  , p_noregion    in      CLIENT.noregion %type
  , p_ville       in      CLIENT.ville    %type

) return varchar2
 is
 --
 v_type           USAGER.type %type;        
 v_description    USAGER.description %type;
 -- 
 begin
   v_type := 'client';
	 v_description := p_nomclient||' '||p_username;
   
   if p_nousager is null 
   then
     select USAGER_NO_SEQ.nextval into p_nousager from dual;
     -- 
     insert into USAGER
      ( 
         NOUSAGER
       , USERNAME
       , PASSWORD
       , TYPE
       , DESCRIPTION
     ) values 
             (
               p_nousager
             , p_username
             , p_password
             , v_type
             , v_description
             );
    else
      --
      update USAGER
         set USERNAME    = p_username
           , PASSWORD    = p_password
           , TYPE        = v_type
           , DESCRIPTION = v_description
       where NOUSAGER = p_nousager;
    end if;  
    
   -- ajouter dans CLIENT
   if p_noclient is null 
   then
     select CLIENT_NO_SEQ.nextval into p_noclient from dual;
     -- 
     insert into CLIENT
      (
         NOCLIENT
       , NOMCLIENT
       , ADRESSE
       , TELEPHONE
       , COURRIEL
       , NOREGION
       , CONFIRM
       , NOUSAGER
       , VILLE
     ) values 
             (
               p_noclient
             , p_nomclient
             , p_adresse
             , p_telephone
             , p_courriel
             , p_noregion
             , 'N'
             , p_nousager
             , p_ville
             );
    else
      --
      update CLIENT
         set NOCLIENT   = p_noclient
           , NOMCLIENT  = p_nomclient
           , ADRESSE    = p_adresse
           , TELEPHONE  = p_telephone
           , COURRIEL   = p_courriel
           , NOREGION   = p_noregion
           , NOUSAGER   = p_nousager
           , VILLE      = p_ville
           
       where NOCLIENT = p_noclient;
    end if;  
           
  return('TRUE');
exception
  when others then
    return sqlerrm;
end ;
/
