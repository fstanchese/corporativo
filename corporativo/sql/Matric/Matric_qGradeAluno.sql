(
select
  matric.id                                 as id,
  Pletivo.Nome||' - '||turmaofe_gsRetCodTurma(Matric.TurmaOfe_id)||' - '||TurmaOfe_gsRetCodSala(Matric.TurmaOfe_id)||' - '||Curr.Codigo||' - '||matricti_gsrecognize(matric.matricti_id)|| decode(matrictransf.id,null,'',' - Transferido') ||' - '|| state_gsrecognize(matric.state_id)||' - '||shortname(Curr.CurrNomeHist,80) || decode(Curr.CurrCompNome,null,'',' - ' || Curr.CurrCompNome) || decode(Curr.CurrNivelDesc,null,'',' - ' || Curr.CurrNivelDesc) as recognize,
  PLetivo.Nome||duracxci.nome||decode(matric.matricti_id,8300000000001,8300000000002,8300000000002,8300000000001) as linha
from
  matrictransf,
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
  matric.id = matrictransf.matric_id (+) 
and
  ( 
    Matric.State_Id > 3000000002000 
    and 
    Matric.State_Id <> 3000000002013 
  )
and
  currofe.pletivo_id = pletivo.id
and
  turma.duracxci_id = duracxci.id (+)
and
  turmaofe.turma_id = turma.id
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
  (
    Matric.MatricTi_Id = nvl ( p_MatricTi_Id , 0 )
  or
    p_MatricTi_Id is null
  )
and
  (
    currofe.pletivo_id = nvl ( p_PLetivo_Id , 0 )
    or
    p_PLetivo_Id is null
  )
and
  matric.wpessoa_id = nvl( p_WPessoa_Id , 0 )
)
union
(
select
  matric.id                                 as id,
  PLetivo.Nome||' - '||turma.codigo||' - '||state_gsrecognize(matric.state_id)||' - '||curso.nome as recognize,
  PLetivo.Nome||turma.codigo||state_gsrecognize(matric.state_id)||curso.nome as linha
from
  pletivo,
  duracxci,
  turma,
  curso,
  discesp,
  turmaofe,
  matric,
  wpessoa
where
  ( 
    Matric.State_Id > 3000000002000 
    and 
    Matric.State_Id <> 3000000002013 
  )
and
  discesp.pletivo_id = pletivo.id
and
  turma.duracxci_id = duracxci.id (+)
and
  curso.id = turma.curso_Id
and
  turmaofe.turma_id = turma.id
and
  turmaofe.discesp_id = discesp.id
and
  matric.turmaofe_id = turmaofe.id
and
  wpessoa.id = matric.wpessoa_id
and
  (
    Matric.MatricTi_Id = nvl ( p_MatricTi_Id , 0 )
  or
    p_MatricTi_Id is null
  )
and
  (
    discesp.pletivo_id = nvl ( p_PLetivo_Id , 0 )
    or
    p_PLetivo_Id is null
  )
and
  matric.wpessoa_id = nvl( p_WPessoa_Id , 0 )
)
order by linha desc