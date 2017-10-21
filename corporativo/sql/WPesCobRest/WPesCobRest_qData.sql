select
  WPesCobRest.*,
  WPessoa_gsRecognize(WPesCobRest.WPessoa_Id)        as WPessoa_Recognize,
  WPessoa_gnCodigo(WPesCobRest.WPessoa_Id)           as WPessoa_Codigo,
  CobRestMot_gsRecognize(WPesCobRest.CobRestMot_Id)  as CobRestMot_Recognize 
from
  WPesCobRest
where
  p_O_Data between WPesCobRest.DtInicio and nvl(WPesCobRest.DtTermino,sysdate+1000)  and dttermino is not null
order by
  WPessoa_Recognize,CobRestMot_Recognize 