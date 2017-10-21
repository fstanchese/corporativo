
select  
  ChequeMov.*,
  ChequeMovTi_gsRecognize(ChequeMovTi_Id) as ChequeMovTi_Nome,
  Alinea_gsRecognize(ChequeMov.Alinea_Id) as Alinea_Nome,
  Cheque.Valor,
  ChequeMov.DtMovimento || ' - ' || ChequeMovTi.Nome  || ' - ' || Cheque.Numero  || ' - ' || trim(to_char(ChequeMov.VlrPago,'999B999D99')) as Recognize  
from
  ChequeMov,
  ChequeMovTi,
  Cheque
where
  ChequeMov.Cheque_Id = Cheque.Id
and
  ChequeMov.ChequeMovTi_Id = ChequeMovTi.Id
and
  ChequeMov.Cheque_Id = nvl( p_ChequeMov_Cheque_Id ,0)
order by 
  ChequeMov.DtMovimento
