select
  Agenda.Id,
  nvl ( Agenda.CAMPUS_ID , 0 ) as CAMPUS_ID,
  Agenda.DEPART_ID,
  Agenda.DTINICIO,
  Agenda.DTTERMINO,
  Agenda.AGENDAASS_ID,
  Agenda.DESCRICAO,
  Agenda.CICLO_ID,
  Agenda.REALIZADO,
  Agenda.HORAINICIO,
  Agenda.HORATERMINO,
  Agenda.WPESSOA_RESP_ID,
  Agenda.WPESSOA_ULTALT_ID,
  Agenda.WPESSOA_ID,
  Agenda.ATIVO,
  AgendaAss_gsRecognize(Agenda.AgendaAss_Id) as AgendaAss,
  Ciclo_gsRecognize(Agenda.Ciclo_Id)         as Ciclo,
  upper(WPessoa_gsNomeUs(agenda.WPessoa_Id))        as WPessoa,
  shortname(WPessoa_gsRecognize(WPessoa_Resp_Id))       as WPessoa_Resp,
  upper(WPessoa_gsNomeUs(WPessoa_UltAlt_Id)) as WPessoa_UltAlt
from
  Agenda
where
  Depart_Id = p_Depart_Id
and
  ( agenda.WPessoa_Id = p_Agenda_WPessoa_Usuario or p_Agenda_WPessoa_Usuario is null )
and
  ( ( trunc(DtInicio) between p_O_Data1 and p_O_Data2 ) or ( p_O_Data1 is null ) )
and
  ( ( trunc(nvl(DtTermino,DtInicio)) between p_O_Data3 and p_O_Data4 ) or ( p_O_Data3 is null ) )
and
  ( AgendaAss_Id = p_Agenda_AgendaAss_Id or p_Agenda_AgendaAss_Id is null )
and
  ( Realizado = p_Agenda_Realizado or p_Agenda_Realizado is null )
and 
  Agenda.Campus_Destino_Id = $_SESSION[campus_id]
and
  (
    ( rownum <= 15 and p_O_Data1 is null and p_O_Data3 is null )
  or
    ( p_O_Data1 is not null or p_O_Data3 is not null )
  )
order by Id desc