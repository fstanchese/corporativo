select
  WPessoa.Nome                                                  as Nome,
  WPessoa.RGRNE                                                 as RGRNE,
  Boleto.*,
  boleto_gnState(Boleto.Id,trunc(sysdate),'CONSIDERAR_QUITADO') as SITUACAO,
  Curr.CurrNomeVest||'&nbsp;-&nbsp;'||Periodo.Nome              as Curso,
  Campus.Nome                                                   as Campus,
  Matric.State_Id                                               as Matric_State_Id
from
  WPessoa,
  Curr,
  Campus,
  Periodo,
  CurrOfe,
  TurmaOfe,
  Matric,
  DebCred,
  Boleto
where
  WPessoa.Id = Boleto.WPessoa_Sacado_Id
and
  Curr.Id = CurrOfe.Curr_Id
and
  Campus.Id = CurrOfe.Campus_Id
and
  Periodo.Id = CurrOfe.Periodo_Id
and
  CurrOfe.Id = TurmaOfe.CurrOfe_Id
and
  TurmaOfe.Id = Matric.TurmaOfe_Id
and
  Matric.Id = DebCred.Matric_Origem_Id
and
  DebCred.Boleto_Destino_Id = Boleto.Id
and
  trunc(Boleto.Dt) > '01/09/2013'
and
  (
    p_State_Id is null
  or
    Boleto_gnState(Boleto.Id) = nvl( p_State_Id ,0) 
  )
and
  Boleto.BoletoTi_Id = 92200000000008
and
  Boleto.WPessoa_Sacado_Id = nvl( p_WPessoa_Id ,0)
order by
 Boleto.State_Base_Id,Boleto.Dt desc