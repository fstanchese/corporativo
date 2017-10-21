select
  count(*) as rematriculado
from
  Matric
where
(
  trunc(rematricula) <= trunc(sysdate)
  and
  p_O_Data is null
  or
  trunc(rematricula) <= p_O_Data
)
and
  id = nvl( p_Matric_Id ,0)
