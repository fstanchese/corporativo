
select 
  Curso.*,
  Curso_gsRecognize(Id)           as Recognize, 
  InstEns_gsRecognize(InstEns_Id) as InstEns_Recognize 
from
  Curso 
order by
  Nome 
