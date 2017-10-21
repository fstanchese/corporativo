select
  trunc(dtpagto)                                                                                                   as DtPagto,
  sum(Boleto.Valor)                                                                                                as VlrBoleto,
  sum(Boleto_gnPrincipal(Boleto.Id))                                                                               as VlrPrincipal,
  sum(Recebimento.Multa)                                                                                           as VlrMulta,
  sum(Recebimento.Mora)                                                                                            as VlrMora,
  sum(Recebimento.Valor) - (sum(Boleto_gnPrincipal(Boleto.Id)) + sum(Recebimento.Multa) + sum(Recebimento.Mora))   as VlrEncargos,
  sum(Recebimento.Valor)                                                                                           as VlrRecebido,
  to_char(sum(Boleto.Valor),'999G999G999D99')                                                                      as VlrBoletoFormat,
  to_char(sum(Boleto_gnPrincipal(Boleto.Id)),'999G999G999D99')                                                     as VlrPrincipalFormat,
  to_char(sum(Recebimento.Multa),'999G999G990D99')                                                                 as VlrMultaFormat,
  to_char(sum(Recebimento.Mora),'999G999G990D99')                                                                  as VlrMoraFormat,
  to_char(sum(Recebimento.Valor) - (sum(Boleto_gnPrincipal(Boleto.Id)) + sum(Recebimento.Multa) + sum(Recebimento.Mora)),'999G999G990D99')   as VlrEncargosFormat,
  to_char(sum(Recebimento.Valor),'999G999G999D99')                                                                 as VlrRecebidoFormat,
  Boleto.BoletoTi_Id                                                                                               as BoletoTi_Id
from
  Boleto,
  Recebimento
where
  Recebimento.NfeNaoEnviar is null
and
  Recebimento.Parcel_Origem_Id is null
and
  Recebimento.Boleto_Origem_Id is null
and
  (
    Boleto.Competencia < p_Boleto_Competencia
  or
    p_Boleto_Competencia is null
  )
and
  (
    Boleto.Campus_Id = nvl( p_Campus_Id , 0)
  or
    p_Campus_Id is null
  )
and
  BoletoTi_Id = p_BoletoTi_Id
and
  Boleto.Id=Recebimento.Boleto_id
and
  Recebimento.dtpagto between p_O_Data1 and p_O_Data2
group by
  Recebimento.dtpagto,Boleto.BoletoTi_Id
order by
  Recebimento.dtpagto,Boleto.BoletoTi_Id
