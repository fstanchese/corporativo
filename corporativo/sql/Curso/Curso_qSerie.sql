select 
  DuracXCi.Sequencia as Id,
  DuracXCi.Sequencia||'a Série' as Recognize 
from
  DuracXCi,
  Turma,
  TurmaOfe,
  CurrOfe,
  Curr,
  Curso
where
  DuracXCi.Id = Turma.DuracXCi_Id
and
  Turma.Id = TurmaOfe.Turma_Id
and  
  TurmaOfe.CurrOfe_Id = CurrOfe.Id
and
  Curr.Id = CurrOfe.Curr_Id
and
  Curso.Id = Curr.Curso_Id
and
  ( 
    p_Periodo_Id is null
      or
    CurrOfe.PLetivo_Id = nvl( p_Periodo_Id ,0)
  )
and
  CurrOfe.PLetivo_Id = nvl( p_PLetivo_Id ,0)
and
  Curso.Id = nvl( p_Curso_Id ,0)
group by DuracXCi.Sequencia
  order by 2
