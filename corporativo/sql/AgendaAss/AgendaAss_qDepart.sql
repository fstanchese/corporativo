select
  AgendaAss.*,
  AgendaAss.Descricao as Recognize
from
  AgendaAss
where
  Depart_Id = p_Depart_Id
order by Descricao
