select
  VESTCLA.ID,
  Boleto.Id                                           as Boleto_Id,
  Matric.Id                                           as Matric_Id,
  Curso.Nome                                          as Curso,
  Curso.Id                                            as Curso_Id,
  Campus.Nome                                         as Campus,
  Campus.Id                                           as Campus_Id,
  Periodo.Nome                                        as Periodo,
  initcap(WPessoa.Nome)                               as Nome,
  WPessoa.FoneRes                                     as Fone,
  WPessoa.FoneCel                                     as Celular,
  Lograd_gsrecognize(Lograd_id)                       as Endereco,
  WPessoa.EnderNum                                    as Complemento,
  WPessoa.Id                                          as ID,
  initcap(Lograd.Nome)                                as Endereco,
  WPessoa.EnderNum                                    as Complemento,
  substr(Lograd.Cep,1,5)||'-'||substr(Lograd.Cep,6,3) as CEP,
  Bairro.Nome                                         as Bairro,
  Cidade.Nome                                         as Cidade,
  Estado.Sigla                                        as Estado 
from
  Estado,
  Cidade,
  Bairro,
  Lograd, 
  Vest,
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
  CurrOfe, 
  VestOpcao,
  vestcla
where
  Estado.Id(+) = Cidade.Estado_Id
and
  Cidade.Id(+) = Bairro.Cidade_Id
and
  Bairro.Id(+) = Lograd.Bairro_Id
and
  Lograd.Id(+) = WPessoa.Lograd_Id 
and
  WPessoa.Id not in ( select WPessoa_Id from reemb )
and 
  vestcla.vestchama_id is not null
and
  vestcla.matric_id=matric.id
and
  vestcla.vestopcao_id=vestopcao.id
and
  vest.id = vestopcao.vest_id
and
  VestOpcao.CurrOfe_Id=CurrOfe.Id
and
  Vest.WPessoa_Id = WPessoa.Id
and
  Matric.WPessoa_Id = Vest.WPessoa_Id
and
  WPessoa.Id = Boleto.WPessoa_Sacado_Id
and
  Matric.WPessoa_Id = Boleto.WPessoa_Sacado_Id
and
  Boleto.State_Base_Id in (3000000000004,3000000000008)
and
  BoletoTi_Id = 92200000000008
and
  Boleto.Id = DebCred.Boleto_Destino_Id
and
  DebCred.Matric_Origem_Id = Matric.Id
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
  CurrOfe.Pletivo_Id = 7200000000081
and
  CurrOfe.Vest='off' 
order by
  Campus.Nome,Curso.Nome,WPessoa.Nome