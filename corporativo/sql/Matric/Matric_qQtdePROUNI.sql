select
  Count(Matric.Id)     as Qtde 
from
  Bolsa,
  Curr,
  CurrOfe,
  TurmaOfe,
  Matric,
  VestCla
where
  Bolsa.State_Id in (3000000018001,3000000018003)
and
  Bolsa.DtInicio = '01/01/2008' 
and
  Bolsa.BolsaTi_Id = 10600000000049
and
  Bolsa.WPessoa_Id = VestCla.WPessoa_Id
and
  Curr.Curso_Id = nvl( p_Curso_Id ,0)
and
  Curr.Id = CurrOfe.Curr_Id
and
  CurrOfe.Periodo_Id = nvl( p_Periodo_Id ,0)
and
  CurrOfe.Campus_Id = nvl( p_Campus_Id ,0)
and
  CurrOfe.Pletivo_Id = nvl( p_PLetivo_Id ,0)
and
  Currofe.Id = Turmaofe.CurrOfe_Id 
and 
  TurmaOfe.Id = Matric.TurmaOfe_Id
and
  Matric.MatricTi_Id = 8300000000001
and
  Matric.State_Id = 3000000002002
and
  Matric.WPessoa_Id = VestCla.WPessoa_Id
and
  VestCla.VestChama_Id = nvl( p_VestChama_Id ,0)