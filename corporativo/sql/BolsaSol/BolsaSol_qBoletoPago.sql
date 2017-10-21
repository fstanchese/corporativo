select
  State_Base_Id
from
  Boleto 
where
  ( 
    Referencia like '%2015A%' 
  or
    (
      OrdemRef = 201501
    and
      BoletoTi_Id = 92200000000003
    )
  ) 
and
  WPessoa_Sacado_Id = p_WPessoa_Id 
order by Referencia