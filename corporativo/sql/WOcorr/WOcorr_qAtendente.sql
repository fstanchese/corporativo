select
  count(WOcorr.Us)                                   as Qtde,
  WOcorr.Us                                          as Atendente,
  WPessoa_gsUsuario(WOcorr.Us)                       as NomeAtendente,
  WOcorr.Us                                          as Id,
  WOcorr.Us || ' - ' || WPessoa_gsUsuario(WOcorr.Us) as Recognize,
  Campus_gsRecognize(WOcorr.Campus_Id)               as Campus_Recognize
from
  WOcorr 
where
  (
    WOcorr.Us = p_WOcorr_Usuario 
  or 
    p_WOcorr_Usuario is null 
  ) 
and
  (
    (
      to_char(WOcorr.Dt,'hh24:mi:ss') >= p_O_Hora1 
    and
      to_char(WOcorr.Dt,'hh24:mi:ss') <= p_O_Hora2
    )
    or
    ( p_O_Hora1 is null and p_O_Hora2 is null )
  )
and
  (
    Campus_Id = p_Campus_Id 
  or
    p_Campus_Id is null 
  )
and
  trunc(dt) between p_O_Data1 and p_O_Data2
group by
  WOcorr.Us, WOcorr.Campus_Id
order by
  NomeAtendente
