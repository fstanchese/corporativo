select
  WPessoa.Id                                            as WPessoa_Id,
  WPessoa.Codigo                                        as RA,
  upper(WPessoa.EnderNum)                               as Complemento,
  upper(Lograd.Nome)                                    as Logradouro,
  Lograd.CEP                                            as CEP,
  Cidade.Nome                                           as Cidade,
  Campus.Nome                                           as Unidade,
  Curso.Nome                                            as Curso,
  Periodo.Nome                                          as Periodo,
  Matric_gsAnoInicioGrad(Matric.TurmaOfe_Id,WPessoa.Id) as AnoIngresso
from
  Cidade,
  Bairro,
  Lograd,
  WPessoa,
  Curso,
  Curr,
  Periodo,
  Campus,
  CurrOfe,
  Turma,
  TurmaOfe,
  Matric
where
  Cidade.Id(+) = Bairro.Cidade_Id
and
  Bairro.Id(+) = Lograd.Bairro_Id
and
  Lograd.Id(+) = WPessoa.Lograd_Id
and
  WPessoa.Id = Matric.WPessoa_Id
and
  Curso.CursoNivel_Id in (6200000000001,6200000000010,6200000000012)
and
  Curso.Id = Curr.Curso_Id
and
  Curr.Id = CurrOfe.Curr_Id
and
  Periodo.Id = CurrOfe.Periodo_Id
and
  Campus.Id = CurrOfe.Campus_Id
and
  CurrOfe.PLetivo_Id = nvl( p_PLetivo_Id ,0)
and
  CurrOfe.Id = TurmaOfe.CurrOfe_Id
and
  Turma.Id = TurmaOfe.Turma_Id
and
  TurmaOfe.Id = Matric.TurmaOfe_Id
and
  Matric.State_Id >= 3000000002002
and
  Matric.MatricTi_Id = 8300000000001
and
  Matric.Data <= nvl( p_O_Data1 ,0)