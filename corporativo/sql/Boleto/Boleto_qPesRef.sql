select
  Boleto.*,
  boleto_gnState(Boleto.Id,trunc(sysdate),'CONSIDERAR_QUITADO') as SITUACAO
from
  Boleto
where
  State_Base_Id <> 3000000000001
and
  Referencia = p_Boleto_Referencia
and
  WPessoa_Sacado_Id = nvl( p_WPessoa_Id ,0)