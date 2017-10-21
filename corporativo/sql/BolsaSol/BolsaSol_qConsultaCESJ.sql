select
  BolsaSol.*
from
  BolsaSol
where
  BolsaSol.CESJProcSel_Id in (120700000000042)
and
  BolsaSol.FIESTi_Id = 117200000000002
and
  BolsaSol.PLetivo_Id in (7200000000081)
and
  BolsaSol.WPessoa_Id = nvl( p_WPessoa_Id ,0)
order by 
  State_Id desc