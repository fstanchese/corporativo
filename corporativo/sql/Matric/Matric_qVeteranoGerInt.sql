select 
  count(Matric.Id)   as Qtde
from 
  DuracXCi, 
  Turma,
  Curr,
  CurrOfe,
  TurmaOfe, 
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
  (select max(Dt) from Matrichi where col='IP' and Matric_Id = Matric.Id) >= to_date( p_O_DataI , 'dd/mm/yyyy hh24:mi:ss' )
and
  (select max(Dt) from Matrichi where col='IP' and Matric_Id = Matric.Id) <= to_date( p_O_DataT , 'dd/mm/yyyy hh24:mi:ss' )
and
  substr(Matric.Ip,1,11) <> '200.182.49.'
and
  substr(Matric.Ip,1,8) <> '200.178.'
and
  Matric.Ip is not null
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
  MatricTi_Id = 8300000000001
and
  CurrOfe.Pletivo_Id = 7200000000083