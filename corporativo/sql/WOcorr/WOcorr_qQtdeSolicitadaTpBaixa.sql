select
  count(wocorr.id) as Qtde
from
  wocorr,
  boleto
where
  (
    WOcorr.Campus_Id = p_Campus_Id
  or
    p_Campus_Id is null
  )
and
  boleto.state_base_id = p_State_Id
and
  boleto.id = wocorr.Boleto_Id
and
  WOcorr.Dt between p_O_Data1 and to_date ( p_O_Data2 , 'dd/mm/yyyy hh24:mi:ss')
and
  wocorr.wocorrass_id = p_WOcorrAss_Id 