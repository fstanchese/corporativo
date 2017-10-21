select
  PesqTurma.TurmaOfe_Id,
  PesqTurma.DivTurma_Id,
  TurmaOfe_gsRetCodTurma(TurmaOfe_Id) as Turma
from
  PesqTurma
where
  (
    ( p_PesqTurma_Sequencia is null and  nvl( p_PesqTi_Id , 0 ) = 135900000000001 ) 
    or
    PesqTurma.Sequencia = nvl ( p_PesqTurma_Sequencia , 0)
  )
and
  PesqTurma.PesqTi_Id = nvl ( p_PesqTi_Id , 0 )
and
  PesqTurma.Semestre_Id = nvl ( p_Semestre_Id , 0)
and
  PesqTurma.Ano_Id = nvl ( p_Ano_Id , 0)
group by PesqTurma.TurmaOfe_Id,PesqTurma.DivTurma_Id
order by Turma