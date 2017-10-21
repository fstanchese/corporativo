select
  WPessoa.Id      as WPessoa_Id,
  Curr.Curso_Id   as Curso_Id,
  Matric.State_Id as State_Id,
  Matric.Id       as Matric_Id
from
  Turma,
  Matric,
  WPessoa,
  TurmaOfe,
  Curr,
  CurrOfe
where
  TurmaOfe.Turma_Id = Turma.Id
and
  Matric.MatricTi_Id = 8300000000001
and
  Matric.State_Id > 3000000002001
and
  Matric.WPessoa_Id = WPessoa.Id
and
  CurrOfe.Curr_Id = Curr.Id
and
  TurmaOfe.CurrOfe_Id = CurrOfe.Id
and
  Matric.TurmaOfe_Id = TurmaOfe.Id
and
  CurrOfe.PLetivo_Id = nvl ( p_PLetivo_Id , 0 )
order by WPessoa.Nome,Matric.State_Id
