set echo on

create or replace package fetchperfpkg as
  type arrtype is table of varchar2(20) index by pls_integer;
  procedure selbulk(p1 out arrtype);
end fetchperfpkg;
/

create or replace package body fetchperfpkg as
  procedure selbulk(p1 out arrtype) is
  begin
   select  mycol bulk collect
     into  p1
     from  bigtab
     where rownum < 100;
  end selbulk;
end fetchperfpkg;
/

show errors
exit
