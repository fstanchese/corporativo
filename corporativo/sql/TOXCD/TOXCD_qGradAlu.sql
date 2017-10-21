select
  TOXCD.*,
  nvl( Formacao_gnPessoaTitulo(WPESSOA_PROFRESP_ID), 15600000000000 ) as Titulo_Id,
  nvl( Formacao_gsPessoaTitulo(WPESSOA_PROFRESP_ID), 'N/C') as Titulo,
  Decode(WPessoa.Sexo_Id,500000000001,'Profª.',500000000002,'Prof.',null,'N/C')||' '||WPessoa_gsRecognize(WPESSOA_PROFRESP_ID) as ProfResp,
  WPessoa.Sexo_Id as Sexo_Id,  
  WPessoa.Id      as WPessoa_Id
from
  TOXCD,
  WPessoa
where
  WPessoa.Id (+)= TOXCD.WPESSOA_PROFRESP_ID
and
  TOXCD.TurmaOfe_Id = nvl ( p_TurmaOfe_Id , 0 )
and
  TOXCD.CurrXDisc_Id = nvl ( p_CurrXDisc_Id , 0 )