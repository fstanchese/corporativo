(
select * from 
  (
  select
    old  as VALUE,
    dt   as DT
  from
    MatricHi
  where 
    col = p_O_Col
  and
    Matric_Id = nvl( p_Matric_Id ,0)
  order by dt
  )
  where
  rownum = 1
)
union
(
select
  new as VALUE,
  dt  as DT
from
  MatricHi
where
  trunc(dt) <= p_O_Dt
and
  col = p_O_Col
and
  Matric_Id = nvl( p_Matric_Id ,0)
)
order by 2 desc
