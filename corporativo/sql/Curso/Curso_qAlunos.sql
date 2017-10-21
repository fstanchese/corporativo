select
  WPessoa.Id        as WPessoa_Id, 
  WPessoa.Nome      as Nome,
  WPessoa.Codigo    as RA,
  WPessoa.FoneRes   as Fone,
  Curso.Nome        as Curso_Recognize
from
  Matric,
  WPessoa,
  TurmaOfe,
  CurrOfe,
  Curr,
  Curso
where
  Matric.State_Id in (3000000002002,3000000002003)
and
  Matric.WPessoa_Id = WPessoa.Id
and
  Matric.MatricTi_Id = 8300000000001
and
  Matric.TurmaOfe_Id = TurmaOfe.Id
and
  TurmaOfe.CurrOfe_Id = CurrOfe.Id
and
  Curr.Curso_Id = Curso.Id
and
  CurrOfe.Curr_Id = Curr.Id
and
  CurrOfe.PLetivo_Id = nvl( p_PLetivo_Id ,0)
and
(
  Curso.Id = nvl( p_Curso_Id ,0)
or
  p_Curso_Id is null
)
group by
  WPessoa.Id, WPessoa.Nome, Curso.Nome, WPessoa.Codigo, WPessoa.FoneRes
order by
  Curso.Nome, WPessoa.Nome