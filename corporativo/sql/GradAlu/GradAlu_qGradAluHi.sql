select
  Dt,
  Col,
  Old,
  New
from
  GradAluHi
where
  (
    New = p_O_Texto
  or 
    p_O_Texto is null
  )
and
  GradAlu_Id = nvl ( p_GradAlu_Id , 0 ) 
order by dt desc
