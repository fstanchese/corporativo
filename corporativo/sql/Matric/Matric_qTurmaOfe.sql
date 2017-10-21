select
  WPessoa.Codigo ||' - '|| WPessoa.Nome ||' - '|| State_gsRecognize(Matric.State_Id) as Recognize,
  Matric.Id                               as Id,
  WPessoa.Codigo                          as RA,
  WPessoa.CPF                             as CPF,
  State_gsRecognize(Matric.State_Id)      as Estado_Matric,
  Matric.TurmaOfe_Id                      as TurmaOfe_Id,       
  WPessoa.Nome                            as NomeAluno,
  shortname(WPessoa.Nome,27)              as NomeReduz,
  Matric.Data                             as DataMatricula,
  Matric.MatricTi_Id                      as MatricTi_Id,
  Matric.Matric_Pai_Id                    as Matric_Pai_Id,
  Matric.State_Id                         as State_Id,
  Matric.WPessoa_Id                       as WPessoa_Id,
  TurmaOfe_gnRetCurso(Matric.TurmaOfe_Id) as Curso_Id,
  TurmaOfe_gnRetCurr(Matric.TurmaOfe_Id)  as Curr_Id,
  TurmaOfe_gsRetCodTurma(Matric.TurmaOfe_Id) as Turma
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
  Matric.State_Id not in ( 3000000002000,3000000002001,3000000002004,3000000002005,3000000002006,3000000002008,3000000002009,3000000002013 )
and
  Matric.WPessoa_Id = WPessoa.Id
and
  Matric.TurmaOfe_Id = nvl( p_TurmaOfe_Id ,0)
order by NomeAluno