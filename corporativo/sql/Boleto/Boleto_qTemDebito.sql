select
  id
from
  Boleto
where
  BoletoTi_Id in (92200000000002,92200000000003,92200000000009,92200000000010,92200000000012,92200000000015,92200000000014,92200000000019)
and
  Boleto_gnState(Boleto.Id, p_O_Data , p_Boleto_Considerar ) = 3000000000002
and
  State_Base_Id != nvl ( p_Boleto_State_Base_Id , 0 )
and
  Boleto.WPessoa_Sacado_Id = p_WPessoa_Id
