select
  WOcorrInf.*
from
  WOcorrInf
where
  WOcorrInf.Informacao = p_WOcorrinf_Informacao
and
  WOcorrInf.WOcorr_Id = p_WOcorr_Id
