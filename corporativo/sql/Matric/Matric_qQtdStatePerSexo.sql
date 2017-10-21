select
  count(*) as total
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
  ( 
    ( 
      p_Sequencia_Inicio is null 
      or 
      DuracXCi.Sequencia >= p_Sequencia_Inicio 
    ) 
    and 
    ( 
      p_Sequencia_Fim is null 
      or 
      DuracXCi.Sequencia <= p_Sequencia_Fim 
    ) 
  )
and
  Turma.Campus_Id = nvl( p_Campus_Id , 0)
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
    CurrOfe.Periodo_Id = nvl( p_Periodo_Id  ,0)
  )
and
  (
    p_Sexo_Id is null
    or
    WPessoa.Sexo_Id = nvl( p_Sexo_Id ,0)
  )
and
  ( 
    Matric.State_Id = nvl( p_State_Id ,0) 
    and 
    ( Trunc(Matric.DtState) between p_O_DataIni and p_O_DataFim or Matric.DtState is null )
  )
and
  Curr.Curso_Id = nvl( p_Curso_Id ,0)
and
  CurrOfe.PLetivo_Id = nvl( p_PLetivo_Id ,0 )
