select
  wboleto.id,
  wboleto.id+23476892634986                  as ENCID,
  wboleto.state_id                           as state_id,
  wboleto.ref                                as ref,
  p2(wboleto.ref,1)                          as ref1,
  wboleto.nossonr                            as nossonr,
  wboleto.nrdoc                              as nrdoc,
  wboleto.dtvencto                           as dtvencto,
  to_char(wboleto.dtvencto,'dd/mm/yyyy')     as DTVENCTOFORMAT ,
  to_char(wboleto.valor,'9G990D99')          as valor,
  wboleto.dtpagto                            as dtpagto,
  to_char(wboleto.valorpago,'9G990D99')      as valorpago,
  state_gsRecognize(wboleto.state_id)        as estado,
  p2(wboleto.ref,1)                          as mneumonico,
  substr(p2(wboleto.ref,2),6,2)||'/'||substr(p2(wboleto.ref,2),1,4)||substr(p2(wboleto.ref,2),8,1) as parcela,
  to_char(sysdate,'DD/MM/YYYY HH24:MI:SS')   as datahora,
  wboleto_gsAVencer ( wboleto.dtvencto )     as avencer
from
  wboleto
where
  substr(wboleto.ref,1,4) <> 'Vest'
  and
  wboleto.wpessoa_sacado_id = nvl( p_WPessoa_Id ,0)
order by
  wboleto.ref
