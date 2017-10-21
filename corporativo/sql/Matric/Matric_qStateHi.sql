select
  trunc(MatricHi.dt) || ' - ' || MatricHi.us || ' - ' || State_gsRecognize(MatricHi.old) || ' -> ' || State_gsRecognize(MatricHi.new) as Recognize,
  MatricHi.dt  as Data,
  MatricHi.us  as Usuario,
  MatricHi.old as Anterior,
  MatricHi.new as Atual,
  MatricHi.Matric_Id as Id
from
  MatricHi
where
  Upper(MatricHi.col) = 'STATE_ID'
and
  MatricHi.Old is not null
and
  MatricHi.Matric_Id = nvl( p_Matric_Id ,0)
order by MatricHi.dt