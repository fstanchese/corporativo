select
  wpessoa.codigo as ra,
  wpessoa.nome   as nomealuno
from
  wpessoa,
  GradAlu
where
  gradalu.wpessoa_id=wpessoa.id
and
  gradalu.state_id in ( 3000000003001,3000000003004,3000000003005,3000000003006,3000000003007,3000000003008 )
and
  (
    p_DivTurma_Id is null
    or
    GradAlu.DivTurma_Pratica_Id  = nvl ( p_DivTurma_Id , 0 )
  )
and
  (
    p_CurrXDisc_Id is null
    or
    GradAlu.CurrXDisc_Id = nvl ( p_CurrXDisc_Id , 0 )
  )
and
  GradAlu.TurmaOfe_Id = nvl ( p_TurmaOfe_Id , 0 )
order by 2
