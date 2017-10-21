select
  Carimbo.*,
  WPessoa_gsRecognize(WPessoa_Id) as Recognize
from
  Carimbo
where
  Carimbo.WPessoa_Id in ( 1610000002341,1600000056801,1600000026298,1610000002122,1610000001441,1610000002327 ) 
order by Recognize