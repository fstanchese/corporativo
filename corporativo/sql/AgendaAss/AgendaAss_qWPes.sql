select
  AgendaAss.*,
  AgendaAss.Descricao as Recognize
from
  AgendaAss
where depart_id in ( select depart_id from wpesxdepart where wpessoa_id = $_SESSION[p_WPessoa_Id] and id = p_WPesXDepart_Id and (sysdate between DtInicio and nvl(DtTermino,sysdate) or DtInicio is null ) )
order by recognize