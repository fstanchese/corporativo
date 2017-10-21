select
  CESJProcSel.*,
  CESJProcSel.Nome as Recognize
from
  CESJProcSel
where
  bolsaincentivo is not null
order by nome desc
