select
  count(*) as total,
  duracxci.sequencia,
  duracxci.sequencia||'a Série' as Serie
from
  Matric,
  WPessoa,
  CurrOfe,
  TurmaOfe,
  Turma,
  Curr,
  DuracXCi  
where
  DuracXCi.Id = Turma.DuracXCi_Id 
and
  Turma.Id = TurmaOfe.Turma_Id
and
  TurmaOfe.Id = Matric.TurmaOfe_Id
and
  CurrOfe.Id = TurmaOfe.CurrOfe_Id
and
  Curr.Id = CurrOfe.Curr_Id
and
  WPessoa.Id = Matric.WPessoa_Id
and
  Matric.MatricTi_Id = 8300000000001
and
  Turma.Campus_Id = nvl( p_Campus_Id ,0)
and
  (
    p_DuracXCi_Sequencia is null
    or
    DuracXCi.Sequencia = p_DuracXCi_Sequencia
  )
and
  (
    p_Curr_Id is null
    or
    Curr.Id = nvl( p_Curr_Id  ,0)
  )
and
  (
    p_Periodo_Id  is null
    or
    CurrOfe.Periodo_Id = nvl ( p_Periodo_Id  ,0)
  )
and
  (
    p_Sexo_Id is null
    or
    WPessoa.Sexo_Id = nvl ( p_Sexo_Id ,0)
  )
and
  ( 
    ( 
      Matric.State_Id in ( 3000000002002,3000000002003,3000000002010,3000000002011,3000000002012 )
      and
      trunc(Matric.Data) < nvl( p_O_DataFim , trunc(sysdate) ) 
    )
    or
    (
      Matric.State_Id in ( 3000000002004,3000000002005,3000000002006,3000000002007,3000000002008,3000000002009 ) 
      and 
      trunc(Matric.DtState) >= nvl( p_O_DataFim , trunc(sysdate) ) 
    ) 
  ) 
and
  Curr.Curso_Id = nvl ( p_Curso_Id ,0)
and
  CurrOfe.PLetivo_Id = nvl( p_PLetivo_Id ,0 )
group by duracxci.sequencia