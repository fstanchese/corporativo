select
  WOcorrHi.Old,
  WOcorrHi.New,
  WOcorrHi.Col,
  upper(WOcorrHi.Us) as Usuario,
  to_char(WOcorrHi.Dt,'dd/mm/yyyy hh24:mi:ss') as Data
from
  WOcorrHi
where
  (
    WOcorrHi.Old = p_O_Old
  or
    p_O_Old is null
  )
and
  (
    WOcorrHi.New = p_O_New
  or
    p_O_New is null
  )
and
  (
    upper(WOcorrHi.Col) = upper( p_O_Col )
  or
    p_O_Col is null
  )
and
  WOcorr_Id = p_WOcorr_Id 
order by
  WOcorrHi.Dt desc