select
  Id,
  State_Id
from
  BolsaSol
where
  BolsaSol.CESJProcSel_Id = p_CESJProcSel_Id
and
  BolsaSol.WPessoa_Id = nvl( p_WPessoa_Id , 0)
order by
  State_Id desc