select
  sum(Count(distinct curr.id)) as total
from
  DuracXCi,
  Curso,
  Turma,
  TOXCD,
  TurmaOfe,
  CurrOfe,
  Curr
where
  Turma.DuracXCi_Id = DuracXCi.Id
and
  Curr.Curso_Id = Curso.Id
and
  CurrOfe.Curr_Id = Curr.Id
and
  TurmaOfe.Turma_Id = Turma.Id
and
  TOXCD.TurmaOfe_Id = TurmaOfe.Id 
and
  TurmaOfe.CurrOfe_Id = CurrOfe.Id
and
  DuracXCi.Sequencia = nvl ( p_DuracXCi_Sequencia , 0 )
and
  Curso.Id = nvl ( p_Curso_Id , 0 )
and
  CurrOfe.PLetivo_Id = nvl ( p_PLetivo_Id , 0 )
group by Curr.Id