select
  PesqTurma.TurmaOfe_Id as Id,
  TurmaOfe_gsRetCodTurma(PesqTurma.TurmaOfe_Id) as Recognize
from
  pletivo, 
  duracxci, 
  turma,
  turmaofe,
  currofe,
  curso,
  curr,
  campus,
  pesqturma
where
  turma.campus_id=campus.id
and
  PLetivo.Id = CurrOfe.Pletivo_Id
and
  duracxci.id=turma.duracxci_id
and
  turma.id=turmaofe.turma_id
and
  turmaofe.currofe_id = currofe.id
and
  currofe.curr_id = curr.id
and
  curr.curso_id = curso.id
and
  pesqturma.turmaofe_id = turmaofe.id
and
  (
    p_CursoNivel_Id is null
    or
    Curso.CursoNivel_Id = nvl ( p_CursoNivel_Id , 0)
  )
and
  (
    ( p_PesqTurma_Sequencia is null and  nvl( p_PesqTi_Id , 0 ) = 135900000000001 ) 
    or
    PesqTurma.Sequencia = nvl ( p_PesqTurma_Sequencia , 0)
  )
and
  (
    p_Campus_Id is null
      or
    Turma.Campus_Id  = nvl(  p_Campus_Id ,0)
  )
and
  (
    p_Facul_Id is null
      or
    Curso.Facul_Id  = nvl(  p_Facul_Id ,0)
  )
and
  (
     p_DuracXCi_Sequencia is null
       or
     DuracXCi.Sequencia = nvl( p_DuracXCi_Sequencia , 0)
  )  
and
  (  
     p_Periodo_Id is null
       or
     CurrOfe.Periodo_Id = nvl( p_Periodo_Id ,0)
  )
and
 (  
     p_Curso_Id is null
       or
     Curr.Curso_Id = nvl( p_Curso_Id ,0)
  )
and
  pesqturma.semestre_id = nvl ( p_Semestre_Id , 0)
and
  pesqturma.pesqti_id = nvl( p_PesqTi_Id ,0)
and
  pesqturma.ano_id = nvl( p_Ano_Id ,0)
group by PesqTurma.TurmaOfe_Id
order by Recognize