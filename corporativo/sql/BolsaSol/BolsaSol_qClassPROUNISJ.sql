select
  BolsaSol.Id                              as BolsaSol_Id,
  CurrOfe.Id                               as CurrOfe_Id,
  WPessoa_Id                               as WPessoa_Id,
  WPessoa_gnIdade(WPessoa_Id,sysdate)      as Idade,
  enemobj                                  as ENEMObj,
  enemred                                  as ENEMRed,
  Curr.CurrNomeVest || ' - ' || Campus_gsRecognize(CurrOfe.Campus_Id) || ' - ' || Periodo_gsRecognize(CurrOfe.Periodo_Id) as CurrOfe_Recognize,
  WPessoa_gnIdade(WPessoa_Id,sysdate)      as WPessoa_Idade,
  initcap(WPessoa_gsRecognize(WPessoa_Id)) as WPessoa_Recognize,
  to_char( (nvl(bolsaSol.RENDAPRIMES,0) + nvl(bolsaSolGFam_gnRendaPriMes (  BolsaSol.Id ),0 ) + nvl(bolsaSol.RENDAOUTMES,0) + nvl(bolsaSolGFam_gnRendaOutMes (  BolsaSol.Id ),0 )), '999G990D99' )   as RendaOutMes_format_sm,
  to_char( ((nvl(bolsaSol.RENDAPRIMES,0) + nvl(bolsaSolGFam_gnRendaPriMes (  BolsaSol.Id ),0 ) + nvl(bolsaSol.RENDAOUTMES,0) + nvl(bolsaSolGFam_gnRendaOutMes (  BolsaSol.Id ),0 )))/(bolsasolgfam_gnpessoas( BolsaSol.Id )+1), '999G990D99' ) as RendaOutMes_smpercapita,
  to_char( ((nvl(bolsaSol.RENDAPRIMES,0) + nvl(bolsaSolGFam_gnRendaPriMes (  BolsaSol.Id ),0 ) + nvl(bolsaSol.RENDAOUTMES,0) + nvl(bolsaSolGFam_gnRendaOutMes (  BolsaSol.Id ),0 )))/(bolsasolgfam_gnpessoas( BolsaSol.Id )+1)/415, '999G990D99' ) as RendaOutMes,
  bolsasolgfam_gnpessoas( BolsaSol.Id )+1  as GrupoFamiliar,
  nvl(WPessoa_gnCodigo(Bolsasol.WPessoa_Id),0)    as WPessoa_Codigo
from
  BolsaSol,
  CurrOfe,
  Curr
where
  CurrOfe.Curr_Id = Curr.Id
and
  BolsaSol.CurrOfe_Id = CurrOfe.Id
and
  State_Id = p_State_Id
and
  CESJProcSel_Id = p_CESJProcSel_Id
order by 
  CurrOfe.Campus_Id desc,Curr.CurrNomeVest,CurrOfe.Periodo_Id, EnemObj desc,EnemRed desc,WPessoa_gnIdade(WPessoa_Id,sysdate) desc
