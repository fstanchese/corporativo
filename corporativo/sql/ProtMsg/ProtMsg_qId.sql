
select
  ProtMsg.*,
  ProtMsg.Protocolo as Recognize
from
  ProtMsg
where
  ProtMsg.Id = nvl( p_ProtMsg_Id ,0)
