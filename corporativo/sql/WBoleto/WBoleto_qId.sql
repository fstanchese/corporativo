select
  WBoleto.*,
  to_char(WBoleto.Valor,'999D99') as Valor 
from
  WBoleto
where
  WBoleto.Id = nvl( p_WBoleto_Id , 0 )
