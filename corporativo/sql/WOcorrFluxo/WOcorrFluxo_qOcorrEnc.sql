select
  distinct(WOcorrFluxo.Depart_Id) as DEPART_ID 
from
  WOcorrFluxo
where
  WOcorrFluxo.WOcorr_Id = nvl( p_WOcorr_Id , 0)