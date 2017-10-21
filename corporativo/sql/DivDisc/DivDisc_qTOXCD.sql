select
  DivDisc.Id as Id,
  DivDisc.Nome as Recognize
from
  DivDisc
where
  DivDisc.TOXCD_Id = nvl( p_TOXCD_Id ,0)
and
  DivDisc.AulaTi_Id = nvl( p_AulaTi_Id ,0)
order by 2
