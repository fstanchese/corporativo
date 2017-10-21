select 
  count(Matric.Id)   as Qtde
from  
  Curr,
  TurmaOfe,
  Turma,
  DuracXCi,
  CurrOfe,
  Matric
where
  (
    p_DuracXCi_Sequencia is null
    or
    DuracXCi.Sequencia = nvl( p_DuracXCi_Sequencia ,0)
  )  
and
  DuracXCi.Id = Turma.DuracXCi_Id 
and 
  Turma.Id = TurmaOfe.Turma_Id
and
  Curr.Id = CurrOfe.Curr_Id
and
  Currofe.Id = Turmaofe.CurrOfe_Id 
and 
  TurmaOfe.Id = Matric.TurmaOfe_Id
and
  Matric.Data >= to_date( p_O_DataI , 'dd/mm/yyyy hh24:mi:ss' )
and
  Matric.Data <= to_date( p_O_DataT , 'dd/mm/yyyy hh24:mi:ss' ) 
and
  (
    p_Periodo_Id is null
    or
    CurrOfe.Periodo_Id = nvl( p_Periodo_Id ,0)
  )  
and
  (
    p_Campus_Id is null
    or
    CurrOfe.Campus_Id = nvl( p_Campus_Id ,0)
  )  
and
  (
    p_Curso_Id is null
    or
    Curr.Curso_Id = nvl( p_Curso_Id ,0)
  )  
and
  Matric.MatricTi_Id = 8300000000001
and
  Matric.State_Id = 3000000002002
and
  CurrOfe.Pletivo_Id = 7200000000083
and
  Matric.Ip is not null