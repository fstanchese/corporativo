select
  Count(Matric.Id) as Qtde
from
  Curso,
  Curr,
  CurrOfe,
  TurmaOfe,
  Matric
where
(
    p_CursoNivel_Id is null
  or
    Curso.CursoNivel_Id = nvl( p_CursoNivel_Id ,0)
)
and
  Curso.Id = Curr.Curso_Id
and
  Curr.Id = CurrOfe.Curr_Id
and
  Currofe.Id = Turmaofe.CurrOfe_Id
and 
  TurmaOfe.Id = Matric.TurmaOfe_Id
and
  Matric.Data <= p_O_DataTermino
and
  Matric.Data >= p_O_DataInicio
and
  Matric.WPessoa_Id = nvl( p_WPessoa_Id ,0)