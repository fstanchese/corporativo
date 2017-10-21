select
  initcap(shortname(WPessoa.Nome,25))    as Nome,
  WPessoa.FoneRes                        as Fone,
  WPessoa.FoneCel                        as Celular,
  WPessoa.Email1                         as Email,
  WPessoa.Id                             as WPessoa_Id,
  WPessoa.RGRNE                          as RGRNE,
  Matric.Id                              as Matric_Id,
  Campus.Nome                            as Campus,
  Campus.Id                              as Campus_Id,
  Curso.Nome                             as Curso,
  Curso.Id                               as Curso_Id,
  Periodo.Nome                           as Periodo,
  CurrOfe.Id                             as CurrOfe_Id,
  Lograd_gsrecognize(WPessoa.Lograd_Id)  as Endereco_Recognize,
  WPessoa.EnderNum                       as Complemento, 
  initcap(Lograd.Nome)                                as Endereco,
  substr(Lograd.Cep,1,5)||'-'||substr(Lograd.Cep,6,3) as CEP,
  Bairro.Nome                                         as Bairro,
  Cidade.Nome                                         as Cidade,
  Estado.Sigla                                        as Estado 
from
  Estado,
  Cidade,
  Bairro,
  Lograd,
  WPessoa,
  Boleto,
  DebCred,
  Matric,
  DuracXCi,
  Turma,
  TurmaOfe,
  Campus,
  Curso,
  Curr,
  Periodo,
  CurrOfe
where
  Estado.Id(+) = Cidade.Estado_Id
and
  Cidade.Id(+) = Bairro.Cidade_Id
and
  Bairro.Id(+) = Lograd.Bairro_Id
and
  Lograd.Id(+) = WPessoa.Lograd_Id 
and
  WPessoa.Id = Boleto.WPessoa_Sacado_Id
and
  Boleto.State_Base_Id in (3000000000004,3000000000008)
and
  BoletoTi_Id = 92200000000008
and
  Boleto.Id = DebCred.Boleto_Destino_Id
and
  DebCred.Matric_Origem_Id = Matric.Id
and 
  Matric.DtReserva > '01/09/2012'
and
  Matric.State_Id = 3000000002001
and
  Matric.TurmaOfe_Id = TurmaOfe.Id
and
  DuracXCi.Sequencia = 1
and
  DuracXCi.Id = Turma.DuracXCi_Id 
and 
  Turma.Id = TurmaOfe.Turma_Id
and
  TurmaOfe.CurrOfe_Id = CurrOfe.Id 
and
  Campus.Id = CurrOfe.Campus_Id
and
  Curso.Id = Curr.Curso_Id
and
  Curr.Id = CurrOfe.Curr_Id
and
  Periodo.Id = Currofe.Periodo_Id
and
  CurrOfe.Pletivo_Id = 7200000000083
and
  CurrOfe.Vest = 'on' 
order by
  CurrOfe.Id,Campus.Nome,Curso.Nome,Lograd.CEP