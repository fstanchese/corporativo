select
  count(id) as count 
from
  Boleto
where
  Boleto_gnState(Id,sysdate, nvl( p_Boleto_Considerar , 'CONSIDERAR_ABERTO' ) ) = 3000000000002
and
  state_base_id != 3000000000007
and
  ( 
    (
      p_BoletoTi_Id is null
    and
      BoletoTi_Id in (92200000000002,92200000000003,92200000000010,92200000000012)
    )
    or
    ( 
      p_BoletoTi_Id is not null
    and
      p_BoletoTi_Id = BoletoTi_Id
    )
  )
and
  WPessoa_Sacado_Id = nvl ( p_WPessoa_Id ,0)
