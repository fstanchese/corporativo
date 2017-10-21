(
select
  Id,
  State_Id,
  to_char(Sysdate + 7, 'dd/mm/yyyy')  as DtVencto,
  ValorOriginal,
  ValorBoleto,
  NossoNum,
  Referencia,
  DtPagto,
  ValorPago,
  PagoDia,
  NomeAluno,
  Ra,
  ( Dif * -1 )                                               as Diferenca,
  to_char((Dif * -1),'9G999G990D00')                         as Diferenca_Format,
  to_char(valorPago,'9G999G990D00')                          as ValorPago_Format,
  to_char(ValorBoleto,'9G999G990D00')                        as ValorBoleto_Format,  
  (Boleto_Valor - ValorPago)*-1                              as DiferencaPrincipal,
  to_char((Boleto_Valor - ValorPago)*-1,'9G999G990D00')      as DiferencaPrincipal_Format,
  Tipo
from
(
select
  Boleto.Id                                                              as Id,
  Boleto_gnState(Boleto.Id)                                              as State_Id,
  to_char(Boleto.DtVencto,'dd/mm/yyyy')                                  as DtVencto,
  to_char(Boleto.Valor,'999G990D99')                                     as ValorOriginal,
  Boleto.Valor                                                           as Boleto_Valor,
  Boleto_gnValorLight(Boleto.Id,Recebimento.DtPagto)                     as ValorBoleto,
  Boleto.NossoNum                                                        as NossoNum,
  Boleto.Referencia                                                      as Referencia,
  Recebimento.DtPagto                                                    as DtPagto,
  Recebimento.Valor                                                      as ValorPago,
  trunc(recebimento.dtpagto) - trunc(boleto.dtvencto)                    as PagoDia,
  Boleto_gnValorLight(Boleto.Id,Recebimento.DtPagto) - Recebimento.Valor as Dif, 
  WPessoa.Nome                                                           as NomeAluno,
  WPessoa.Codigo                                                         as Ra,  
  92200000000014                                                         as Tipo,
  Boleto.Valor-Recebimento.Valor                                         as DifValorOriginal
from
  WPessoa,
  Boleto,
  Recebimento
where
  Recebimento.DtPagto between p_O_Data1 and p_O_Data2
and
  Boleto.WPessoa_Sacado_Id = WPessoa.Id
and
  recebimento.parcel_origem_id is null
and
  recebimento.boleto_origem_id is null
and 
  Recebimento.Valor >= Boleto.Valor 
and
  ( 
    recebimento.baixamti_id is null
  or
    (
      recebimento.baixamti_id is not null 
    and
      trunc(recebimento.dt) = trunc(sysdate)
    )
  )
and
  BoletoTi_Id in (92200000000012,92200000000010,92200000000003,92200000000002,92200000000013,92200000000014,92200000000015,92200000000018,92200000000019)
and
  Boleto.Id = Recebimento.Boleto_Id
and
  Boleto.DtVencto < Recebimento.DtPagto
and
  (
    Boleto.BoletoTi_Id = p_BoletoTi_Id
  or
    p_BoletoTi_Id is null
  )
and
  (
    p_WPessoa_Id is null
    or
    wpessoa.id = nvl( p_WPessoa_Id , 0 )
  )
) Tabela
where
  DifValorOriginal <= 0
)
union
(
select
  Id,
  State_Id,
  DtVencto,
  ValorOriginal,
  ValorBoleto,
  NossoNum,
  Referencia,
  DtPagto,
  ValorPago,
  PagoDia,
  NomeAluno,
  Ra,
  ValorPago - ValorBoleto                                    as Diferenca,
  to_char((ValorPago - ValorBoleto),'9G999G990D00')          as Diferenca_Format,
  to_char(valorPago,'9G999G990D00')                          as ValorPago_Format,
  to_char(ValorBoleto,'9G999G990D00')                        as ValorBoleto_Format,  
  (Boleto_Valor - ValorPago)*-1                              as DiferencaPrincipal,
  to_char((Boleto_Valor - ValorPago)*-1,'9G999G990D00')      as DiferencaPrincipal_Format,
  Tipo
from
(
select
  Boleto.Id                                           as Id,
  Boleto_gnState(Boleto.Id)                           as State_Id,
  to_char(Boleto.DtVencto,'dd/mm/yyyy')               as DtVencto,
  to_char(Boleto.Valor,'999G990D99')                  as ValorOriginal,
  Boleto.Valor                                        as Boleto_Valor,
  Boleto_gnValorLight(Boleto.Id,Recebimento.DtPagto)  as ValorBoleto,
  Boleto.NossoNum                                     as NossoNum,
  Boleto.Referencia                                   as Referencia,
  Recebimento.DtPagto                                 as DtPagto,
  Recebimento.Valor                                   as ValorPago,
  trunc(recebimento.dtpagto) - trunc(boleto.dtvencto) as PagoDia,
  WPessoa.Nome                                        as NomeAluno,
  WPessoa.Codigo                                      as Ra,  
  92200000000012                                      as Tipo,
  Boleto.Valor-Recebimento.Valor                      as DifValorOriginal
from
  WPessoa,
  Boleto,
  Recebimento
where
  Recebimento.DtPagto between p_O_Data1 and p_O_Data2
and
  (
    Boleto.BoletoTi_Id = p_BoletoTi_Id
  or
    p_BoletoTi_Id is null
  )
and
  ( 
    recebimento.baixamti_id is null
  or
    (
      recebimento.baixamti_id is not null 
    and
      trunc(recebimento.dt) = trunc(sysdate)
    )
  )
and
  Recebimento.Boleto_Origem_Id is null
and
  Recebimento.Parcel_Origem_Id is null
and
  Boleto.Id = Recebimento.Boleto_Id 
and
  WPessoa.Id = Boleto.WPessoa_Sacado_id
and
  (
    p_WPessoa_Id is null
    or
    wpessoa.id = nvl( p_WPessoa_Id , 0 )
  )
) tabela
where
  (
    (ValorPago - ValorBoleto) < ( p_O_Valor2 * -1 )
  or
    p_O_Valor2 is null
  )
and
  (
    (Boleto_Valor - ValorPago)* -1 < ( p_O_Valor3 * -1 )
  or
    p_O_Valor3 is null
  )
)
order by $v_OrderBy