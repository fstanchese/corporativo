select
  matric.id,
  cursonivel.id 	as CursoNivelId,
  Turma.codigo 		as Turma, 
  Sala.Codigo 		as Sala, 
  TurmaOfe_gsRetPLetivo(Matric.TurmaOfe_Id) as PLetivo,
  State.Nome 		as Situacao,
  Curso.id   		as Curso_id,
  Periodo.Nome 		as Periodo_Nome,
  CursoNivel.Codigo as CursoNivel_Codigo,
  Matric.CriProm_id as CriProm_Id
from
  Periodo,
  matric,
  turmaofe,
  turma,
  curso,
  cursonivel,
  state,
  sala
where
    turma.periodo_id = periodo.id (+)
and
	turmaofe.sala_id = sala.id (+)
and
	state.id = matric.state_id
and
	(curso.cursonivel_id = nvl( p_CursoNivel_Id ,0) or p_CursoNivel_Id is null) 
and
	cursonivel.id = curso.cursonivel_id
and
	curso.id = turma.curso_id
and
	turma.id = turmaofe.turma_id
and
	turmaofe.id = matric.turmaofe_id
and
	matric.matricti_id = 8300000000001
and
	matric.state_id > 3000000002000
and
	matric.wpessoa_id = nvl( p_WPessoa_Id ,0)
order by data desc