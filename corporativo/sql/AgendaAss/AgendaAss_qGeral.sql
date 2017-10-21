select
  AgendaAss.*,
  AgendaAss.Descricao as Recognize
from
  AgendaAss
where depart_id = p_Depart_Id
order by recognize