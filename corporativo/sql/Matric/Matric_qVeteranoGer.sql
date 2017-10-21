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
  (
    p_State_Id is null
    or
    Matric_Ante_Id not in (select Id from Matric where Data > '01/01/2012' and State_Id = nvl( p_State_Id ,0))
  )
and
  Matric_Ante_Id is not null
and
  MatricTi_Id = 8300000000001
and
  CurrOfe.Pletivo_Id = 7200000000083