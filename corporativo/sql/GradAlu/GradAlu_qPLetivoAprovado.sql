select sum(total) as total from 
(
select
  count(*) as total
from
  GradAlu,
  TurmaOfe,
  DiscEsp
where
  DiscEsp.PLetivo_Id < nvl ( p_PLetivo_Id , 0 )
and
  DiscEsp.Id = TurmaOfe.DiscEsp_Id
and
  TurmaOfe.Id = GradAlu.TurmaOfe_Id
and
  GradAlu.State_Id = 3000000003004
and
  GradAlu.CurrXDisc_Id = nvl( p_CurrXDisc_Id ,0)
and
  GradAlu.WPessoa_Id = nvl( p_WPessoa_Id ,0)
union
select
  count(*) as total
from
  GradAlu,
  TurmaOfe,
  CurrOfe
where
  CurrOfe.PLetivo_Id < nvl ( p_PLetivo_Id , 0 )
and
  CurrOfe.Id = TurmaOfe.CurrOfe_Id
and
  TurmaOfe.Id = GradAlu.TurmaOfe_Id
and
  GradAlu.State_Id = 3000000003004
and
  GradAlu.CurrXDisc_Id = nvl( p_CurrXDisc_Id ,0)
and
  GradAlu.WPessoa_Id = nvl( p_WPessoa_Id ,0)
)
