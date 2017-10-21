select
  BolsaSol.*,
  (nvl(nvl(bolsaSol.RENDAPRIMES,0) + nvl(bolsaSolGFam_gnRendaPriMes ( BolsaSol.Id ),0)+nvl(bolsaSol.RENDAOUTMES,0) + nvl(bolsaSolGFam_gnRendaOutMes ( BolsaSol.Id ),0),0)/ 465 )/(nvl(BolsaSolGFam_gnPessoas(BolsaSol.Id),0)+1) as VALORSM_PC
from
  BolsaSol
where
  (
    BolsaSol.CESJProcSel_Id = p_BolsaSol_CESJProcSel_Id
  or
    p_BolsaSol_CESJProcSel_Id is null
  )
and
  BolsaSol.FIESTi_Id = 117200000000003
and
  BolsaSol.PLetivo_Id = nvl( p_PLetivo_Id ,0)
and
  BolsaSol.WPessoa_Id = nvl( p_WPessoa_Id ,0)
order by 
  State_Id desc