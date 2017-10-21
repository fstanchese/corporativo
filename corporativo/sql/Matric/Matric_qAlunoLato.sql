select
  Matric.Id
from
  Matric,
  TurmaOfe,
  CurrOfe,
  Curr,
  Curso
where
  Curso.CursoNivel_Id = 6200000000002
and
  Curr.Curso_Id = Curso.Id
and
  CurrOfe.Curr_Id = Curr.Id
and
  TurmaOfe.CurrOfe_Id = CurrOfe.Id
and
  Matric.TurmaOfe_Id = TurmaOfe.Id
and
  Matric.WPessoa_Id = nvl( p_WPessoa_Id , 0 )
order by
  Id
