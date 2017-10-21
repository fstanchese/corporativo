select
  Pesq.Curso_Id
from
  PesqTurma,
  Pesq
where
  Pesq.Ano_Id = PesqTurma.Ano_Id
and
  Pesq.Semestre_Id = PesqTurma.Semestre_Id
and
  Pesq.PesqTi_Id = PesqTurma.PesqTi_Id
and
  (
    ( p_PesqTurma_Sequencia is null and  nvl( p_PesqTi_Id , 0 ) = 135900000000001 ) 
    or
    PesqTurma.Sequencia = PesqTurma.Sequencia
  ) 
and
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
