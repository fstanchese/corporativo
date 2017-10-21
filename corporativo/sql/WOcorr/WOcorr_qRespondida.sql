select
  distinct(WOcorr_Id)                         as Id,
  WOcorr_gnNumOcorrencia(WOcorr_Id)           as NumOcorrencia,
  WPessoa_gsRecognize(WPessoa_Id)             as WPessoa_Recognize,
  to_char(WOcorr.Dt, 'dd/mm/yyyy hh24:mi:ss') as Data_Hora
from
  WOcorrFluxo,
  WOcorr
where
  trunc(WOcorrFluxo.Dt) between p_O_Data1 and p_O_Data2
and
   WOcorrFluxo.WOcorr_Id = WOcorr.Id 
and
  WOcorrFluxo.Us = p_O_Usuario
and
  WOcorr.State_Id = 3000000011003
order by 3
  