select
  distinct Andar.Id as Id,
  Andar.Nome,
  concat('Andar ', Andar_gsRecognize(Andar.Id)) as Recognize
from
  Andar,
  Sala
where
  Sala.Campus_Id = $v_Campus_Id
and
  Andar.Id = Sala.Andar_Id
order by 
  Andar.Nome