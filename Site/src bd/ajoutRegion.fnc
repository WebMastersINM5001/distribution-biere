create or replace function ajoutRegion
(
    p_noregion     in      REGION.noregion     %type
  , p_nomregion    in      REGION.nomregion    %type
) return varchar2
 is
   --
   v_noregion           REGION.noregion %type := p_noregion;        
   -- 
 begin
   
   if v_noregion is null 
   then
     select max(noregion)+1 into v_noregion from REGION;
   end if; 
    --
   insert into REGION
      ( 
         noregion
       , nomregion
     ) values 
             (
               v_noregion
             , upper(p_nomregion)
             );
  --
  return('TRUE');
  --
exception
  when others then
    return sqlerrm;
end ajoutRegion;
/
