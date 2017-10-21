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
  to_char(Agenda.dtinicio,'dd/mm/yy DY')                as dtInicioEx,
  to_char(Agenda.dttermino,'dd/mm/yy DY')                as dtTerminoEx,
  Ciclo_gsRecognize(Agenda.Ciclo_Id)         as Ciclo,
  WPessoa_gsNomeUs(agenda.WPessoa_Id)            as WPessoa,
  WPessoa_gsNomeUs(WPessoa_Resp_Id)       as WPessoa_Resp,
  WPessoa_gsNomeUs(WPessoa_UltAlt_Id)     as WPessoa_UltAlt,
  to_char(DtInicio, 'YYYYMMDD')           as DATACALC
from
  Agenda
where
  ( Agenda.Campus_Destino_Id = p_Campus_Destino_Id or Agenda.Campus_Destino_Id is null )
and
  realizado = 'on'
and
 ativo = 'on'
and
 ( agenda.campus_id = p_Campus_Id or p_Campus_Id is null )
and
 depart_id = p_Depart_Id
and
 ( lower(descricao) like p_Descricao or p_Descricao is null )
and
 ( ( trunc(dtinicio) between p_dtinicio1 and p_dtinicio2 ) or ( p_dtinicio1 is null and p_dtinicio2 is null ) )
and
 ( ( trunc(nvl(dttermino,dtinicio)) between p_dtfim1 and p_dtfim2 ) or ( p_dtfim1 is null and p_dtfim2 is null ) )
and
 ( agenda.WPessoa_Id = p_WPessoa_Cri_Id or p_WPessoa_Cri_Id is null )
and
 ( WPessoa_Resp_Id = p_WPessoa_Resp_Id or p_WPessoa_Resp_Id is null )
and
 ( agendaass_id = p_AgendaAss_Id or p_AgendaAss_Id is null )
and
 (
   ( trunc(DtInicio) >= trunc(sysdate-90) and ( p_dtinicio1 is null or p_dtfim1 is null ) ) 
  or
   ( p_dtinicio1 is not null or p_dtfim1 is not null )
 )
order by
  dtinicio desc, horainicio desc,
  dttermino desc, horatermino desc