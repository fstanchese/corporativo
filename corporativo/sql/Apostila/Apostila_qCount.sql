select sum(total) as total from
(
select
  count(*) as total
from
  Apostila
where
  Apostila.DiplProc_Id = nvl ( p_DiplProc_Id ,0)
union all
select
  count(*) as total
from
  Apostila
where
  curr_02_id is not null
and
  Apostila.DiplProc_Id = nvl ( p_DiplProc_Id ,0)
)