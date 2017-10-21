select
  WPessoa.Codigo ||' - '|| WPessoa.Nome ||' - '|| State_gsRecognize(Matric.State_Id) as Recognize,
  Matric.Id                                  as Id,
  WPessoa.Codigo                             as RA,
  WPessoa.CPF                                as CPF,
  State_gsRecognize(Matric.State_Id)         as Estado_Matric,
  Matric.TurmaOfe_Id                         as TurmaOfe_Id,       
  WPessoa.Nome                               as NomeAluno,
  shortname(WPessoa.Nome,27)                 as NomeReduz,
  Matric.Data                                as DataMatricula,
  Matric.MatricTi_Id                         as MatricTi_Id,
  Matric.Matric_Pai_Id                       as Matric_Pai_Id,
  Matric.State_Id                            as State_Id,
  Matric.WPessoa_Id                          as WPessoa_Id,
  TurmaOfe_gnRetCurso(Matric.TurmaOfe_Id)    as Curso_Id,
  TurmaOfe_gnRetCurr(Matric.TurmaOfe_Id)     as Curr_Id,
  TurmaOfe_gsRetCodTurma(Matric.TurmaOfe_Id) as Turma,
  WPessoa.FoneRes                            as FoneRes,
  WPessoa.FoneCom                            as FoneCom,
  WPessoa.FoneCel                            as FoneCel,
  WPessoa.Email1                             as Email1
from
  Matric,
  WPessoa
where
  (
    p_MatricTi_Id is null
  or
    Matric.MatricTi_Id = nvl( p_MatricTi_Id ,0)
  )
and
  (
    p_State_Id is null
  or
    Matric.State_Id = nvl( p_State_Id ,0)
  )
and
  Matric.WPessoa_Id = WPessoa.Id
and
  Matric.TurmaOfe_Id = nvl( p_TurmaOfe_Id ,0)
order by 
  NomeAluno