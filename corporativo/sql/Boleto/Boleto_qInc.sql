select
  Inc.Multa,
  Inc.Mora,
  Boleto.Valor,
  trunc(Boleto.DtVencto) as DtVencto
from
  Inc,
  Boleto
where
  Inc.Id = Boleto.Inc_Id
and
  Boleto.Id = nvl( p_Boleto_Id ,0)
