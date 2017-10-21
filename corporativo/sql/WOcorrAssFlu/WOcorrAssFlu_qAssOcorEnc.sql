select
  Id,
  Sequencia,
  Depart_Id,
  State_Id,
  State_gsRecognize(state_id) as SITUACAO,
  WOcorrAssFlu_gsRecognize(id) as Recognize,
  Depart_gsRecognize(depart_id) as DEPARTAMENTO
from
  WOcorrAssFlu
where 
  WOcorrAssFlu.Depart_Id <> nvl( p_Depart_Id ,0)
and
  WOcorrAssFlu.WOcorrAss_Id = nvl( p_WOcorrAss_Id ,0)
order by
  Sequencia
