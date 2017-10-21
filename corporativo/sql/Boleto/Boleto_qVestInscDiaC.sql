select 
  trunc(Boleto.Dt)              as Data,
  count(Boleto.Dt)              as Realizadas,
  count(Recebimento.DtPagto)    as Confirmadas
from 
  Vest,
  Recebimento,
  DebCred,
  Boleto 
where
(
  substr(Vest.Ip, 0, 14) = '200.182.49.239'
or
  substr(Vest.Ip, 0, 13) = '201.64.157.98'
or
  substr(Vest.Ip, 0, 13) = '200.178.85.21'
or
  substr(Vest.Ip, 0, 14) = '200.182.49.226'
or
  substr(Vest.Ip, 0, 8) = '10.1.0.1'
or
  substr(Vest.Ip, 0, 8) = '10.1.13.'
)
and
  Vest.WPleito_Id = 7900000000039
and
  Vest.Id = DebCred.Vest_Origem_Id
and
  DebCred.Boleto_Destino_Id = Boleto.Id
and
  Recebimento.Boleto_Id(+) = Boleto.Id 
and
  Boleto.Referencia = 'Vest 2014/2' 
group by 
  trunc(Boleto.Dt)
order by
  trunc(Boleto.Dt)