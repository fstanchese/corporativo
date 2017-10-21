
select
  Curr.id,
  Curr_gsRecognize(Id) as Recognize
from
  Curr
where
  Curr_Pai_Id = nvl( p_Curr_Id ,0)
order by
  2
