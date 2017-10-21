select
  Count(DivDisc.Id) as Total,
  DivDisc.TOXCD_Id,
  DivDisc.AulaTi_Id
from
  DivDisc
where
  DivDisc.TOXCD_Id = nvl( p_TOXCD_Id ,0)
and
  DivDisc.AulaTi_Id = nvl( p_AulaTi_Id ,0)
group by toxcd_id,aulati_id
