create or replace function setDispCamion
(
     p_nocamion      in  CAMION.nocamion %type      
   , p_disponible    in  CAMION.disponible %type
) return varchar2
 is
   --
  begin
   
   if p_nocamion is not null 
   then
     update CAMION c
        set c.DISPONIBLE = p_disponible
      where c.NOCAMION   =  p_nocamion;
   end if; 
  --
  return('TRUE');
  --
exception
  when others then
    return sqlerrm;
end setDispCamion;
/
