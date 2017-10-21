oDoc ( RFM Renda Familiar Media com Fatores  Todos )
select 
  to_char( avg( nvl( BolsaSol_gnTotalFatores ( BolsaSol.id ),0) ) ,'999G999G990D99') as RFMFat
from
  BolsaSol
where
  state_id in ( 3000000012008, 3000000012005 )
  and
  pletivo_id = nvl( p_PLetivo_Id ,0)
