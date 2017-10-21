select
  CheQueMovTi_Id,
  shortname(Empresa_gsRecognize(Empresa_id),13) as Empresa
from 
  ChequeMov 
where
  Cheque_Id = nvl( p_Cheque_Id ,0)
order by 
  DtMovimento desc