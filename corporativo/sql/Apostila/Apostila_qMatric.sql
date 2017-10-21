select
  Curr.Id          as Id,
  Curr.Codigo      as Codigo,
  CurrNomeApostila as CurrNomeApostila,
  Upper(CurrNomeApostila) as Recognize,
  PLetivo.Id       as PLetivo_Id,
  PLetivo.Nome     as AnoConclusao,
  matric.id        as Matric_Id
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
  Curr.Id not in 
  ( 
    select 
      curr.id 
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
      apostila,
      diplproc
    where 
      diplproc.state_id <> 3000000026011
    and
      apostila.diplproc_id=diplproc.id
    and
      p_DiplProcTi_Id <> 118900000000002
    and
      curr.id = apostila.curr_id
    and 
      Curr.CurrNomeApostila is not null
    and
      Matric.State_Id = 3000000002012 
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
      curr.titulo_id = nvl ( p_Titulo_Id ,0)
    and
      curr.curso_id = nvl( p_Curso_Id ,0)
    and
      PLetivo.Id < nvl( p_PLetivo_Limite_Id ,0)
    and
      Matric.MatricTi_Id = 8300000000001 
    and 
      diplproc.wpessoa_id=matric.wpessoa_id
    and
      matric.wpessoa_id = nvl( p_WPessoa_Id ,0)
  )
  and
  Curr.Id not in 
  ( 
    select 
      curr.id 
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
      apostila,
      diplproc
    where 
      diplproc.state_id <> 3000000026011
    and
      apostila.diplproc_id=diplproc.id
    and
      p_DiplProcTi_Id <> 118900000000002
    and
      curr.id = apostila.curr_02_id
    and 
      Curr.CurrNomeApostila is not null
    and
      Matric.State_Id = 3000000002012 
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
      curr.titulo_id = nvl ( p_Titulo_Id ,0)
    and
      curr.curso_id = nvl( p_Curso_Id ,0)
    and
      PLetivo.Id <= nvl( p_PLetivo_Limite_Id ,0)
    and
      Matric.MatricTi_Id = 8300000000001 
    and 
      diplproc.wpessoa_id=matric.wpessoa_id
    and
      matric.wpessoa_id = nvl( p_WPessoa_Id ,0)
  )
  ) 
and
  Curr.CurrNomeApostila is not null
and
  Matric.State_Id = 3000000002012 
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
  curr.titulo_id = nvl ( p_Titulo_Id ,0)
and
  curr.curso_id = nvl( p_Curso_Id ,0)
and
  PLetivo.Id <= nvl( p_PLetivo_Limite_Id ,0)
and
  Matric.MatricTi_Id = 8300000000001 
and
  matric.wpessoa_id = nvl( p_WPessoa_Id ,0)
order by AnoConclusao,DuracXCi.Sequencia,CurrNomeApostila