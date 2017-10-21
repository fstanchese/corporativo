select
  boleto.id,
  boleto.valor,
  boleto.referencia,
  boleto.wpessoa_sacado_id
from
  boleto
where
  boleto.id = p_Recebimento_Id