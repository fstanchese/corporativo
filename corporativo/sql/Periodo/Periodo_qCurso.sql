
select  
  Periodo.Id, 
  Periodo_gsRecognize(Periodo.Id) as Recognize 
from  
  Periodo,
  Turma,
  Curso
where
  Turma.Periodo_Id = Periodo.Id
and
  Turma.Curso_Id = Curso.Id
and
(
  Curso.Id = nvl( p_Curso_Id ,0)
or
  p_Curso_Id is null
)
group by 
  Periodo.Id
order by
  Recognize