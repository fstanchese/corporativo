select
  WPesCRXCRA.*,
  CobRestAcao_gsRecognize(WPesCRXCRA.CobRestAcao_Id) as CobRestAcao_Recognize 
from
  WPesCRXCRA
where
  WPesCRXCRA.WPesCobRest_Id = p_WPesCobRest_Id 
order by
  CobRestAcao_Recognize 