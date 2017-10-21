select 
  to_char(sum(to_number(replace(replace( $v_Nota ,'ZERO',0),'.',',')))/count(*),'99.99') as Media
from 
  gradalu 
where
  trim( $v_Nota ) not in ('COLA','N/C','S/N','ERRO') 
and
  turmaofe_id = nvl( p_TurmaOfe_Id ,0)
and
  currxdisc_id = nvl( p_CurrXDisc_Id ,0)
