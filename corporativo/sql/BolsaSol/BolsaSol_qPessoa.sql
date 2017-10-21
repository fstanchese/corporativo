select
  BolsaSol.*,
  CESJProcsel_gsRecognize(CESJProcSel_Id) || ' - ' || State_gsRecognize(BolsaSol.State_Id) as Recognize, 
  State_gsRecognize(BolsaSol.State_Id)     as StateRecognize,
  PLetivo_gsRecognize(BolsaSol.PLetivo_Id) as PLetivoRecognize,
  to_char(BolsaSol.EnemObj,'99990D99')     as EnemObj_Format,
  to_char(BolsaSol.EnemRed,'99990D99')     as EnemRed_Format,
  to_char( ((nvl(bolsaSol.RENDAPRIMES,0) + nvl(bolsaSolGFam_gnRendaPriMes (  BolsaSol.Id ),0 ) + nvl(bolsaSol.RENDAOUTMES,0) + nvl(bolsaSolGFam_gnRendaOutMes (  BolsaSol.Id ),0 )))/(bolsasolgfam_gnpessoas( BolsaSol.Id )+1)/415, '999G990D99' ) as RendaPC
from
  BolsaSol
where
  (
    BolsaSol.State_Id = p_State_Id
  or
    p_State_Id is null
  )
and
  (
    BolsaSol.CESJProcSel_Id = p_CESJProcSel_Id
  or
    p_CESJProcSel_Id is null
  )
and
  WPessoa_Id = nvl ( p_WPessoa_Id , 0 )
order by
  dtsolicitacao desc