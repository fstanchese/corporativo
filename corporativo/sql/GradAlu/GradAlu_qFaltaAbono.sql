select
  gradalu.id as id
from
  GradAlu,
  Matric,
  State,
  CurrOfe,
  TurmaOfe
where
  Matric.State_Id > 3000000002001
and
  GradAlu.State_Id = State.Id
and
  Matric.Id = GradAlu.Matric_Id
and
  GradAlu.State_Id != 3000000003002
and
  Matric.MatricTi_Id <= 8300000000002
and
  GradAlu.WPessoa_Id = nvl( p_WPessoa_Id , 0 )
and
  GradAlu.TurmaOfe_Id = TurmaOfe.Id
and
  TurmaOfe.CurrOfe_Id = CurrOfe.Id
and
  CurrOfe.PLetivo_Id = nvl ( p_PLetivo_Id , 0 )
union
select
  gradalu.id as id
from
  GradAlu,
  Matric,
  State,
  DiscEsp,
  TurmaOfe
where
  Matric.State_Id > 3000000002001
and
  GradAlu.State_Id = State.Id
and
  Matric.Id = GradAlu.Matric_Id
and
  GradAlu.State_Id != 3000000003002
and
  Matric.MatricTi_Id = 8300000000002
and
  GradAlu.WPessoa_Id = nvl( p_WPessoa_Id , 0 )
and
  GradAlu.TurmaOfe_Id = TurmaOfe.Id
and
  TurmaOfe.DiscEsp_Id = DiscEsp.Id
and
  DiscEsp.PLetivo_Id = nvl ( p_PLetivo_Id , 0 )
order by gradalu.matric_id desc