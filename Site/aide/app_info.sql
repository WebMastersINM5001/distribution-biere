col sql_text format a20
col module format a10
col action format a20

select sql_text, module, action
from v$sqlarea
where module = 'Home Page';

exit
