select
  Sala.*,
  Campus_gsRecognize(Campus_Id) as Campus_Recognize,
  SalaTi_gsRecognize(SalaTi_Id) as SalaTi_Recognize
from
  Sala
where
  Sala.Codigo = upper( p_Sala_Codigo )
order by
  Campus_Id
