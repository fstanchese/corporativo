select 
  curr.id,
  curr.codigo as RECOGNIZE
from
  currxdisc,
  currofe,
  curr,
  duracxci,
  turmaofe,
  turma,
  periodo
where
  curr.codigo like '%2014%'
and
  DuracXCi.Id = Turma.DuracXCi_Id 
and
  Turma.Id = TurmaOfe.Turma_Id
and
  CurrOfe.Id = TurmaOfe.CurrOfe_Id 
and
  DuracXCi.Id = CurrXDisc.DuracXCi_Id
and
  Curr.Id = CurrXDisc.Curr_Id
and
  Curr.Id = currOfe.Curr_Id
and
  Periodo.Id = CurrOfe.Periodo_Id 
and
  (
     p_Periodo_Id is null
     or
     Periodo.Id = nvl( p_Periodo_Id ,0)
  )
and
  (
    p_Campus_Id is null
    or
    CurrOfe.Campus_Id = nvl ( p_Campus_Id ,0)
  )
and
  ( 
    p_DuracXCi_Sequencia is null
    or
    DuracXCi.Sequencia = p_DuracXCi_Sequencia
  )
and
  Curr.Curso_Id =  nvl( p_Curso_Id ,0)
and
  CurrOfe.PLetivo_Id = nvl( p_PLetivo_Id ,0)
group by curr.id,curr.codigo
order by 2