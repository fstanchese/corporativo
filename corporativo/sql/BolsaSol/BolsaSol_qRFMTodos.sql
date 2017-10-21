oDoc ( RFM Renda Familiar Media Todos )
select 
  to_char( avg(
       nvl(bolsaSol.RENDAPRIMES,0) + nvl(bolsaSolGFam_gnRendaPriMes (  BolsaSol.id ),0) +
       nvl(bolsaSol.RENDAOUTMES,0) + nvl(bolsaSolGFam_gnRendaOutMes (  BolsaSol.id ),0))  ,'999G999G990D99') as RFM
from
  BolsaSol
where
  state_id != 3000000012001
  and
  state_id != 3000000012003
  and
  pletivo_id = nvl( p_PLetivo_Id ,0)
