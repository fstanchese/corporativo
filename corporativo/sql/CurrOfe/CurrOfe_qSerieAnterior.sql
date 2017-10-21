select
  Curr.Codigo 
from
  DuracXCi,
  Turma,
  TurmaOfe,
  CurrOfe,
  Curr
where
  DuracXCi.Sequencia = nvl ( p_DuracXCi_Sequencia , 0 )
and
  Turma.DuracXCi_Id = DuracXCi.Id
and
  TurmaOfe.Turma_Id = Turma.Id
and
  TurmaOfe.CurrOfe_Id = CurrOfe.Id
and
  Curr.Curso_Id = nvl ( p_Curso_Id , 0 )
and
  CurrOfe.Curr_Id = Curr.Id
and
  CurrOfe.PLetivo_Id = nvl ( p_PLetivo_Id , 0 )
group by Curr.Codigo
order by Curr.Codigo