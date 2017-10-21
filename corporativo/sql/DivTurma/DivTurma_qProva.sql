( 
  select
    id,
    numero,
    nome as recognize 
  from
    DivTurma
  where 
    numero=99
)
 union
(
  select
    id,
    numero,
    nome as recognize 
  from
    divTurma
  where 
    numero <= p_DivTurma_Numero
  and
    numero <> 99
)
order by numero,id