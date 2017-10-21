select
  WOcorr.Id                                as Id,
  WPessoa_gsRecognize(WPessoa_Id)          as WPessoa_Recognize,
  to_char(WOcorr.Dt,'dd/mm/yyyy HH24:mi')  as Data,
  Us                                       as Usuario,
  nvl(Num,WOcorr_gnNumOcorrencia(ID))      as Ocorrencia
from
  WOcorr
where
  trunc(dt) between p_O_Data1 and p_O_Data2
and
  State_Id = p_State_Id
order by
  WPessoa_Recognize
