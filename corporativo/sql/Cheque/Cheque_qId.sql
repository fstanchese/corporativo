
select
  Cheque.*,
  Cheque_gsRecognize(Id) as Recognize,
  WPessoa_gsRecognize(WPessoa_Id) as WPessoa_Id_r
from
  Cheque
where
  Id = nvl( p_Cheque_Id ,0)