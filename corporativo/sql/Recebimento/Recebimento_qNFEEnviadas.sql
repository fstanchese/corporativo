select
  Recebimento.*,
  to_char(Recebimento.DtPagto,'yyyymmdd')                                      as DtPagtoFormatNFe,
  Boleto.Valor                                                                 as ValorBoleto,
  to_char(Boleto_gnPrincipal(Boleto.Id),'999999D99')                           as ValorPrincipal,
  Boleto.Referencia                                                            as Referencia,
  Boleto.BoletoTi_Id                                                           as BoletoTi_Id,
  Boleto.NossoNum                                                              as NossoNum,
  BoletoTi_gsRecognize(BoletoTi_Id)                                            as BoletoTi_Recognize,
  to_char(Recebimento.Multa,'9999D99')                                         as MultaFormat,
  to_char(Recebimento.Mora,'9999D99')                                          as MoraFormat,
  to_char(Boleto.Valor,'99999D99')                                             as ValorBoletoFormat,
  to_char(Recebimento.Valor,'99999D99')                                        as ValorRecebFormat,
  Recebimento.Valor                                                            as ValorRecebido,
  to_char(Boleto.DtVencto,'dd/mm/yyyy')                                        as BoletoDtVencto,
  Recebimento.Id                                                               as Recebimento_Id,
  Recebimento.NFe                                                              as NFE
from
  recebimento,
  boleto
where
  ( 
    Boleto.BoletoTi_Id = p_BoletoTi_Id 
  or
    p_BoletoTi_Id is null
  )
and
  boleto.id=boleto_id 
and
  nferps is not null
and
  trunc(dtpagto) between p_O_Data1 and p_O_Data2
order by dtpagto

