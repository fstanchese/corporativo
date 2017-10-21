select
  Alinea.Alinea as Alinea
from 
  ChequeMov,
  Alinea
where
  ChequeMov.Alinea_Id = Alinea.Id
and
  ChequeMov.Cheque_Id = nvl( p_Cheque_Id ,0)
order by 
  ChequeMov.DtMovimento desc