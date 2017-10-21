select
  distinct(valor)         as Valor
from
  PagtoP
where
  nvl ( p_PagtoP_Parcela , PagtoP.Parcela ) = PagtoP.Parcela
and
  Pagto_Id = p_Pagto_Id 

