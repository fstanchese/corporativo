select 
  Id                                           as Id,
  NossoNum                                     as NossoNum,
  State_Base_Id                                as State_Base_Id,
  trunc(DtVencto)                              as DtVencto,
  'R$'||to_char(Valor,'9G999D99')              as Valor,
  Referencia || ' - R$' || to_char(Boleto.Valor,'9G990D99') || ' - ' || to_char(Boleto.DtVencto,'dd/mm/yyyy') || ' - ' ||  Boleto.NossoNum as Recognize,
  State_gsRecognize(Boleto_gnState(Boleto.Id)) as State_Recognize
from 
  Boleto 
where 
  BoletoTi_Id = 92200000000005
and
  WPessoa_Sacado_Id = nvl ( p_WPessoa_Id , 0 )
