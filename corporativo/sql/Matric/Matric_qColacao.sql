select
  WPessoa.Codigo ||' - '|| WPessoa.Nome ||' - '|| State_gsRecognize(Matric.State_Id) as Recognize,
  Matric.Id                          as Id,
  WPessoa.Codigo                     as RA,
  State_gsRecognize(Matric.State_Id) as Estado_Matric,
  Matric.TurmaOfe_Id                 as TurmaOfe_Id,       
  WPessoa.Nome                       as NomeAluno,
  shortname(WPessoa.Nome,27)         as NomeReduz,
  Matric.Id                          as Matric_Id,
  Matric.Data                        as DataMatricula,
  Matric.MatricTi_Id                 as MatricTi_Id,
  Matric.Matric_Pai_Id               as Matric_Pai_Id,
  TurmaOfe_gnRetCurr(Matric.TurmaOfe_Id) as Curr_Id,
  to_char(TempColacao.DtColacao,'DD-MM-YYYY')   as DtColMk, 
  to_char(TempColacao.DtRetira,'DD-MM-YYYY')    as DtRetMk,
  to_char(TempColacao.DtExpedicao,'DD-MM-YYYY') as DtExpMk,
  Matric.WPessoa_Id                  as WPessoa_Id
from
  TempColacao,
  Matric,
  TurmaOfe,
  CurrOfe,
  WPessoa
where
  Matric.Id = TempColacao.Matric_Id
and
  Matric.MatricTi_Id = 8300000000001
and
  Matric.WPessoa_Id = WPessoa.Id
and
  Matric.TurmaOfe_Id = nvl( p_TurmaOfe_Id ,0)
and
  Matric.TurmaOfe_Id = TurmaOfe.Id
and
  CurrOfe.Id = TurmaOfe.CurrOfe_Id
and
  CurrOfe.PLetivo_Id = nvl( p_PLetivo_Id ,0)
order by NomeAluno
