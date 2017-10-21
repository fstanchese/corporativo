
select
  ChequeMov.*,
  Cheque.Valor,
  WPessoa_gsRecognize(Cheque.WPessoa_Id) as WPessoa_Id_r,
  Cheque_gsRecognize(Cheque.Id)          as Cheque_Id_r
from
  ChequeMov,
  Cheque
where
  Cheque.Id = ChequeMov.Cheque_Id
and
  ChequeMov.id = nvl( p_ChequeMov_Id ,0)