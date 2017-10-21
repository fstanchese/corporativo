select
  recebimento.*,
  to_char(Recebimento.Valor,'999G999D99') as Valor_Format,
  trim(to_char(Recebimento.Multa,'999G990D90')) as Multa_Format,
  trim(to_char(Recebimento.Mora,'999G990D90'))  as Mora_Format,
  Boleto.NossoNum as NossoNum
from
  boleto,
  Recebimento
where
  boleto.id (+) = recebimento.boleto_id
and
  recebimento.id = p_Recebimento_Id
