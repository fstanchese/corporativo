select
  count(boleto.id) as qtd
from
  boleto,
  wpessoa 
where
  not exists (select
                boleto_dest_id 
              from 
                rateiobol 
              where 
                boleto.id = boleto_dest_Id ) 
and
  wpessoa.id = wpessoa_sacado_id 
and
  boletoti_id in ( 92200000000002 , 92200000000003, 92200000000009, 92200000000010 ) 
and
  state_base_id <> 3000000000001 
and
  boleto.ltxt is null