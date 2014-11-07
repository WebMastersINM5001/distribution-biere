column username format a30
column logon_time format a18
set pagesize 1000 feedback off echo on

select username, to_char(logon_time, 'DD-MON-YY HH:MI:SS') logon_time
from v$session
where username is not null;

exit
