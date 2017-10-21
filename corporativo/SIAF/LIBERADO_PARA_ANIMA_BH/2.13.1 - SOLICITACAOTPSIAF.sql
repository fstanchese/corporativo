select
	wocorrass.id 												as COD_TPO_SOLICITACAO_EXT,
	wocorrass.nomenet 											as DSC_TPO_SOLICITACAO,
	translate(PagtoUso_gnValorServico(WOcorrAss.Id),',','.')	as VAL_TAXA,
	decode(wocorrass.usadisciplinas,'on','S','N')				as USA_DISCIPLINAS,
	null 														as COD_GRP_SOLICITACAO,
	wocorrassflu.id												as COD_ETAPA_SOLICITACAO_EXT,
	depart_gsRecognize(depart_id)								as DSC_ETAPA_SOLICITACAO,
	nvl(wocorrassflu.prazo,0) 									as QTD_PRAZO,
	nvl(wocorrassflu.sequencia,0) 								as ORD_ETAPA,
	null														as COD_GRP_USUARIO_AVALIADOR_EXT,
	null														as DSC_GRP_USUARIO	
from
  	wocorrass,
  	wocorrassflu
where
  	wocorrassflu.wocorrass_id (+) = wocorrass.id
and
  	nomenet is not null
order by nomenet,sequencia