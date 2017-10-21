(
SELECT
	dcbolsa.id				 																	AS COD_LANC_ALUNO_EXT,
	MATRIC_GSCODALUNOEXT( nvl( nvl( matric.matric_pai_id, matric.id ), tempstrito.matric_id ) )	AS COD_ALUNO_EXT,
	Bolsati_Id || Decode(nvl(bolsa.Valor,0),0,'PC','VM')										AS COD_LANCAMENTO_EXT,
	dcbolsa.dtprevisao																			AS DAT_INI_LANCAMENTO,
	dcbolsa.dtprevisao																			AS DAT_FIM_LANCAMENTO,
	dcbolsa.vlrusado																			AS VAL_LANCAMENTO,
	NULL 																						AS VAL_SALDO,
	NULL 																						AS IND_CONDICIONADO_VENC,
	NULL																						AS COD_SOLICITACAO_EXT,
	NULL																						AS COD_EMPRESA_EXT
FROM
	bolsa inner join (((debcred dcbolsa inner join debcred dcmatric on dcmatric.id = dcbolsa.debcred_credbolsa_id )
	inner join matric on dcmatric.matric_origem_id = matric.id )  
	left OUTER join tempstrito on dcmatric.tempstrito_origem_id = tempstrito.id ) 
	on bolsa.id = dcbolsa.bolsa_origem_id
where
	dcbolsa.state_id <> 3000000016003
and
	dcmatric.state_id <> 3000000016003
)
union
(
SELECT
	debcred.id 																		AS COD_LANC_ALUNO_EXT,
	Matric_gsCodAlunoExt(wocorrinf_gsretconteudo(wocorr.id,5))						AS COD_ALUNO_EXT,
	'92200000000004'																AS COD_LANCAMENTO_EXT,
	debcred.dtprevisao																AS DAT_INI_LANCAMENTO,
	debcred.dtprevisao																AS DAT_FIM_LANCAMENTO,
	debcred.vlrusado																AS VAL_LANCAMENTO,
	NULL 																			AS VAL_SALDO,
	NULL 																			AS IND_CONDICIONADO_VENC,
	wocorr.id							 											AS COD_SOLICITACAO_EXT,
	NULL																			AS COD_EMPRESA_EXT
FROM
	wocorr inner join debcred on wocorr.id = debcred.wocorr_origem_id
)
union
(
SELECT
	boletoti_id || boleto.id																		AS COD_LANC_ALUNO_EXT,
	Matric_gsCodAlunoExt(WPessoa_gnMatricula(boleto.wpessoa_sacado_id, to_char(boleto.dt,'yyyy')))	AS COD_ALUNO_EXT,
	boletoti_id																						AS COD_LANCAMENTO_EXT,
	boleto.dt																						AS DAT_INI_LANCAMENTO,
	boleto.dt																						AS DAT_FIM_LANCAMENTO,
	boleto.valor																					AS VAL_LANCAMENTO,
	NULL 																							AS VAL_SALDO,
	NULL 																							AS IND_CONDICIONADO_VENC,
	NULL								 															AS COD_SOLICITACAO_EXT,
	NULL																							AS COD_EMPRESA_EXT
FROM
	boleto 
where
	boletoti_id in ( 92200000000002, 92200000000005, 92200000000006, 92200000000008, 92200000000009, 92200000000010, 92200000000012, 92200000000013, 92200000000014, 92200000000015, 92200000000018, 92200000000019)   
)
union
(
SELECT
	boletoitem.id																					AS COD_LANC_ALUNO_EXT,
	Matric_gsCodAlunoExt(WPessoa_gnMatricula(boleto.wpessoa_sacado_id, to_char(boleto.dt,'yyyy')))	AS COD_ALUNO_EXT,
	boletoitemti_id																					AS COD_LANCAMENTO_EXT,
	boletoitem.dt																					AS DAT_INI_LANCAMENTO,
	boletoitem.dt																					AS DAT_FIM_LANCAMENTO,
	boletoitem.valor																				AS VAL_LANCAMENTO,
	NULL 																							AS VAL_SALDO,
	NULL 																							AS IND_CONDICIONADO_VENC,
	NULL								 															AS COD_SOLICITACAO_EXT,
	NULL																							AS COD_EMPRESA_EXT
FROM
	boletoitem inner join boleto on boleto.id = boletoitem.boleto_id 
where
	boletoitemti_id not in ( 166600000000033, 166600000000041, 166600000000042 )
and
	boletoitem.state_id = 3000000017001
)