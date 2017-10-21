select 
  Sala.*,
  Campus_gsRecognize(Sala.Campus_Id) as Campus,
  Bloco_gsRecognize(Sala.Bloco_Id)   as Bloco,
  Andar_gsRecognize(Sala.Andar_Id)   as Andar,
  SalaTi_gsRecognize(Sala.SalaTi_Id) as Tipo,
  SalaTi.Nome as Tipo_Sala
from 
  Sala,
  SalaTi
where
  Sala.SalaTi_Id = SalaTi.Id
and
  (
    p_SalaTi_Id is null
  or
    SalaTi.Id = nvl ( p_SalaTi_Id , 0 )
  )
and
  Sala.Campus_Id = nvl( p_Campus_Id ,0)
and
  SalaTi.SalaTi_Pai_Id in (142500000000024,142500000000026)
order by 
  Sala.SalaTi_Id,Sala.Codigo