select count(*) as total from (
select
  gradalu.id
from
  GradAlu,
  TurmaOfe,
  CurrOfe
where
  gradalu.state_id <> 3000000003002
and
  ( gradalu.n2 is null or gradalu.n2 = 'S/N' or ((gradalu.inscsub = 'on' or gradalu.inscsubauto = 'on') and gradalu.n4 = 'S/N') )
and 
  gradaluti_id < 8500000000005
and
  GradAlu.TurmaOfe_Id = TurmaOfe.Id
and
  TurmaOfe.CurrOfe_Id = CurrOfe.Id
and
  GradAlu.WPessoa_Id = nvl( p_WPessoa_Id  , 0 )
and
  CurrOfe.PLetivo_Id = nvl ( p_PLetivo_Id , 0 )
union
select
  gradalu.id
from
  GradAlu,
  TurmaOfe,
  DiscEsp
where
  gradalu.state_id <> 3000000003002
and
  ( gradalu.n2 is null or gradalu.n2 = 'S/N' or ((gradalu.inscsub = 'on' or gradalu.inscsubauto = 'on') and gradalu.n4 = 'S/N') )
and 
  gradaluti_id < 8500000000005
and
  GradAlu.TurmaOfe_Id = TurmaOfe.Id
and
  TurmaOfe.DiscEsp_Id = DiscEsp.Id
and
  GradAlu.WPessoa_Id = nvl( p_WPessoa_Id  , 0 )
and
  DiscEsp.PLetivo_Id = nvl ( p_PLetivo_Id , 0 )
)