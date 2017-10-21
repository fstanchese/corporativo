select   
  Distinct CurrOfe.Id             as Id,
  CurrOfe_gsRecognize(CurrOfe.Id) as Recognize
from   
  Turma,
  TurmaOfe,
  Curr,
  CurrOfe   
where
  DuracXCi_gnRetSequencia(Turma.DuracXCi_Id) = nvl( p_DuracXCi_Sequencia ,0)
and
  Turma.Id = TurmaOfe.Turma_Id
and
  TurmaOfe.CurrOfe_Id=CurrOfe.Id
and
  Curr.Curso_Id = nvl( p_Curso_Id ,0)
and
  Curr.Id = CurrOfe.Curr_Id
and
  (
    p_Periodo_Id is null
      or
    CurrOfe.Periodo_Id = nvl( p_Periodo_Id ,0)
   )  
and   
  Currofe.pletivo_id = nvl( p_PLetivo_Id ,0)
order by
  2
