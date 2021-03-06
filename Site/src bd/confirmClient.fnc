create or replace function confirmClient
(
    p_noclient    in      CLIENT.noclient %type
) return varchar2
 is
   --
  begin
   
   if p_noclient is not null 
   then
     update CLIENT c
        set c.CONFIRM = 'Y'
      where c.noclient =  p_noclient;
   end if; 
  --
  return('TRUE');
  --
exception
  when others then
    return sqlerrm;
end confirmClient;
/
