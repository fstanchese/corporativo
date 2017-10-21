select
  WPessoa.Codigo                             as RA,
  WPessoa.Nome                               as NomeAluno,
  TurmaOfe_gsRetCodTurma(Matric.TurmaOfe_Id) as Turma,
  TurmaOfe_gsRetCodSala(Matric.TurmaOfe_Id)  as Sala,
  State_gsRecognize(Matric.State_Id)         as Situacao,
  Curso.Nome  as CursoNome,
  Campus.Nome as CampusNome,
  Matric.Id   as Matric_Id,
  Decode(SubStr(WPessoa.Codigo,1,1),'9','19'||SubStr(WPessoa.Codigo,1,2),SubStr(WPessoa.Codigo,1,4)) as RaAno
from
  DuracXCi,
  Turma,
  Matric,
  TurmaOfe,
  Curr,
  CurrOfe,
  WPessoa,
  Curso,
  Campus
where
  DuracXCi.Id = Turma.DuracXCi_Id
and
  Campus.Id = Turma.Campus_Id
and
  Turma.Id = TurmaOfe.Turma_Id
and
  Curso.Id = Curr.Curso_Id
and
  Matric.State_Id not in (3000000002000,3000000002001)
and
  Matric.State_Id = State_Id
and
  Matric.MatricTi_Id = 8300000000001
and
  Matric.WPessoa_Id = WPessoa.Id
and
  Matric.TurmaOfe_Id = TurmaOfe.Id
and
  CurrOfe.Id = TurmaOfe.CurrOfe_Id
and
  CurrOfe.Curr_Id = Curr.Id
and
  (
    p_State_Id is null
    or
    Matric.State_Id = nvl ( p_State_Id , 0 )
  )
and
  (
    p_DuracXCi_Sequencia is null
     or
    DuracXCi.Sequencia = nvl ( p_DuracXCi_Sequencia , 0)
  )
and
  (
     p_Periodo_Id is null
      or
     CurrOfe.Periodo_Id = nvl( p_Periodo_Id , 0)
  )
and
  ( 
    p_Campus_Id is null
     or
    Campus.Id = nvl( p_Campus_Id , 0)
  )
and
  ( 
    p_Curso_Id is null
     or
    Curr.Curso_Id = nvl( p_Curso_Id , 0)
  )
and
  CurrOfe.PLetivo_Id = nvl( p_PLetivo_Id ,0)
order by Campus.Nome,Curso.Nome,RaAno,NomeAluno
