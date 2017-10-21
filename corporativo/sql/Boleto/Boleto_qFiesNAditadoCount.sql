select
  count(boleto.id) as qtd
from
  boleto 
where 
  not exists (select
                boleto_dest_id 
              from 
                rateiobol 
              where 
                boleto.id = boleto_dest_Id ) 
and
  boletoti_id in ( 92200000000015 ) 
and
  state_base_id <> 3000000000001 
and
  boleto.ltxt is null