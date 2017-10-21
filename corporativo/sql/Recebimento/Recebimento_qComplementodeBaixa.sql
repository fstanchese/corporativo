select
  Recebimento.Dt || ' - ' || Boleto.NossoNum || ' - R$' || trim(to_char(Recebimento.Valor,'999G999G999D99')) as Recognize
from
  Recebimento,
  Boleto
where
  Boleto.WPessoa_Sacado_Id = p_WPessoa_Id
and
  Boleto.Id = Recebimento.Boleto_Id
and
  Recebimento.BaixaMTi_Id = 103700000000011
order by
  Recebimento.Dt