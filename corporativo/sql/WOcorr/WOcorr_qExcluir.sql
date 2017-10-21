select
  wocorr.id                               as wocorr_id,
  wocorr.boleto_id                        as boleto_id,
  state_gsrecognize(boleto.state_base_id) as state,
  boleto.state_base_id                    as state_id,
  wocorr.state_id                         as st,
  recebimento.dtpagto                     as dtpagto,
  wocorr.wocorrass_id                     as wocorrass_id
from wocorr, boleto, recebimento
where boleto.id = wocorr.boleto_id
  and boleto.id = recebimento.boleto_id(+)
  and wocorr.state_id <> 3000000011008
  and wocorr.id = nvl ( p_WOcorr_Id , 0 )