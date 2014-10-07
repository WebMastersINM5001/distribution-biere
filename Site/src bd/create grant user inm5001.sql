create tablespace inm5001_tabspace datafile 'inm5001_tabspace.dat' size 10M autoextend on;
create temporary tablespace inm5001_tabspace_temp  tempfile 'inm5001_tabspace_temp.dat'  size 5M autoextend on;

create user inm5001 identified by inm5001 default tablespace inm5001_tabspace temporary tablespace inm5001_tabspace_temp;

grant create session to inm5001;
grant create table to inm5001;
grant unlimited tablespace to inm5001;
grant select on sys.DBA_ARGUMENTS to inm5001;
grant select on sys.DBA_CONSTRAINTS to inm5001;
grant select on sys.DBA_CONS_COLUMNS to inm5001;
grant select on sys.DBA_MINING_MODELS to inm5001;
grant select on sys.DBA_MINING_MODEL_ATTRIBUTES to inm5001;
grant select on sys.DBA_PROCEDURES to inm5001;
grant select on sys.DBA_TAB_COLUMNS to inm5001;
grant select on sys.DBA_VIEWS to inm5001;
grant execute on sys.DBMS_CRYPTO to inm5001;
grant execute on sys.DBMS_STATS to inm5001;
grant execute on sys.DBMS_UTILITY to inm5001 with grant option;
grant select on sys.USER_CONSTRAINTS to inm5001;
grant select on sys.USER_CONS_COLUMNS to inm5001;
grant select on sys.V_$LOCK to inm5001;
grant select on sys.V_$SESSION to inm5001;
grant execute, read, write on directory sys.XMLDIR to inm5001 with grant option;
-- Grant/Revoke role privileges 
grant connect to inm5001;
grant dba to inm5001;
grant resource to inm5001;
-- Grant/Revoke system privileges 
grant alter any table to inm5001;
grant alter session to inm5001;
grant analyze any to inm5001;
grant comment any table to inm5001;
grant create any index to inm5001;
grant create any job to inm5001;
grant create any table to inm5001;
grant create mining model to inm5001;
grant create session to inm5001;
grant create table to inm5001;
grant delete any table to inm5001;
grant drop any table to inm5001;
grant insert any table to inm5001;
grant select any mining model to inm5001;
grant select any table to inm5001;
grant unlimited tablespace to inm5001;
grant update any table to inm5001;
