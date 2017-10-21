select 
  count(*) as qtde,
  percentual
from (
select
  case
    when (nvl(nvl(bolsaSol.RENDAPRIMES,0) + nvl(bolsaSolGFam_gnRendaPriMes ( BolsaSol.Id ),0)+nvl(bolsaSol.RENDAOUTMES,0) + nvl(bolsaSolGFam_gnRendaOutMes ( BolsaSol.Id ),0),0)/ 465 )/(nvl(BolsaSolGFam_gnPessoas(BolsaSol.Id),0)+1) <= 3  then '40%'
    when (nvl(nvl(bolsaSol.RENDAPRIMES,0) + nvl(bolsaSolGFam_gnRendaPriMes ( BolsaSol.Id ),0)+nvl(bolsaSol.RENDAOUTMES,0) + nvl(bolsaSolGFam_gnRendaOutMes ( BolsaSol.Id ),0),0)/ 465 )/(nvl(BolsaSolGFam_gnPessoas(BolsaSol.Id),0)+1) <= 4  then '30%'
    when (nvl(nvl(bolsaSol.RENDAPRIMES,0) + nvl(bolsaSolGFam_gnRendaPriMes ( BolsaSol.Id ),0)+nvl(bolsaSol.RENDAOUTMES,0) + nvl(bolsaSolGFam_gnRendaOutMes ( BolsaSol.Id ),0),0)/ 465 )/(nvl(BolsaSolGFam_gnPessoas(BolsaSol.Id),0)+1) <= 5  then '20%'
    else '0%'
  end as percentual
from
  bolsasol
where
  BolsaSol_gnRetCursoCESJ(BolsaSol.WPessoa_Id,7200000000059,'on') = p_CurrOfe_Id 
and
  bolsasol.state_id = p_State_Id
and
  BolsaSol.cesjprocsel_id = p_CESJProcSel_Id 
and
  BolsaSol.WPleito_Id = p_WPleito_Id 
)
group by percentual 
