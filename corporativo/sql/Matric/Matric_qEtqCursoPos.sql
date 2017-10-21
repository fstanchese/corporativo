select
  WPessoa.Codigo                                  as RA,
  WPessoa.Nome                                    as NomeAluno,
  shortName(WPessoa.Nome,25)                      as NomeReduz,
  upper(WPessoa.Nome)                             as NomeMaius,
  TurmaOfe_gsRetCodTurma(Matric.TurmaOfe_Id)      as Turma,
  TurmaOfe_gsRetCodSala(Matric.TurmaOfe_Id)       as Sala,
  State_gsRecognize(Matric.State_Id)              as Situacao,
  Curso.Nome                                      as CursoNome,
  shortName(Curso.Nome,50)                        as CursoReduz,
  Campus.Nome                                     as CampusNome,
  Curr.Id                                         as Curr_Id,
  DuracXCi.Sequencia                              as Sequencia,
  Curr_gnProximaSerie(Curr.Id,DuracXCi.Sequencia) as UltimaSerie,
  Curso.Id                                        as Curso_Id,
  WPessoa.Id                                      as WPessoa_Id,
  WPessoa.FoneRes                                 as FoneRes,
  WPessoa.FoneCom                                 as FoneCom,
  WPessoa.FoneCel                                 as FoneCel,
  Matric.State_Id                                 as State_Id
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
  Turma.DuracXCi_Id = DuracXCi.Id
and
  Turma.Campus_Id = Campus.Id
and
  TurmaOfe.Turma_Id = Turma.Id
and
  Curr.Curso_Id = Curso.Id
and
  (
    Matric.State_Id = nvl( p_State_Id , 0)
    or
    p_State_Id is null
  )
and
  Matric.MatricTi_Id = 8300000000001
and
  Matric.WPessoa_Id = WPessoa.Id
and
  (
    Matric.TurmaOfe_Id = p_TurmaOfe_Id
  or
    p_TurmaOfe_Id is null 
  )
and
  Matric.TurmaOfe_Id = TurmaOfe.Id
and
  TurmaOfe.CurrOfe_Id = CurrOfe.Id
and
  CurrOfe.Curr_Id = Curr.Id
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
order by Campus.Nome,Curso.Nome,NomeAluno
