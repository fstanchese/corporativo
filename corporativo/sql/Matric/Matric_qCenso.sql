select
  WPessoa.Id          as WPessoa_Id,
  Curr.Id             as Curr_Id,
  Curr.Curso_Id       as Curso_Id,
  WPessoa.Sexo_Id     as Sexo_Id,
  CurrOfe.Periodo_Id  as Periodo_Id,
  Matric.Id           as Matric_Id,
  Matric.State_Id     as State_Id,
  TurmaOfe_gnUltimoAnista(Matric.TurmaOfe_Id) as UltimoAno
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
  ( ( p_Sequencia_Inicio is null or DuracXCi.Sequencia >= p_Sequencia_Inicio ) and ( p_Sequencia_Fim is null or DuracXCi.Sequencia <= p_Sequencia_Fim ) )
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
      Matric.DtState is null 
      and 
      Matric.State_Id in $vState 
      and
      Trunc(Matric.Data) between p_O_DataIni and p_O_DataFim
    )
    or
    ( 
      Matric.DtState is not null 
      and 
      trunc(Matric.DtState) > p_O_DataFim 
    )  
  )    
and
  Curr.Curso_Id = nvl ( p_Curso_Id ,0)
and
  CurrOfe.PLetivo_Id = nvl( p_PLetivo_Id ,0 )