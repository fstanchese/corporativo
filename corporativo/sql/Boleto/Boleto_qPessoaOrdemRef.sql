select
  Boleto.*,
  Boleto.Referencia || ' - R$' || trim(to_char(Boleto.Valor,'999G999D99')) || ' - ' || Boleto.DtVencto || ' - ' || Boleto.NossoNum as Recognize,
  WPessoa_gsRecognize(WPessoa_Sacado_Id)                        as WPessoa_Recognize,
  WPessoa_gnCodigo(WPessoa_Sacado_Id)                           as WPessoa_Codigo,
  to_char(Boleto.Valor,'9999G999G990D99')                       as Valor_Format,
  State_gsRecognize(Boleto.State_Base_Id)                       as State_Recognize,
  Recebimento_gnVlrPago(Boleto.Id)                              as Valor_Pago,
  to_char(Recebimento_gnVlrPago(Boleto.Id),'9999G999G990D99')   as Valor_PagoFormat,
  BoletoItem_gsItem(Boleto.Id,166600000000025)                  as Valor_Mensalidade
from
  Boleto
where
  (
    Boleto.BoletoTi_Id = p_Boleto_BoletoTi_Id
  or
    p_Boleto_BoletoTi_Id is null
  )
and
  (
    State_Base_Id = p_State_Id 
  or
    p_State_Id is null
  )
and
  OrdemRef between p_O_Valor1 and p_O_Valor2
and
  WPessoa_Sacado_Id = p_WPessoa_Id
order by
  OrdemRef,Referencia