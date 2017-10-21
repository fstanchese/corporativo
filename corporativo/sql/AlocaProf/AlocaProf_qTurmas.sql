select 
  Turma.Id as Id,
  Turma.Codigo as Recognize,
  Turma.Periodo_Id as Periodo_Id,
  Curso.Nome as CursoNome,
  Curso.Id   as Curso_Id,
  Curr.Codigo as CurrCodigo,
  Curr.Id   as Curr_Id
from
  Curso,
  Curr,
  CurrXDisc,  
  AlocaProf,
  DuracXCi,
  Turma
where
  Curso.Id = Turma.Curso_Id
and
  CurrXDisc.Curr_Id = Curr.Id
and
  AlocaProf.Turma_Id = Turma.Id
and
  Turma.DuracXCi_Id = DuracXCi.Id 
and
  AlocaProf.CurrXDisc_Id = CurrXDisc.Id
and
  AlocaProf.State_Id = 3000000037001
and
  (
    p_Facul_Id is null
    or
    Curso.Facul_Id = nvl ( p_Facul_Id , 0 )
  )
and
  (
    p_Curr_Id is null
    or
    Curr.Id = nvl ( p_Curr_Id , 0 )
  )
and
  (
    p_Campus_Id is null
    or
    Turma.Campus_Id = nvl ( p_Campus_Id , 0 )
  )
and
  (
    p_Periodo_Id is null
    or
    Turma.Periodo_Id = nvl ( p_Periodo_Id , 0 )
  )
and
  (
    p_DuracXCi_Sequencia is null
    or
    DuracXCi.Sequencia = nvl ( p_DuracXCi_Sequencia , 0 )
  )
and
  (
    p_Curso_Id is null
    or
    Turma.Curso_Id = nvl ( p_Curso_Id , 0) 
  )
and
  AlocaProf.PLetivo_Id = nvl ( p_PLetivo_Id , 0 )
group by turma.id,turma.codigo,turma.periodo_id,curso.id,curso.nome,curr.id,curr.codigo
order by 4,3,2
