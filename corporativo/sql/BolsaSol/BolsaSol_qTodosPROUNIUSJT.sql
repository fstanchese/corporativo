select
  WPessoa.Nome                            as WPessoa_Nome,
  WPessoa.codigo                          as WPessoa_Codigo,
  Curr.CurrNomeVest                       as Curso_Nome,
  Periodo_gsRecognize(CurrOfe.Periodo_Id) as Periodo_Nome,
  Campus_gsRecognize(CurrOfe.Campus_Id)   as Campus_Nome
from
  BolsaSol,
  WPessoa,
  CurrOfe,
  Curr
where
  CurrOfe.Curr_Id = Curr.Id
and
  BolsaSol.CurrOfe_Id = CurrOfe.Id
and
  BolsaSol.WPessoa_Id = WPessoa.Id
and
  (
    CurrOfe.Id = p_CurrOfe_Id
  or
    p_CurrOfe_Id is null
  )
and
  (
    CurrOfe.Periodo_Id = p_Periodo_Id
  or
    p_Periodo_Id is null
  )
and
  (
    CurrOfe.Campus_Id = p_Campus_Id
  or
    p_Campus_Id is null
  )
and
  BolsaSol.State_Id = p_State_Id 
and
  BolsaSol.CESJProcSel_Id = p_CESJProcSel_Id 
order by 
  CurrOfe.Campus_Id, Curr.CurrNomeVest, CurrOfe.Periodo_Id, CurrOfe.Campus_Id, WPessoa.Nome
