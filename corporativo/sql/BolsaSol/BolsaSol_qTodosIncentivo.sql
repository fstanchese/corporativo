select
  to_char(nvl(bolsaSol.RENDAPRIMES,0) + nvl(bolsaSolGFam_gnRendaPriMes ( BolsaSol.Id ),0)+nvl(bolsaSol.RENDAOUTMES,0) + nvl(bolsaSolGFam_gnRendaOutMes ( BolsaSol.Id ),0),'999G999D99') as RendaTotalFormat,
  nvl(bolsaSol.RENDAPRIMES,0) + nvl(bolsaSolGFam_gnRendaPriMes ( BolsaSol.Id ),0)+nvl(bolsaSol.RENDAOUTMES,0) + nvl(bolsaSolGFam_gnRendaOutMes ( BolsaSol.Id ),0) as RendaTotal,
  nvl(bolsaSol.RENDAPRIMES,0) + nvl(bolsaSolGFam_gnRendaPriMes ( BolsaSol.Id ),0)      as RendaPriMes,
  nvl(bolsaSol.RENDAOUTMES,0) + nvl(bolsaSolGFam_gnRendaOutMes ( BolsaSol.Id ),0)      as RendaOutMes,
  BolsaSol.Id                                                                          as Id,
  nvl(BolsaSolGFam_gnPessoas( BolsaSol.Id ),0) + 1                                     as GrupoFamiliar,
  WPessoa_gsRecognize(WPessoa_Id)                                                      as Nome,
  WPessoa_gnCodigo(WPessoa_Id)                                                         as RA,
  BolsaSol.Dt                                                                          as DtSolicitacao,
  State_gsRecognize(state_id)                                                          as Situacao,
  BolsaSol.WPessoa_Id                                                                  as WPessoa_Id,
  State_Id                                                                             as State_Id,
  BolsaSol_gnRetCampusCESJ( BolsaSol.WPessoa_Id, p_PLetivo_Id )                        as Campus_Id,
  Campus_gsRecognize(BolsaSol_gnRetCampusCESJ( BolsaSol.WPessoa_Id, p_PLetivo_Id ))    as Campus_Recognize,
  BolsaSol_gsRetCursoCESJ( BolsaSol.WPessoa_Id, p_PLetivo_Id )                         as Curso,
  BolsaSol_gnRetCursoCESJ( BolsaSol.WPessoa_Id, p_PLetivo_Id )                         as Curso_Id,
  Periodo_gsRecognize(BolsaSol_gnRetPeriodoCESJ( BolsaSol.WPessoa_Id, p_PLetivo_Id ))  as Periodo,
  VestCla_gnClass( BolsaSol.WPessoa_Id, 7900000000024 , 1 )                            as ClassificacaoVest,
  BolsaSol.Classificacao                                                               as Classificacao,
  nvl(nvl(bolsaSol.RENDAPRIMES,0) + nvl(bolsaSolGFam_gnRendaPriMes ( BolsaSol.Id ),0)+nvl(bolsaSol.RENDAOUTMES,0) + nvl(bolsaSolGFam_gnRendaOutMes ( BolsaSol.Id ),0),0)/ p_O_Valor2 as VALORSM,
  (nvl(nvl(bolsaSol.RENDAPRIMES,0) + nvl(bolsaSolGFam_gnRendaPriMes ( BolsaSol.Id ),0)+nvl(bolsaSol.RENDAOUTMES,0) + nvl(bolsaSolGFam_gnRendaOutMes ( BolsaSol.Id ),0),0)/ p_O_Valor2 )/(nvl(BolsaSolGFam_gnPessoas(BolsaSol.Id),0)+1) as VALORSM_PC,
  to_char(nvl(nvl(bolsaSol.RENDAPRIMES,0) + nvl(bolsaSolGFam_gnRendaPriMes ( BolsaSol.Id ),0)+nvl(bolsaSol.RENDAOUTMES,0) + nvl(bolsaSolGFam_gnRendaOutMes ( BolsaSol.Id ),0),0)/ p_O_Valor2 ,'990D99') as VALORSMFORMAT,
  to_char((nvl(nvl(bolsaSol.RENDAPRIMES,0) + nvl(bolsaSolGFam_gnRendaPriMes ( BolsaSol.Id ),0)+nvl(bolsaSol.RENDAOUTMES,0) + nvl(bolsaSolGFam_gnRendaOutMes ( BolsaSol.Id ),0),0)/ p_O_Valor2 )/(nvl(BolsaSolGFam_gnPessoas(BolsaSol.Id),0)+1),'990D99') as VALORSM_PCFORMAT,
  to_char( RendaPriMes, '999G999G999D99' )                                             as RENDAPRIMES_FORMAT,
  to_char( RendaOutMes, '999G999G999D99' )                                             as RENDAOUTMES_FORMAT,
  case
    when (nvl(nvl(bolsaSol.RENDAPRIMES,0) + nvl(bolsaSolGFam_gnRendaPriMes ( BolsaSol.Id ),0)+nvl(bolsaSol.RENDAOUTMES,0) + nvl(bolsaSolGFam_gnRendaOutMes ( BolsaSol.Id ),0),0)/ p_O_Valor2 )/(nvl(BolsaSolGFam_gnPessoas(BolsaSol.Id),0)+1) <= 3  then '40%'
    when (nvl(nvl(bolsaSol.RENDAPRIMES,0) + nvl(bolsaSolGFam_gnRendaPriMes ( BolsaSol.Id ),0)+nvl(bolsaSol.RENDAOUTMES,0) + nvl(bolsaSolGFam_gnRendaOutMes ( BolsaSol.Id ),0),0)/ p_O_Valor2 )/(nvl(BolsaSolGFam_gnPessoas(BolsaSol.Id),0)+1) <= 4  then '30%'
    when (nvl(nvl(bolsaSol.RENDAPRIMES,0) + nvl(bolsaSolGFam_gnRendaPriMes ( BolsaSol.Id ),0)+nvl(bolsaSol.RENDAOUTMES,0) + nvl(bolsaSolGFam_gnRendaOutMes ( BolsaSol.Id ),0),0)/ p_O_Valor2 )/(nvl(BolsaSolGFam_gnPessoas(BolsaSol.Id),0)+1) <= 5  then '20%'
    else '0%'
  end as percentual,
  BolsaSol.PercBolsa,
  BolsaSol.DtEntregaDoc,
  BolsaSol.FIESInt,
  WPleito_gsRecognize(Bolsasol.WPleito_Id) as WPleito_Recognize
from
  BolsaSol 
where
	BolsaSol.Dt between p_Data1 and p_Data2
and
	(
		BolsaSol.WPleito_Id = p_WPleito_Id
	or
		p_WPleito_Id is null
	)
and
  (
    WPessoa_gnRetCampus( BolsaSol.WPessoa_Id , p_PLetivo_Id , 8300000000001 ) = p_Campus_Id  
  or
    p_Campus_Id is null
  ) 
and
  FIESTi_Id = 117200000000003
and
  State_Id not in 3000000012003 
and
  (
    BolsaSol_gnRetCursoCESJ( BolsaSol.WPessoa_Id, p_PLetivo_Id ) = p_Curso_Id  
  or
    p_Curso_Id is null
  ) 
and
  (
    State_Id = p_State_Id  
  or
    p_State_Id is null
  ) 
and
  PLetivo_Id = p_PLetivo_Id 
and
  BolsaSol.CESJProcSel_Id is not null
and
  (
    BolsaSol.CESJProcSel_Id = p_BolsaSol_CESJProcSel_Id
  or
    p_BolsaSol_CESJProcSel_Id is null
  )   
order by
   Nome