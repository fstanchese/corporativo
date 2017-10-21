
select
  ProtMsg.*,
  SubStr(Protocolo,1,100) || '...' as Recognize
from
  ProtMsg
order by
  Protocolo