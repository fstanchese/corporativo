oDoc ( RFM Renda Per Capita Media )
select 
  to_char( avg(
                ( nvl(bolsaSol.RENDAPRIMES,0) + nvl(bolsaSolGFam_gnRendaPriMes (  BolsaSol.id ),0) +
                  nvl(bolsaSol.RENDAOUTMES,0) + nvl(bolsaSolGFam_gnRendaOutMes (  BolsaSol.id ),0) ) / 
                                                  ( nvl( BolsaSolGFam_gnPessoas  ( BolsaSol.id ),0) + 1 ) ) ,'999G999G990D99') as RPCM
from
  BolsaSol
where
  state_id in ( 3000000012008, 3000000012005 )
  and
  pletivo_id = nvl( p_PLetivo_Id ,0)
