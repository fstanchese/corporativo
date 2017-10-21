select
  Matric.id 
from
  Matric,
  TurmaOfe,
  CurrOfe 
where
  CurrOfe.PLetivo_Id = 7200000000092 
and
  TurmaOfe.CurrOfe_Id = CurrOfe.Id 
and
  Matric.TurmaOfe_Id = TurmaOfe.Id 
and
  Matric.MatricTi_Id = 8300000000001 
and
  Matric.State_Id in (3000000002001,3000000002002) 
and
  Matric.WPessoa_Id = p_WPessoa_Id 
