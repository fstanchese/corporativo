
select 
  Id,
  Codigo,
  Nome,
  InstEns_Id,
  Curso_gsRecognize(Id) as Recognize,
  Facul_Id
from 
  Curso
where 
  provao ='on'
and
  CursoNivel_Id = p_CursoNivel_Id
and
  InstEns_Id = 8900000000001
order by
  Nome