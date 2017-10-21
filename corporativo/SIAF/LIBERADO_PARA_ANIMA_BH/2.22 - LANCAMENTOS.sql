(
select
	id || 'VM'								AS COD_LANCAMENTO_EXT,
	nome 									AS DSC_LANCAMENTO,
	Decode(incidematr,'on','S','N') 		AS IND_MATRICULA,
	Decode(naocumulativa, 'on', 1, 3) 		AS COD_REGRA_ACUMULO,
	bolsati.prioridade						AS NUM_PRIORIDADE_GE_C,
	Decode(naocumulativa, 'on', 'U', 'C') 	AS IDT_PRIORIDADE_GE_C,
	bolsati.prioridade						AS NUM_PRIORIDADE_GE_D,
	Decode(naocumulativa, 'on', 'U', 'C') 	AS IDT_PRIORIDADE_GE_D,
	'C'  									AS IDT_TPO_LANCAMENTO,
	'VM'									AS IDT_TPO_VALOR,
	'B' 									AS IDT_CALC_MENSALIDADE,
	case when nvl(dttermino, sysdate) < sysdate then 'N' else 'S' end  AS IND_ATIVO,
	8										AS COD_PADRAO_LANCAMENTO,
	NULL 									AS COD_ESP_LANCAMENTO
FROM
	bolsati
)	
union
(
select
	id || 'PC'								AS COD_LANCAMENTO_EXT,
	nome 									AS DSC_LANCAMENTO,
	Decode(incidematr,'on','S','N') 		AS IND_MATRICULA,
	Decode(naocumulativa, 'on', 1, 3) 		AS COD_REGRA_ACUMULO,
	bolsati.prioridade						AS NUM_PRIORIDADE_GE_C,
	Decode(naocumulativa, 'on', 'U', 'C') 	AS IDT_PRIORIDADE_GE_C,
	bolsati.prioridade						AS NUM_PRIORIDADE_GE_D,
	Decode(naocumulativa, 'on', 'U', 'C') 	AS IDT_PRIORIDADE_GE_D,
	'C'  									AS IDT_TPO_LANCAMENTO,
	'PC'									AS IDT_TPO_VALOR,
	'B' 									AS IDT_CALC_MENSALIDADE,
	case when nvl(dttermino, sysdate) < sysdate then 'N' else 'S' end  AS IND_ATIVO,
	8										AS COD_PADRAO_LANCAMENTO,
	NULL 									AS COD_ESP_LANCAMENTO
FROM
	bolsati
)	
union
(
select
	to_char(id)						AS COD_LANCAMENTO_EXT,
	nome 							AS DSC_LANCAMENTO,
	Decode(incidematr,'on','S','N') AS IND_MATRICULA,
	3 								AS COD_REGRA_ACUMULO,
	ordem							AS NUM_PRIORIDADE_GE_C,
	'U'								AS IDT_PRIORIDADE_GE_C,
	ordem							AS NUM_PRIORIDADE_GE_D,
	'U'								AS IDT_PRIORIDADE_GE_D,
	dc								AS IDT_TPO_LANCAMENTO,
	'VM'							AS IDT_TPO_VALOR,
	'B'								AS IDT_CALC_MENSALIDADE,
	'S'								AS IND_ATIVO,
	pdlancamento					AS COD_PADRAO_LANCAMENTO,
	case when pdlancamento is null then 6 else null end	AS COD_ESP_LANCAMENTO
FROM
	boletoitemti	
)
union
(
select
	to_char(id) || 'MORA'			AS COD_LANCAMENTO_EXT,
	nome 							AS DSC_LANCAMENTO,
	'S'								AS IND_MATRICULA,
	3 								AS COD_REGRA_ACUMULO,
	1								AS NUM_PRIORIDADE_GE_C,
	'U'								AS IDT_PRIORIDADE_GE_C,
	1								AS NUM_PRIORIDADE_GE_D,
	'U'								AS IDT_PRIORIDADE_GE_D,
	'D'								AS IDT_TPO_LANCAMENTO,
	'VM'							AS IDT_TPO_VALOR,
	'L'								AS IDT_CALC_MENSALIDADE,
	'S'								AS IND_ATIVO,
	3								AS COD_PADRAO_LANCAMENTO,
	6								AS COD_ESP_LANCAMENTO
FROM
	inc	
where 
	mora > 0	
)
union
(
select
	to_char(id) || 'MULTA'			AS COD_LANCAMENTO_EXT,
	nome 							AS DSC_LANCAMENTO,
	'S'								AS IND_MATRICULA,
	3 								AS COD_REGRA_ACUMULO,
	1								AS NUM_PRIORIDADE_GE_C,
	'U'								AS IDT_PRIORIDADE_GE_C,
	1								AS NUM_PRIORIDADE_GE_D,
	'U'								AS IDT_PRIORIDADE_GE_D,
	'D'								AS IDT_TPO_LANCAMENTO,
	'VM'							AS IDT_TPO_VALOR,
	'L'								AS IDT_CALC_MENSALIDADE,
	'S'								AS IND_ATIVO,
	2								AS COD_PADRAO_LANCAMENTO,
	6								AS COD_ESP_LANCAMENTO
FROM
	inc
where 
	multa > 0	
)
union
(
select
	to_char(id)						AS COD_LANCAMENTO_EXT,
	nome 							AS DSC_LANCAMENTO,
	'N'								AS IND_MATRICULA,
	3 								AS COD_REGRA_ACUMULO,
	1								AS NUM_PRIORIDADE_GE_C,
	'U'								AS IDT_PRIORIDADE_GE_C,
	1								AS NUM_PRIORIDADE_GE_D,
	'U'								AS IDT_PRIORIDADE_GE_D,
	'D'								AS IDT_TPO_LANCAMENTO,
	'VM'							AS IDT_TPO_VALOR,
	'L'								AS IDT_CALC_MENSALIDADE,
	'S'								AS IND_ATIVO,
	null							AS COD_PADRAO_LANCAMENTO,
	6								AS COD_ESP_LANCAMENTO
FROM
	boletoti
where 
	exibir = 'on'
or
	id=	92200000000009	
)