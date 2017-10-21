select 
  DuracXCi.Sequencia as Id,
  DuracXCi.Sequencia||'a Série' as Recognize 
from
  DuracXCi,
  CurrXDisc,
  Curr
where
  DuracXCi.Id = CurrXDisc.DuracXCi_Id
and
  Curr.Id = CurrXDisc.Curr_Id 
and
  Curr.Id = nvl( p_Curr_Id ,0)
group by DuracXCi.Sequencia order by 2
