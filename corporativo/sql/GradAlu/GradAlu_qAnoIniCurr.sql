select
  Count(*) as Total,
  TurmaOfe.Id,
  TurmaOfe_gnRetPletivo(TurmaOfe.Id) as PLetivo_Id
from
  matric,
  Curr,
  Curso,
  CurrOfe,
  DuracXCi,
  Turma,
  TurmaOfe,
  CurrXDisc,
  GradAlu
where
  DuracXCi.Sequencia = nvl( p_DuracXCi_Sequencia ,0)
and
  DuracXCi.Id = Turma.DuracXCi_Id
and
  Turma.Id = TurmaOfe.Turma_Id
and
  Curso.Id = Curr.Curso_Id
and
  Curr.Id = CurrOfe.Curr_Id
and
  CurrOfe.Id = TurmaOfe.CurrOfe_Id
and
  Matric.State_Id not in ( 3000000002004,3000000002005,3000000002006,3000000002007,3000000002008,3000000002009 )
and
  Matric.TurmaOfe_Id = TurmaOfe.Id
and
  Matric.MatricTi_Id = 8300000000001
and
  gradalu.matric_id = matric.id
and
  TurmaOfe.Id = GradAlu.TurmaOfe_Id
and
  CurrXDisc.Id = GradAlu.CurrXDisc_Id
and
  ( 
    GradAlu.State_Id = 3000000003004 
      or 
    GradAlu.State_Id = 3000000003001 
  )
and
  Curr.Id = nvl( p_Curr_Id ,0)
and
  GradAlu.WPessoa_Id = nvl( p_WPessoa_Id ,0)
group by TurmaOfe.Id
order by 3
