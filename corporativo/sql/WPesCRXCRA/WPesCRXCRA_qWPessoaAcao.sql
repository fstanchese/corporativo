select
  WPesCobRest.WPessoa_Id 
from
  WPesCRXCRA,
  WPesCobRest
where
  sysdate between WPesCobRest.DtInicio and nvl(WPesCobRest.DtTermino,sysdate+1)
and
  WPesCRXCRA.CobRestAcao_Id = p_CobRestAcao_Id
and
  WPesCRXCRA.WPesCobRest_Id = WPesCobRest.Id
and
  WPesCobRest.WPessoa_Id = p_WPessoa_Id
