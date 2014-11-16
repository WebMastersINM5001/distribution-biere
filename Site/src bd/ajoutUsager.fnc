create or replace function ajoutUsager
(
    p_nousager    in      USAGER.nousager %type
  , p_username    in      USAGER.username %type
  , p_password    in      USAGER.password %type
  , p_type        in      USAGER.type     %type        
  , p_description in      USAGER.description %type
) return varchar2
 is
   --
   v_nousager           USAGER.nousager %type := p_nousager;        
   -- 
 begin
   
   if p_nousager is null 
   then
     select USAGER_NO_SEQ.nextval into v_nousager from dual;
   end if; 
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
               v_nousager
             , p_username
             , p_password
             , p_type
             , p_description
             );
  --
  return('TRUE');
  --
exception
  when others then
    return sqlerrm;
end ajoutUsager;
/
