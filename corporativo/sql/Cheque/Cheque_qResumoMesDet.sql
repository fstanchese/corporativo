select
  count(id)                         as Qtde,
  to_char(sum(valor), '999G999D99') as Valor
from
  cheque
where
  to_char(dtemissao,'yyyy/mm') = '$v_Periodo'
and
  ChequeMov_gsCobrancaExterna(id) = '$v_Empresa'
group by
  chequemov_gscobrancaexterna(id)