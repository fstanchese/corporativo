select
	diplproc.id,
	wpessoa.codigo as ra,
	wpessoa.nome as nome,
	substr(nrprocesso,5,6)||'/'||substr(nrprocesso,1,4) as NumProc,
	state.nome as situacao,
	diplproc.state_id as state_id,
	diplproc.dtconvocacao as dtconvocacao,
	diplproc.dtconsulta as dtconsulta,
	pletivo_gsrecognize(turmaofe_gnretpletivo(matric.turmaofe_id)) as conclusao,
	modalidade_gsrecognize(modalidade_id) as modalidade
from
 	turmaofe,
 	wpessoa,
 	state,
 	diploma,
 	titulo, 
 	diplproc,
 	matric
where
	diploma.titulo_id=titulo.id(+)
and
 (
 	diploma.dtcolacao = p_DtColacao
 	or
 	diploma.dtexpedicao = p_DtColacao
 )
and
 	matric.wpessoa_id=wpessoa.id
and
 	diplproc.state_id=state.id
and
 	diploma.diplproc_id=diplproc.id
and
 	diplproc.state_id <> 3000000026011
and
 	diplproc.matric_id=matric.id
and
 	matric.turmaofe_id=turmaofe.id
and
 	turmaofe.turma_id=nvl ( p_Turma_Id , 0 )
order by wpessoa.nome,modalidade
