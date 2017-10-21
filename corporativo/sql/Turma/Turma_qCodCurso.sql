select
  Turma.Id 
from
  Turma
where
  Codigo = p_TurmaOfe_TurmaSel
and
  Curso_Id = nvl ( p_Curso_Id , 0 )

