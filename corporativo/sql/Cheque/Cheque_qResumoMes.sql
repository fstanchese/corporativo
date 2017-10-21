select
  to_char(dtemissao, 'yyyy/mm') as Mes
from
  cheque
where
  dtemissao between p_Cheque_DtInicio and p_Cheque_DtFinal 
group by 
  to_char(dtemissao, 'yyyy/mm')