select
  Boleto.DtVencto                                                       as DtVencto,
  Boleto.NossoNum                                                       as NossoNum,
  Boleto.NumDoc                                                         as NumDoc,
  replace(to_char(BOLETO.VALOR,'9999D99'),'.',',')                      as ValorFormatado,
  Boleto.Valor                                                          as Valor,
  Boleto.Referencia                                                     as Referencia,
  Boleto.Dt                                                             as Boleto_Dt,
  InitCap(Lograd.Nome)||' '||WPessoa.EnderNum                           as Logradouro,
  Lograd.Cep                                                            as Cep,
  Bairro.Nome                                                           as Bairro, 
  Cidade.Nome                                                           as Cidade,
  Estado.Sigla                                                          as Estado,
  BolsaTi_gsRecognize(BolsaTi_Id)                                       as Bolsa,
  BolsaTi_Id                                                            as BolsaTi_Id,
  WPessoa.Codigo                                                        as RA,
  InitCap(WPessoa.Nome)                                                 as Nome,
  WPessoa.RGRNE                                                         as RGRNE,
  WPessoa.Id                                                            as WPessoa_Id,
  WPessoa.FoneRes                                                       as Fone,
  InitCap(WPessoa.Pai)                                                  as Pai,
  InitCap(WPessoa.Mae)                                                  as Mae,
  lpad(Vest.Inscricao, 5, '0')||'-'||dacmod10(nvl ( Vest.Inscricao ,0)) as Inscricao,
  CurrNomeVest                                                          as Curso,
  Periodo.Nome                                                          as Periodo,
  Campus.Nome                                                           as Campus,
  TurmaOfe.Id                                                           as TurmaOfe_Id,
  VestOpcao.Sequencia                                                   as Opcao,
  VestChama.Nome                                                        as Chamada
from
  Boleto,
  DebCred,
  Estado,
  Cidade,
  Bairro,
  Lograd,
  Bolsa,
  WPessoa,
  Vest,
  Curr,
  DuracXCi,
  Turma,
  TurmaOfe,  
  Campus,
  Periodo,
  CurrOfe,
  VestOpcao,
  Matric,
  VestCla,
  VestChama
where
  (
    trunc(Boleto.Dt) = p_Boleto_Dt
  or
    p_Boleto_Dt is null
  )
and
  Boleto.State_Base_Id not in (3000000000001,3000000000004)
and
  BoletoTi_Id = 92200000000008
and
  Boleto.Id = DebCred.Boleto_Destino_Id
and
  DebCred.Matric_Origem_Id = Matric.Id
and
  Matric.WPessoa_Id = WPessoa.Id
and
  Estado.Id(+) = Cidade.Estado_Id
and
  Cidade.Id(+) = Bairro.Cidade_Id
and
  Bairro.Id(+) = Lograd.Bairro_Id
and
  Lograd.Id(+) = WPessoa.Lograd_Id
and
  Bolsa.WPessoa_Id(+) = WPessoa.Id 
and
  WPessoa.Id = Vest.WPessoa_Id
and
(
    Vest.Inscricao = p_Vest_Inscricao
  or
    p_Vest_Inscricao is null
)
and
  (
    trunc(Vest.Dt) = p_Vest_Dt
  or
    p_Vest_Dt is null  
  )
and
  Vest.Id = VestOpcao.Vest_Id
and
  Curr.Id = CurrOfe.Curr_Id
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
  Periodo.Id = CurrOfe.Periodo_Id
and
  CurrOfe.Id = VestOpcao.CurrOfe_Id
and
  VestOpcao.Id = VestCla.VestOpcao_Id
and
  VestCla.Matric_Id = Matric.Id
and
  VestCla.VestChama_Id = VestChama.Id
and
  Matric.TurmaOfe_Id = TurmaOfe.Id
and
  VestChama.Id = nvl( p_VestChama_Id ,0)
order by
  Curr.CurrNomeVest,WPessoa.Nome