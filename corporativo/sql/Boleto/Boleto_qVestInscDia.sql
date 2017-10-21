select 
  trunc(Boleto.Dt)              as Data,
  count(Boleto.Dt)              as Realizadas,
  count(Recebimento.DtPagto)    as Confirmadas
from 
  Boleto,
  Recebimento 
where
  Recebimento.Boleto_Id(+) = Boleto.Id 
and
  Boleto.Referencia = 'Vest 2014/2' 
group by 
  trunc(Boleto.Dt)
order by
  trunc(Boleto.Dt)
