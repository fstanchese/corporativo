select
count(*) as VALOR,
to_char(solicitacao,'MM/YY') as NOME
from
wocorr
where
solicitacao between p_O_Data1 and p_O_Data2
and
state_id = 3000000001002
and
us='USJT'
group by to_char(solicitacao,'MM/YY')
order by 2