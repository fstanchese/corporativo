select 
  CA.*, 
  to_char(CA.Numero,'00') || '/' || to_char(CA.Data,'YY')   as NUMERO_F, 
  to_char(Data,'"São Paulo, " DD " de " Month " de " YYYY') as DATA_CA_SP 
from 
  CA 
where 
  id = nvl( p_CA_Id ,0)
