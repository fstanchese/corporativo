select
  Boleto.NossoNum,
  Boleto.Valor,
  to_char(Boleto.Valor,'999G999G999D99') as Valor_Format,
  Boleto.State_Base_Id,
  Boleto.DtVencto 
from
  Boleto,
  DebCred
where
  Boleto.Id = DebCred.Boleto_Destino_Id
and
  DebCred.MatricExt_Origem_Id = p_MatricExt_Id
order by
  Boleto.DtVencto
