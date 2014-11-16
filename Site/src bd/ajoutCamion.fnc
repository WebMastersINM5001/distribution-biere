create or replace function ajoutCamion
(
    p_nocamion     in      CAMION.nocamion     %type
  , p_nbcaissemax  in      CAMION.nbcaissemax  %type
  , p_description  in      CAMION.description  %type
) return varchar2
 is
   --
   v_nocamion           CAMION.nocamion %type := p_nocamion;        
   -- 
 begin
   
   if p_nocamion is null 
   then
     select CAMION_NO_SEQ.nextval into v_nocamion from dual;
   end if; 
    --
   insert into CAMION
      ( 
         NOCAMION
       , NBCAISSEMAX
       , DESCRIPTION
       , DISPONIBLE
     ) values 
             (
               v_nocamion
             , p_nbcaissemax
             , p_description
             , 'Y'
             );
  --
  return('TRUE');
  --
exception
  when others then
    return sqlerrm;
end ajoutCamion;
/
