select 
  Sala.*,
  sala_gsrecognize(Sala.Id) as Recognize,
  SalaTi_gsRecognize(Sala.SalaTi_Id) as Tipo,
  SalaTi.Nome as Tipo_Sala
from 
  Sala,
  SalaTi
where
  Sala.SalaTi_Id = SalaTi.Id
and
  ( 
     p_Campus_Id is null
     or
     Sala.Campus_Id = nvl ( p_Campus_Id , 0)
  )
and
  ( Sala.SalaTi_Id = p_SalaTi_Id or p_SalaTi_Id is null )
order by
  Sala.id
