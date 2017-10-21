select
  count(Recebimento.Id) as qtde
from
  Recebimento,
  Boleto
where
  Recebimento.Boleto_Id = Boleto.Id
and
  Recebimento.Boleto_Id = p_Boleto_Id
