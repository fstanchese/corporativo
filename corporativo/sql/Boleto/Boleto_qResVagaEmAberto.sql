select
  Boleto.Id                                         as Id,
  Boleto_gnState(Boleto.Id)                         as State_Id,
  to_char(sysdate,'DD/MM/YYYY HH24:MI:SS')          as DataHora,
  Boleto.Referencia                                 as Referencia,
  p2(Boleto.Referencia,2)                           as ReferenciaMensalidade,
  Referencia || ' - R$' || to_char(Boleto.Valor,'9G990D99') || ' - ' || to_char(Boleto.DtVencto,'dd/mm/yyyy') || ' - ' ||  Boleto.NossoNum as Recognize, 
  State_gsRecognize(Boleto_gnState(Boleto.Id))      as Estado,
  Boleto.us                                         as US,
  Boleto.BoletoTi_Id                                as BoletoTi_Id,
  boletoti_gsrecognize(boletoti_id)                 as BOLETOTI,
  numdoc,
  dtvencto,
  to_char(valor,'999G990D99')                       as valor,
  to_char( boleto_gnmulta(boleto.id),'999G990D99')  as multa,
  to_char( boleto_gnmora (boleto.id),'999G990D99')  as mora,
  to_char( boleto_gnvalor(boleto.id),'999G990D99')  as total,
  Campus_gsRecognize(Campus_Id)                     as Campus_Recognize,
  Campus_Id                                         as Campus_Id,
  state_gsrecognize(boleto_gnstate(boleto.id))      as staterecognize  
from
  Boleto
where
  Boleto_gnState(Boleto.Id,sysdate,'CONSIDERAR_ABERTO') in ( 3000000000002 , 3000000000005 )
and
  BoletoTi_Id = 92200000000008
and
  WPessoa_Sacado_Id = nvl ( p_WPessoa_Id ,0)
order by ordemref
