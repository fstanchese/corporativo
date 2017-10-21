select
  Carimbo.*,
  WPessoa_gsRecognize(WPessoa_Id) as Recognize
from
  Carimbo
where 
  Carimbo.WPessoa_Id in ( 1610000002341,1610000002122,1610000001441 ) 
  or
  Carimbo.Id = 122700000000019
order by Recognize