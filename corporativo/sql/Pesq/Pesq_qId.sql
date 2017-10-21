select
  Pesq.*,
  Pesq.Complemento || decode(Pesq.curso_id,null,'',' - '||curso_gsretnome(pesq.curso_Id)) as recognize
from
  Pesq
where
  Pesq.Id = nvl ( p_Pesq_Id , 0 )