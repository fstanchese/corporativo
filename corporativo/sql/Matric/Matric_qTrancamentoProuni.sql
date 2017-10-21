select distinct
  WPessoa.Codigo ||' - '|| WPessoa.Nome ||' - '|| State_gsRecognize(Matric.State_Id) as Recognize,
  Matric.Id                           as Id,
  WPessoa.Codigo                      as RA,
  State_gsRecognize(Matric.State_Id)  as Estado_Matric,
  Matric.TurmaOfe_Id                  as TurmaOfe_Id,
  WPessoa.Nome                        as NomeAluno,
  shortname(WPessoa.Nome,27)          as NomeReduz,
  WPessoa.Id                          as WPessoa_Id,
  Matric.DtState                      as DataState,
  Matric.Data                         as DataMatricula,
  Matric.MatricTi_Id                  as MatricTi_Id,
  Matric.Matric_Pai_Id                as Matric_Pai_Id,
  Matric.State_Id                     as State_Id,
  Matric.WPessoa_Id                   as WPessoa_Id,
  State.Nome                          as State_Nome,
  TurmaOfe_gnRetPLetivo(TurmaOfe_Id)  as PLetivo_Id,
  Curso.Nome                          as NomeCurso,
  Curr.Curso_Id                       as Curso_Id,
  TurmaOfe_gsRetCodTurma(TurmaOfe_Id) as Turma
from
  TempProuni,
  State,
  TurmaOfe,
  CurrOfe,
  Curr,
  Turma,
  Matric,
  WPessoa,
  Curso
where
  (
    trunc(TempProuni.DtInicio) between p_O_Data1 and p_O_Data2
    or
    trunc(TempProuni.DtTermino) between p_O_Data1 and p_O_Data2
  )
and
  Curso.Id = Curr.Curso_Id
and 
  (
    Curr.Curso_Id = nvl( p_Curso_Id ,0)
    or
    p_Curso_Id is null
  )  
and
  Curr.Id = CurrOfe.Curr_Id
and
  CurrOfe.Id = TurmaOfe.CurrOfe_Id
and
  WPessoa.Id = TempProuni.WPessoa_Id
and
  State.Id = Matric.State_Id 
and
  WPessoa.Id = Matric.WPessoa_Id
and
  Turma.Id = TurmaOfe.Turma_Id
and
  TurmaOfe.Id = Matric.TurmaOfe_Id
and
  Turma.Campus_Id = nvl ( p_Campus_Id ,0)
and
  trunc(Matric.DtState) between p_O_Data1 and p_O_Data2
and
  State.Id = 3000000002005
and
  Matric.MatricTi_Id = 8300000000001
order by NomeCurso,NomeAluno
