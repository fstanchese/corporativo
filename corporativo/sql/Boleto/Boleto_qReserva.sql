select
  Boleto.*,
  Boleto.Id+23476892634986 as ENCID,
  Curr.CurrNomeVest,
  Matric.Id                as Matric_Id,
  CurrOfe.Id               as CurrOfe_Id,
  Periodo_gsRecognize(CurrOfe.Periodo_Id) as Periodo,
  Campus_gsRecognize(CurrOfe.Campus_Id)   as Unidade
from
  Boleto,
  DebCred,
  Matric,
  TurmaOfe,
  CurrOfe,
  Curr
where
  CurrOfe.Curr_Id = Curr.Id
and
  TurmaOfe.CurrOfe_Id = CurrOfe.Id
and
  Matric.TurmaOfe_Id = TurmaOfe.Id
and
  DebCred.Matric_Origem_Id = Matric.Id
and
  DebCred.Boleto_Destino_Id = Boleto.Id
and
  to_date(Boleto.DtVencto) >= to_date(sysdate)
and
  Boleto.State_Base_Id = 3000000000006
and
  Boleto.BoletoTi_Id = 92200000000008
and
  Boleto.WPessoa_Sacado_Id = nvl( p_WPessoa_Id ,0)
order by
  Boleto.Referencia