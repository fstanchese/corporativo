select
  Bairro.*,
  Bairro_gsRecognize(Id) as Bairro_Id_r
from
  Bairro
where
  Id = nvl ( p_Bairro_Id , 0 )