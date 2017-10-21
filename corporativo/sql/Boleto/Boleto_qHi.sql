(
select * from 
  (
  select
    old  as VALUE,
    dt   as DT
  from
    BoletoHi
  where 
    col = p_O_Col
  and
    Boleto_Id = nvl( p_Boleto_Id ,0)
  order by dt
  )
  where
  rownum = 1
)
union
(
select
  new as VALUE,
  dt  as DT
from
  BoletoHi
where
  trunc(dt) <= p_O_Data
and
  upper(col) = p_O_Col
and
  Boleto_Id = nvl( p_Boleto_Id ,0)
)
order by 2 desc
