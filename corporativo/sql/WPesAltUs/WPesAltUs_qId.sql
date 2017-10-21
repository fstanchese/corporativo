select
  WPesAltUs.*,
  WPessoa_gsRecognize(WPessoa_Id) as WPessoa_Label
from
  WPesAltUs
where
  Id = nvl( p_WPesAltUs_Id ,0)