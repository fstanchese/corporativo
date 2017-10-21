select
  BolsaSol.PercBolsa,
  VestOpcao.CurrOfe_Id,
  CurrOfe.Campus_Id,
  CurrOfe.Periodo_Id,
  Curso.NomeRed,
  Campus_gsRecognize(CurrOfe.Campus_Id)                as Campus_Recognize,
  Periodo_gsRecognize(CurrOfe.Periodo_Id)              as Periodo_Recognize,
  Curso.Id || CurrOfe.Periodo_Id || CurrOfe.Campus_Id  as Chave
from 
  BolsaSol,
  WPessoa,
  Vest,
  VestOpcao,
  CurrOfe,
  Curr,
  Curso
where 
  Curr.Curso_Id = Curso.Id
and
  CurrOfe.Curr_Id = Curr.Id
and
  (
    CurrOfe.Campus_Id = p_Campus_Id
  or
    p_Campus_Id is null 
  )
and
  VestOpcao.CurrOfe_Id = CurrOfe.Id 
and
  VestOpcao.Sequencia = 1
and
  Vest.Id = VestOpcao.Vest_Id 
and
  Vest.Id = (select max(id) from Vest where WPessoa_Id = BolsaSol.WPessoa_Id)
and
  BolsaSol.WPessoa_Id = WPessoa.Id
and
  BolsaSol.State_Id = p_State_Id 
and
  BolsaSol.CESJProcSel_Id = p_CESJProcSel_Id 
order by Curso.NomeRed
