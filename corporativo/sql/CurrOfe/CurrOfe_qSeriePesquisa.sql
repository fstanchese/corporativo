select 
  DuracXCi.Sequencia as Id,
  DuracXCi.Sequencia||'a Série' as Recognize 
from
  DuracXCi,
  Turma,
  TurmaOfe,
  CurrOfe,
  Curr,
  PesqTurma
where
  (
    ( p_PesqTurma_Sequencia is null and  nvl( p_PesqTi_Id , 0 ) = 135900000000001 ) 
    or
    PesqTurma.Sequencia = nvl ( p_PesqTurma_Sequencia , 0)
  )
and
  DuracXCi.Id = Turma.DuracXCi_Id
and
  Turma.Id = TurmaOfe.Turma_Id
and  
  TurmaOfe.CurrOfe_Id = CurrOfe.Id
and
  Curr.Id = CurrOfe.Curr_Id
and
  ( 
    p_Campus_Id is null
      or
    CurrOfe.Campus_Id = nvl( p_Campus_Id ,0)
  )
and
  ( 
    p_Periodo_Id is null
      or
    CurrOfe.Periodo_Id = nvl( p_Periodo_Id ,0)
  )
and
  (
    p_Curso_Id is null
    or
    Curr.Curso_Id = nvl( p_Curso_Id ,0)
  )
and
  PesqTurma.TurmaOfe_Id = TurmaOfe.Id
and
  PesqTurma.Semestre_Id = nvl ( p_Semestre_Id , 0)
and
  PesqTurma.PesqTi_Id = nvl ( p_PesqTi_Id , 0)
and
  PesqTurma.Ano_Id = nvl ( p_Ano_Id , 0)
group by DuracXCi.Sequencia
  order by 2
