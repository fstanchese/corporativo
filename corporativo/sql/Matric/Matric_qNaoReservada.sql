select
  WPessoa.Id                                          as ID,
  WPessoa.Nome                                        as Nome,
  WPessoa.FoneRes                                     as FoneRes,
  WPessoa.FoneCel                                     as FoneCel,
  WPessoa.Email1                                      as Email,
  initcap(Lograd.Nome)                                as Endereco,
  WPessoa.EnderNum                                    as Complemento,
  substr(Lograd.Cep,1,5)||'-'||substr(Lograd.Cep,6,3) as CEP,
  Bairro.Nome                                         as Bairro,
  Cidade.Nome                                         as Cidade,
  Estado.Sigla                                        as Estado,
  upper(Curso.Nome)                                   as Curso
from
  Estado,
  Cidade,
  Bairro,
  Lograd,
  WPessoa,
  VestCla,
  Curso,
  Curr,
  CurrOfe,
  TurmaOfe,
  Matric,
  DebCred,
  Boleto
where
  Estado.Id = Cidade.Estado_Id
and
  Cidade.Id = Bairro.Cidade_Id
and
  Bairro.Id = Lograd.Bairro_Id
and
  Lograd.Id = WPessoa.Lograd_Id
and
  WPessoa.Id not in (select WPessoa_Sacado_Id from Boleto where Referencia like '%2013/01A')
and
  WPessoa.Id not in (select WPessoa_Id from Matric where trunc(DtReserva) > '01/09/2012' and State_Id=3000000002001)
and
  WPessoa.Id = Matric.WPessoa_Id
and
  VestCla.VestChama_Id = nvl ( p_VestChama_Id ,0)
and
  VestCla.Matric_Id = Matric.Id
and
  Curso.Id = Curr.Curso_Id
and
  Curr.Id = CurrOfe.Curr_Id
and
  CurrOfe.Id = TurmaOfe.CurrOfe_Id
and
  TurmaOfe.Id = Matric.TurmaOfe_Id
and
  Matric.Id not in (select Matric_Id from Matrichi where col='State_Id')
and
  trunc(Matric.Dt) > '01/09/2012'
and
  Matric.DtReserva is null
and
  Matric.State_Id = 3000000002000
and
  Matric.Id = DebCred.Matric_Origem_Id
and
  DebCred.Boleto_Destino_Id = Boleto.Id
and
  Boleto.State_Base_Id = 3000000000006
and
  Boleto.BoletoTi_Id = 92200000000008
order by
  Curso.Nome,Lograd.CEP