select
count(*) as VALOR,
substr ( wocorrass_gsrecognize ( wocorrass_id ), 1, 100 ) as NOME
from
wocorr
where
  solicitacao between p_O_Data1 and p_O_Data2
and
  state_id = 3000000011002
and
  us='ALUNO'
group by wocorrass_id
order by 2