select
  WPessoa.Codigo ||' - '|| WPessoa.Nome ||' - '|| State_gsRecognize(Matric.State_Id) as Recognize,
  Matric.Id                          as Id,
  WPessoa.Codigo                     as RA,
  State_gsRecognize(Matric.State_Id) as Estado_Matric,
  Matric.TurmaOfe_Id                 as TurmaOfe_Id,       
  WPessoa.Nome                       as NomeAluno,
  shortname(WPessoa.Nome,27)         as NomeReduz,
  WPessoa.Id                         as WPessoa_Id,
  Matric.Data                        as DataMatricula,
  Matric.MatricTi_Id                 as MatricTi_Id,
  Matric.Matric_Pai_Id               as Matric_Pai_Id,
  Matric.State_Id                    as State_Id,
  Matric.WPessoa_Id                  as WPessoa_Id
from
  Matric,
  WPessoa
where
  Matric.MatricTi_Id = nvl ( p_MatricTi_Id , 0)
and
  Matric.State_Id > 3000000002001 
and
  Matric.WPessoa_Id = WPessoa.Id
and
  Matric.TurmaOfe_Id = nvl( p_TurmaOfe_Id ,0)
order by 6
