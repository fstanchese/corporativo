select
  SimNao_Defer_Id
from
  WOcorrFluxo
where
  SimNao_Defer_Id is not null
and
  WOcorr_Id = p_WOcorr_Id
order by
  Id desc