select
  Boleto.Id                                         as Id,
  Boleto.BoletoTi_Id                                as BoletoTi_Id,
  Campus_Id                                         as Campus_Id,
  to_char(valor,'999G990D99')                       as valor,
  to_char( boleto_gnvalor(boleto.id),'999G990D99')  as total,
  to_char( boleto_gnmulta(boleto.id),'999G990D99')  as multa,
  to_char( boleto_gnmora (boleto.id),'999G990D99')  as mora,
  p2(Boleto.Referencia,2)                           as ReferenciaMensalidade,
  Boleto_gnState(Boleto.Id)                         as State_Id,
  Boleto.Referencia                                 as Referencia,
  state_gsrecognize(boleto_gnstate(boleto.id))      as staterecognize,
  dtvencto,
  Campus_gsRecognize(Campus_Id)                     as Campus_Recognize
from
  Boleto,
  BoletoTi
where
  Boleto_gnState(Boleto.Id,sysdate,nvl( p_O_Texto , 'CONSIDERAR_ABERTO' ) ) in ( 3000000000002 , 3000000000005 )
and
  (
    lower ( BoletoTi.Parcelar ) = lower ( p_BoletoTi_Parcelar )
  or
    p_BoletoTi_Parcelar is null 
  )
and
  Boleto.BoletoTi_Id = BoletoTi.Id 
and
  WPessoa_Sacado_Id = nvl ( p_WPessoa_Id ,0)
order by ordemref 