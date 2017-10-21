select
  Matric.Id                                                 as Id,
  Curr.Id                                                   as Curr_Id,
  Matric.WPessoa_Id                                         as WPessoa_Id,
  Curr.Curso_Id                                             as Curso_Id,
  CurrOfe.Campus_Id                                         as Campus_Id,
  CurrOfe.Periodo_Id                                        as Periodo_Id,
  Matric.State_Id                                           as State_Id,
  CurrOfe.Id                                                as CurrOfe_Id
from
  WPessoa,
  Matric,
  TurmaOfe,
  CurrOfe,
  Curr,
  Curso
where
  Matric.WPessoa_Id = WPessoa.Id
and
  Curso.CursoNivel_Id in ( 6200000000001,6200000000010 )
and
  Curso.Id = Curr.Curso_Id
and
  Curr.Id = CurrOfe.Curr_Id
and
  Matric.MatricTi_Id = 8300000000001
and
  Matric.State_Id > 3000000002001
and
  Matric.TurmaOfe_Id = TurmaOfe.Id
and
  TurmaOfe.CurrOfe_Id = CurrOfe.Id
and
  Matric.WPessoa_Id = nvl ( p_WPessoa_Id , 0)
and
  CurrOfe.PLetivo_Id = nvl ( p_PLetivo_Id , 0 )
order by matric.state_id