oDoc ( RFM Renda Per Capita Media com Fatores  Todos )
select 
  to_char( avg(
       ( nvl( BolsaSol_gnTotalFatores ( BolsaSol.id ),0) / 
                                                  ( nvl( BolsaSolGFam_gnPessoas  ( BolsaSol.id ),0) + 1 ) ) ) ,'999G999G990D99') as RPCMFat
from
  BolsaSol
where
  state_id in ( 3000000012008, 3000000012005 )
  and
  pletivo_id = nvl( p_PLetivo_Id ,0)
