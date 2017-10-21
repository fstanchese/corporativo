select
  count(*) as Total
from
  PesqTurma
where
  PesqTurma.SubDivisao is not null
and
  (
    p_DivTurma_Id is null
    or
    nvl ( PesqTurma.DivTurma_Id, 0 ) = nvl ( p_DivTurma_Id , 0)
  )
and
  PesqTurma.TurmaOfe_Id = nvl ( p_TurmaOfe_Id , 0)
and
  PesqTurma.Sequencia = nvl ( p_PesqTurma_Sequencia , 0)
and
  PesqTurma.PesqTi_Id = nvl ( p_PesqTi_Id , 0 )
and
  PesqTurma.Semestre_Id = nvl ( p_Semestre_Id , 0)
and
  PesqTurma.Ano_Id = nvl ( p_Ano_Id , 0)