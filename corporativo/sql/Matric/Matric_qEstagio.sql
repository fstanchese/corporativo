(
select
  matric.id              as id,
  Pletivo.Nome||' - '||turmaofe_gsRetCodTurma(Matric.TurmaOfe_id)||' - '||Curr.Codigo||' - '||matricti_gsrecognize(matric.matricti_id) ||' - '|| state_gsrecognize(matric.state_id)||' - '||shortname(Curr.CurrNomeHist,80) || decode(Curr.CurrNivelDesc,null,Curr.CurrNivelDesc,' - ' || Curr.CurrNivelDesc) as recognize,
  PLetivo.Nome||duracxci.nome||decode(matric.matricti_id,8300000000001,8300000000002,8300000000002,8300000000001) as linha,
  nvl(matric.data,trunc(sysdate)) as datax
from
  pletivo,
  duracxci,
  turma,
  curr,
  curso,
  currofe,
  turmaofe,
  matric,
  wpessoa,
  Lograd,
  Bairro,
  Cidade,
  Estado
where
  Estado.Id (+) = Cidade.Estado_Id
and
  Cidade.Id (+) = Bairro.Cidade_Id
and
  Bairro.Id (+) = Lograd.Bairro_Id
and
  Lograd.Id (+) = WPessoa.Lograd_Id 
and
  Matric.State_Id not in ( 3000000002000,3000000002013,3000000002007,3000000002008,3000000002009 )
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
  Matric.MatricTi_Id = 8300000000001
and
  matric.wpessoa_id = nvl( p_WPessoa_Id ,0)
)
union
(
select
  matric.id              as id,
  Pletivo.Nome||' - '||turmaofe_gsRetCodTurma(Matric.TurmaOfe_id)||' - '||Curr.Codigo||' - '||currxdisc_gsretcoddisc(gradalu.currxdisc_id) ||' - '|| state_gsrecognize(matric.state_id)||' - '||shortname(Curr.CurrNomeHist,80) || decode(Curr.CurrNivelDesc,null,Curr.CurrNivelDesc,' - ' || Curr.CurrNivelDesc) as recognize,
  PLetivo.Nome||duracxci.nome||decode(matric.matricti_id,8300000000001,8300000000002,8300000000002,8300000000001) as linha,
  nvl(matric.data,trunc(sysdate)) as datax
from
  pletivo,
  duracxci,
  turma,
  curr,
  curso,
  currofe,
  turmaofe,
  matric,
  wpessoa,
  Lograd,
  Bairro,
  Cidade,
  Estado,
  GradAlu
where
  GradAlu.GradAluTi_Id < 8500000000004
and
  Matric.Id = GradAlu.Matric_Id
and
  Estado.Id (+) = Cidade.Estado_Id
and
  Cidade.Id (+) = Bairro.Cidade_Id
and
  Bairro.Id (+) = Lograd.Bairro_Id
and
  Lograd.Id (+) = WPessoa.Lograd_Id 
and
  Matric.State_Id not in ( 3000000002000,3000000002013,3000000002007,3000000002008,3000000002009 )
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
  Matric.MatricTi_Id = 8300000000002
and
  matric.wpessoa_id = nvl( p_WPessoa_Id ,0)
)
union
(
select
  matric.id              as id,
  PLetivo.Nome||' - '||turma.codigo||' - '||state_gsrecognize(matric.state_id)||' - '||curso.nome as recognize,
  PLetivo.Nome||turma.codigo||state_gsrecognize(matric.state_id)||curso.nome as linha,
  nvl(matric.data,trunc(sysdate)) as datax
from
  pletivo,
  duracxci,
  turma,
  curso,
  discesp,
  turmaofe,
  matric,
  wpessoa,
  Lograd,
  Bairro,
  Cidade,
  Estado
where
  Estado.Id (+) = Cidade.Estado_Id
and
  Cidade.Id (+) = Bairro.Cidade_Id
and
  Bairro.Id (+) = Lograd.Bairro_Id
and
  Lograd.Id (+) = WPessoa.Lograd_Id 
and
  Matric.State_Id not in ( 3000000002000,3000000002013,3000000002007,3000000002008,3000000002009 )
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
  Matric.MatricTi_Id = 8300000000002
and
  matric.wpessoa_id = nvl( p_WPessoa_Id ,0)
)
order by linha desc