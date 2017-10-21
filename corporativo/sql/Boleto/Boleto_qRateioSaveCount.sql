select
 count(boleto.id) as qtd
from
 rateiobol,
 boleto 
where
 boleto.id = rateiobol.boleto_dest_Id 
and
 boleto.boletoti_id in ( 92200000000002 , 92200000000003, 92200000000009, 92200000000010 ) 
and
 state_base_id <> 3000000000001 
and
 boleto.ltxt is null