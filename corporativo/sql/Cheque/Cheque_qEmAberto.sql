select
  CheQueMovTi_Id,
  Empresa_gsRecognize(Empresa_Id) as Empresa
from 
  ChequeMov 
where
  Cheque_Id = nvl( p_Cheque_Id ,0)
order by 
  DtMovimento desc