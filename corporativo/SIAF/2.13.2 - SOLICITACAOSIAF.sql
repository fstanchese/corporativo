//Será alterado o valor do atributo Cod_Aluno_Ext, por enquanto será utilizado o WPessoa_Id
//Verificar se o US já está como COD_USUARIO_EXT com o Fernando Levadinha


select * from
(
select
	wocorr.id		 											as COD_SOLICITACAO_EXT,
	Matric_gsCodAlunoExt(wocorrinf_gsretconteudo(wocorr.id,5))	as COD_ALUNO_EXT,
	wocorr.wocorrass_id 										as COD_TPO_SOLICITACAO_EXT,
	wocorr.dt 													as DAT_SOLICITACAO,
	wocorrinf_gsretconteudo(wocorr.id,999) 						as DSC_MOTIVO,
	decode(wocorr.us,'ALUNO','A','F')							as SOL_PROTOCOLO,
	wocorr.us													as COD_USUARIO_ABERTURA_EXT,
	wocorrfluxo.id												as COD_ETAPA_SOLICITACAO_EXT,
	wocorrfluxo.state_id										as COD_STATUS_ETAPA_EXT,
	state_gsRecognize(wocorrfluxo.state_id)						as DSC_STATUS_ETAPA,
	wocorrfluxo.dt												as DAT_ABERTURA_ETAPA,
	WOcorrFluxo_gdEncaminha(WOcorr.Id, WOcorrFluxo.Id)			as DAT_CONCLUSAO_ETAPA,
	wocorrfluxo.us												as COD_USUARIO_EXT,
	WOcorrFluxo.Texto											as OBS_ETAPA,
	null														as COD_DISCIPLINA_EXT  
from
  	wocorr,
  	wocorrfluxo
where
  	wocorr.id not in (3000000011005,3000000011007,3000000011008,3000000001003)
and
  	wocorrfluxo.wocorr_id (+) = wocorr.id
) tabela
where
  COD_ALUNO_EXT is not null
  
