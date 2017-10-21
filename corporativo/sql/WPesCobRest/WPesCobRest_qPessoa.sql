select
  WPesCobRest.*,
  WPessoa_gsRecognize(WPessoa_Id) ||' - '|| CobRestMot_gsRecognize(CobRestMot_Id) ||' - '|| DtInicio ||' - '|| DtTermino as Recognize
from
  WPesCobRest
where
  WPesCobRest.WPessoa_Id = p_WPessoa_Id 
order by
  DtInicio