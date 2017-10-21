(
select 
  wpessoa.id,
  wpessoa.nome,
  wpessoa.codigo as RA,
  gradaluti.nick as TIPO,
  decode(divturma_gsrecognize(gradalu.divturma_teoria_id),'Unica',null,divturma_gsrecognize(gradalu.divturma_teoria_id)) || decode(divturma_gsrecognize(gradalu.divturma_pratica_id),'Unica',null,divturma_gsrecognize(gradalu.divturma_pratica_id)) as DIVISAO
from
  gradaluti,
  gradalu,
  wpessoa,
  toxcd
where
  gradalu.gradaluti_id = gradaluti.id
and
  gradalu.state_id not in ( 3000000003002, 3000000003003 )
and
  wpessoa.id = gradalu.wpessoa_id
and
  toxcd.currxdisc_id = gradalu.currxdisc_id
and
  toxcd.turmaofe_id = gradalu.turmaofe_id
and
  toxcd.id = nvl( p_TOXCD_Id ,0)
)
union
(
select 
  wpessoa.id,
  wpessoa.nome,
  wpessoa.codigo as RA,
  gradaluti.nick as TIPO,
  decode(divturma_gsrecognize(gradalu.divturma_teoria_id),'Unica',null,divturma_gsrecognize(gradalu.divturma_teoria_id)) || decode(divturma_gsrecognize(gradalu.divturma_pratica_id),'Unica',null,divturma_gsrecognize(gradalu.divturma_pratica_id)) as DIVISAO
from
  gradaluti,
  gradalu,
  wpessoa,
  toxcd,
  turmaofe
where
  gradalu.gradaluti_id = gradaluti.id
and
  gradalu.state_id not in ( 3000000003002, 3000000003003 )
and
  wpessoa.id=gradalu.wpessoa_id
and
  turmaofe.discesp_id is not null
and
  turmaofe.id=toxcd.turmaofe_id
and
  toxcd.turmaofe_id = gradalu.turmaofe_id
and
  toxcd.id = nvl( p_TOXCD_Id ,0)
)
order by 2