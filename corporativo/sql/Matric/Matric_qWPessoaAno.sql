(
select
  Matric.Id                           as Matric_Id,
  Matric.State_Id                     as State_Id,
  Matric.MatricTi_Id                  as MatricTi_Id,
  Matric.DtState                      as DtState,
  to_char(Matric.DtState, 'mm')       as MesState,
  to_char(Matric.DtState, 'dd')       as DiaState,
  to_char(Matric.DtState, 'yyyy')     as AnoState,
  to_char(Matric.DtState, 'yyyymmdd') as DtStateCompara,
  TurmaOfe.id                         as TurmaOfe_Id,
  PLetivo.Id                          as PLetivo_Id,
  Matric.WPessoa_Id                   as WPessoa_Id,
  Curr.Id                             as Curr_Id,
  Turma.Campus_Id                     as Campus_Id,
  Curso.Id                            as Curso_Id,
  Turma.Codigo                        as CodTurma
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
  currofe.curr_id = curr.id
and
  turmaofe.currofe_id = currofe.id
and
  matric.turmaofe_id = turmaofe.id
and
  wpessoa.id = matric.wpessoa_id
and
  currofe.pletivo_id = pletivo.id
and
  (
    PLetivo.Ano_Id = nvl ( p_Ano_Id , 0 )
    or
    p_Ano_Id is null
  )
and
  (
    Matric.MatricTi_Id = nvl ( p_MatricTi_Id , 0 )
    or
    p_MatricTi_Id is null
  )
and
  matric.wpessoa_id = nvl( p_WPessoa_Id ,0)
)
union
(
select
  Matric.Id                           as Matric_Id,
  Matric.State_Id                     as State_Id,
  Matric.MatricTi_Id                  as MatricTi_Id,
  Matric.DtState                      as DtState,
  to_char(Matric.DtState, 'mm')       as MesState,
  to_char(Matric.DtState, 'dd')       as DiaState,
  to_char(Matric.DtState, 'yyyy')     as AnoState,
  to_char(Matric.DtState, 'yyyymmdd') as DtStateCompara,
  TurmaOfe.id                         as TurmaOfe_Id,
  PLetivo.Id                          as PLetivo_Id,
  Matric.WPessoa_Id                   as WPessoa_Id,
  null                                as Curr_Id,
  Turma.Campus_Id                     as Campus_Id,
  5700000000069                       as Curso_Id,
  Turma.Codigo                        as CodTurma 
from
  pletivo,
  duracxci,
  turma,
  discesp,
  turmaofe,
  matric,
  wpessoa
where
  discesp.pletivo_id = pletivo.id
and
  turma.duracxci_id = duracxci.id (+)
and
  turmaofe.turma_id = turma.id
and
  turmaofe.discesp_id = discesp.id
and
  matric.turmaofe_id = turmaofe.id
and
  wpessoa.id = matric.wpessoa_id
and
  discesp.pletivo_id = pletivo.id
and 
  (
    Matric.State_Id = nvl ( p_State_Id , 0 )
    or
    p_State_Id is null
  )
and 
  (
    Matric.MatricTi_Id = nvl ( p_MatricTi_Id , 0 )
    or
    p_MatricTi_Id is null
  )
and
  (
    PLetivo.Ano_Id = nvl ( p_Ano_Id , 0 )
    or
    p_Ano_Id is null
  )
and
  matric.wpessoa_id = nvl( p_WPessoa_Id ,0)
)
order by 11,3,2
