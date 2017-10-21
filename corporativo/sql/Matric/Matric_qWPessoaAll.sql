(
select
  turmaofe_gsretpletivo(matric.turmaofe_id)                      as ano,
  matric.id                                                      as id,
  matricti_id                                                    as matricti_id,
  wpessoa.codigo                                                 as codigo,
  Upper (wpessoa.nome)                                           as nome,
  Upper (curso.nome)                                             as curso,
  turmaofe_gsretcodturma(matric.turmaofe_id)                     as turma,
  turmaofe_gsretpletivo(matric.turmaofe_id)||' - '||matricti_gsRecognize(matric.matricti_id)||'-'||duracxci.nome||' - '||state_gsrecognize(matric.state_id)||' - '||curso.nome as recognize,
  nvl(matric.data,pletivo.final)                                 as datax,
  matric.state_id                                                as state_id,
  matric.rematricula                                             as Rematricula,
  turmaofe_gnretpletivo(matric.turmaofe_id)                      as PLetivo_Id,
  pletivo_gsrecognize(turmaofe_gnretpletivo(matric.turmaofe_id)) as PLetivo,
  matric.turmaofe_Id                                             as TurmaOfe_Id,
  curso.id                                                       as curso_id,
  turmaofe_gnretperiodo(matric.turmaofe_id)                      as Periodo_Id,
  duracxci.sequencia                                             as Serie,
  Campus_gsRecognize(currofe.campus_Id)                          as Campus_Recognize,
  periodo_gsRecognize(turmaofe_gnretperiodo(matric.turmaofe_id)) as Periodo_Recognize,
  turmaofe_gnUltimoAnista(matric.turmaofe_id)                    as UltimoAno,
  substr(turmaofe_gsretpletivo(matric.turmaofe_id),1,4)          as Anopletivo,
  Curso.Nome                                                     as Curso_Nome,
  state_gsrecognize(matric.state_id)                             as Situacao,
  Matric.DtState                                                 as DtState,
  turma.codinep                                                  as codinep
from
  pletivo,
  duracxci,
  turma,
  curr,
  curso,
  currofe,
  turmaofe,
  matric,
  wpessoa
where
  ( 
    ( 
      p_State_Id is null 
        or 
      nvl( p_State_Id ,0) = matric.state_id 
    ) 
      and 
    matric.state_id not in (3000000002000,3000000002001,3000000002004,3000000002005,3000000002006,3000000002007,3000000002008,3000000002009) 
  )
and
  currofe.pletivo_id = pletivo.id
and
  turma.duracxci_id = duracxci.id (+)
and
  turmaofe.turma_id = turma.id
and
  curso.cursonivel_id in (6200000000001,6200000000003,6200000000010)
and
  curr.curso_id = curso.id
and
  (
    currofe.PLetivo_Id = p_PLetivo_Id
  or
    p_PLetivo_Id is null
  )
and
  currofe.curr_id = curr.id
and
  turmaofe.currofe_id = currofe.id
and
  matric.turmaofe_id = turmaofe.id
and
  wpessoa.id = matric.wpessoa_id
and
  (
    Matric.MatricTi_Id = p_MatricTi_Id
  or
    p_MatricTi_Id is null
  )
and
  matric.wpessoa_id = nvl( p_WPessoa_Id ,0)
)
union
(
select
  turmaofe_gsretpletivo(matric.turmaofe_id)                      as ano,
  matric.id                                                      as id,
  matricti_id                                                    as matricti_id,
  wpessoa.codigo                                                 as codigo,
  Upper (wpessoa.nome)                                           as nome,
  Upper (discesp.nome)                                           as curso,
  turmaofe_gsretcodturma(matric.turmaofe_id)                     as turma,
  turmaofe_gsretpletivo(matric.turmaofe_id)||' - '||matricti_gsRecognize(matric.matricti_id)||'-'||state_gsrecognize(matric.state_id)||' - '||discesp.nome as recognize,
  nvl(matric.data,pletivo.final)                                 as datax,
  matric.state_id                                                as state_id,
  matric.rematricula                                             as Rematricula,
  turmaofe_gnretpletivo(matric.turmaofe_id)                      as PLetivo_Id,
  pletivo_gsrecognize(turmaofe_gnretpletivo(matric.turmaofe_id)) as PLetivo,
  matric.turmaofe_Id                                             as TurmaOfe_Id,
  null                                                           as curso_id,
  turmaofe_gnretperiodo(matric.turmaofe_id)                      as Periodo_Id,
  nvl(duracxci.sequencia,0)                                      as Serie,
  Campus_gsRecognize(turma.campus_Id)                            as Campus_Recognize,
  periodo_gsRecognize(turmaofe_gnretperiodo(matric.turmaofe_id)) as Periodo_Recognize,
  0                                                              as UltimoAno,
  substr(turmaofe_gsretpletivo(matric.turmaofe_id),1,4)          as Anopletivo,
  DiscEspTi_gsRecognize(DiscEspTi_Id)                            as Curso_Nome,
  state_gsrecognize(matric.state_id)                             as Situacao,
  Matric.DtState                                                 as DtState,
  turma.codinep                                                  as codinep
from
  pletivo,
  duracxci,
  turma,
  discesp,
  turmaofe,
  matric,
  wpessoa
where
  ( 
    ( 
      p_State_Id is null 
        or 
      nvl( p_State_Id ,0) = matric.state_id 
    ) 
      and 
    matric.state_id not in (3000000002000,3000000002001,3000000002004,3000000002005,3000000002006,3000000002007,3000000002008,3000000002009) 
  )
and
  discesp.pletivo_id = pletivo.id
and
  turma.duracxci_id = duracxci.id (+)
and
  turmaofe.turma_id = turma.id
and
  (
    discesp.PLetivo_Id = p_PLetivo_Id
  or
    p_PLetivo_Id is null
  )
and
  turmaofe.discesp_id = discesp.id
and
  matric.turmaofe_id = turmaofe.id
and
  wpessoa.id = matric.wpessoa_id
and 
  (
    Matric.MatricTi_Id = p_MatricTi_Id
  or
    p_MatricTi_Id is null
  )
and
  matric.wpessoa_id = nvl( p_WPessoa_Id ,0)
)
order by 9 desc