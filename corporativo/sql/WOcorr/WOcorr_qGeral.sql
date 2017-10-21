
select
  id,
  nvl(Num,WOcorr_gnNumOcorrencia(ID)) as num,
  solicitacao,
  state_gsRecognize(state_id)         as SITUACAO,
  wocorrass_gsRecognize(wocorrass_id) as ASSUNTO,
  to_char(solicitacao,'dd/mm/yyyy')   as SOLICITACAO,
  WOcorr_gsRecognize(id)              as Recognize,
  WOcorr.State_Id                     as State_Id
from 
  wocorr
where
  wpessoa_id = nvl( p_WPessoa_Id ,0)
order by
  num desc