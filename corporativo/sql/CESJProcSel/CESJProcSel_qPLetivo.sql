select
  id,
  nome as Recognize 
from
  CESJProcSel
where
  PLetivo_Id = p_PLetivo_Id
order by
  Nome
