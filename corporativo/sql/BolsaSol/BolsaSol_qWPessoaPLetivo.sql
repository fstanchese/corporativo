select
  BolsaSol.*,
  wpessoa_gsrecognize(wpessoa_id)                               as aluno,
  state_gsrecognize(state_id)                                   as situacao,
  nvl(simnao_gsrecognize (simnao_morapais_id),'Não informado')  as simnao_morapais,
  nvl(simnao_gsrecognize (simnao_cursosup_id),'Não informado')  as simnao_cursosup,
  nvl(simnao_gsrecognize (simnao_automovel_id),'Não informado') as simnao_automovel,
  doenca_gsrecognize (doenca_id)                                as doenca,
  parentesco_gsrecognize (parentesco_falec_id)                  as parentesco_falec,
  decode(doenca_id,76910000000001,'visible','hidden'  )         as OUTRADOENCAVISIBILITY,
  RendaTi_gsRecognize    ( RendaTi_Pri_Id )                     as RENDATIPRI,
  RendaTi_gsRecognize    ( RendaTi_Out_Id )                     as RENDATIOUT,
  to_char( RendaPriMes, '999G999G999D99' )                      as RENDAPRIMES_FORMAT,
  to_char( RendaOutMes, '999G999G999D99' )                      as RENDAOUTMES_FORMAT,
  to_char( Aluguel,     '999G999G999D99' )                      as ALUGUEL_FORMAT,
  Parentesco_gsRecognize ( PARENTESCO_OUTRO_ID )                as PARENTESCO_OUTRO_ID_R,
  WPessoa_gnCodigo(WPessoa_Parente_Id)                          as Parentesco_Codigo,
  to_char( OUTRADOENCADESPESA, '999G999G999D99' )               as OUTRADOENCADESPESA_FORMAT,
  to_char( DTSOLICITACAO, 'DD/MM/YYYY HH24"h"MI"m"' )           as DTSOLICITACAO_FORMAT
from
  BolsaSol
where
  (
    BolsaSol.CESJProcSel_Id = p_BolsaSol_CESJProcSel_Id
  or
    BolsaSol.CESJProcSel_Id is null
  )
and
  (
    BolsaSol.FIESTi_Id = p_BolsaSol_FIESTi_Id
  or
    p_BolsaSol_FIESTi_Id is null
  )
and
  State_Id != 3000000012003
and
  PLetivo_Id = p_PLetivo_Id
and
  WPessoa_Id = p_WPessoa_Id
