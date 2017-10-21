select * from (
select
  wpessoa.id   as wpessoa_id,
  wpessoa.nome as professor
from
  wpessoa,
  curso,
  turma,
  alocaprof,
  professor
where
  wpessoa.id = professor.wpessoa_id
and
  alocaprof.professor_01_id=professor.id
and
  alocaProf.turma_Id = turma.id
and
  alocaProf.state_Id = 3000000037001
and
  turma.curso_id = curso.id
and
  (
    p_Facul_Id is null
    or
    curso.facul_id = p_Facul_Id 
  )
and
  (
    p_Campus_Id is null
    or
    turma.campus_Id = nvl ( p_Campus_Id , 0 )
  )
and
  (
    p_Periodo_Id is null
    or
    turma.periodo_Id = nvl ( p_Periodo_Id , 0 )
  )
and
  (
    p_Curso_Id is null
    or
    turma.curso_Id = nvl ( p_Curso_Id , 0) 
  )
and
  (
    p_Class_Id is null
    or
    WPessoa.Class_Id = nvl ( p_Class_Id , 0)
  )
and
  (
    p_RegTrab_Id is null
    or 
    WPessoa.RegTrab_Id = nvl ( p_RegTrab_Id , 0)
  )
and
  alocaprof.pletivo_id = nvl ( p_PLetivo_Id , 0 )
union
select
  wpessoa.id   as wpessoa_id,
  wpessoa.nome as professor
from
  wpessoa,
  curso,
  turma,
  alocaprof,
  professor
where
  wpessoa.id = professor.wpessoa_id
and
  alocaprof.professor_02_id=professor.id
and
  alocaProf.turma_Id = turma.id
and
  alocaProf.state_Id = 3000000037001
and
  turma.curso_id = curso.id
and
  (
    p_Facul_Id is null
    or
    curso.facul_id = p_Facul_Id 
  )
and
  (
    p_Campus_Id is null
    or
    turma.campus_Id = nvl ( p_Campus_Id , 0 )
  )
and
  (
    p_Periodo_Id is null
    or
    turma.periodo_Id = nvl ( p_Periodo_Id , 0 )
  )
and
  (
    p_Curso_Id is null
    or
    turma.curso_Id = nvl ( p_Curso_Id , 0) 
  )
and
  (
    p_Class_Id is null
    or
    WPessoa.Class_Id = nvl ( p_Class_Id , 0)
  )
and
  (
    p_RegTrab_Id is null
    or 
    WPessoa.RegTrab_Id = nvl ( p_RegTrab_Id , 0)
  )
and
  alocaprof.pletivo_id = nvl ( p_PLetivo_Id , 0 )
union
select
  wpessoa.id   as wpessoa_id,
  wpessoa.nome as professor
from
  wpessoa,
  curso,
  turma,
  alocaprof,
  professor
where
  wpessoa.id = professor.wpessoa_id
and
  alocaprof.professor_03_id=professor.id
and
  alocaProf.turma_Id = turma.id
and
  alocaProf.state_Id = 3000000037001
and
  turma.curso_id = curso.id
and
  (
    p_Facul_Id is null
    or
    curso.facul_id = p_Facul_Id 
  )
and
  (
    p_Campus_Id is null
    or
    turma.campus_Id = nvl ( p_Campus_Id , 0 )
  )
and
  (
    p_Periodo_Id is null
    or
    turma.periodo_Id = nvl ( p_Periodo_Id , 0 )
  )
and
  (
    p_Curso_Id is null
    or
    turma.curso_Id = nvl ( p_Curso_Id , 0) 
  )
and
  (
    p_Class_Id is null
    or
    WPessoa.Class_Id = nvl ( p_Class_Id , 0)
  )
and
  (
    p_RegTrab_Id is null
    or 
    WPessoa.RegTrab_Id = nvl ( p_RegTrab_Id , 0)
  )
and
  alocaprof.pletivo_id = nvl ( p_PLetivo_Id , 0 )
union
select
  wpessoa.id   as wpessoa_id,
  wpessoa.nome as professor
from
  wpessoa,
  curso,
  turma,
  alocaprof,
  professor
where
  wpessoa.id = professor.wpessoa_id
and
  alocaprof.professor_04_id=professor.id
and
  alocaProf.turma_Id = turma.id
and
  alocaProf.state_Id = 3000000037001
and
  turma.curso_id = curso.id
and
  (
    p_Facul_Id is null
    or
    curso.facul_id = p_Facul_Id 
  )
and
  (
    p_Campus_Id is null
    or
    turma.campus_Id = nvl ( p_Campus_Id , 0 )
  )
and
  (
    p_Periodo_Id is null
    or
    turma.periodo_Id = nvl ( p_Periodo_Id , 0 )
  )
and
  (
    p_Curso_Id is null
    or
    turma.curso_Id = nvl ( p_Curso_Id , 0) 
  )
and
  (
    p_Class_Id is null
    or
    WPessoa.Class_Id = nvl ( p_Class_Id , 0)
  )
and
  (
    p_RegTrab_Id is null
    or 
    WPessoa.RegTrab_Id = nvl ( p_RegTrab_Id , 0)
  )
and
  alocaprof.pletivo_id = nvl ( p_PLetivo_Id , 0 )
union
select
  wpessoa.id   as wpessoa_id,
  wpessoa.nome as professor
from
  wpessoa,
  curso,
  turma,
  alocaprof,
  professor
where
  wpessoa.id = professor.wpessoa_id
and
  alocaprof.professor_05_id=professor.id
and
  alocaProf.turma_Id = turma.id
and
  alocaProf.state_Id = 3000000037001
and
  turma.curso_id = curso.id
and
  (
    p_Facul_Id is null
    or
    curso.facul_id = p_Facul_Id 
  )
and
  (
    p_Campus_Id is null
    or
    turma.campus_Id = nvl ( p_Campus_Id , 0 )
  )
and
  (
    p_Periodo_Id is null
    or
    turma.periodo_Id = nvl ( p_Periodo_Id , 0 )
  )
and
  (
    p_Curso_Id is null
    or
    turma.curso_Id = nvl ( p_Curso_Id , 0) 
  )
and
  (
    p_Class_Id is null
    or
    WPessoa.Class_Id = nvl ( p_Class_Id , 0)
  )
and
  (
    p_RegTrab_Id is null
    or 
    WPessoa.RegTrab_Id = nvl ( p_RegTrab_Id , 0)
  )
and
  alocaprof.pletivo_id = nvl ( p_PLetivo_Id , 0 )
union
select
  wpessoa.id   as wpessoa_id,
  wpessoa.nome as professor
from
  wpessoa,
  curso,
  turma,
  alocaprof,
  professor
where
  wpessoa.id = professor.wpessoa_id
and
  alocaprof.professor_06_id=professor.id
and
  alocaProf.turma_Id = turma.id
and
  alocaProf.state_Id = 3000000037001
and
  turma.curso_id = curso.id
and
  (
    p_Facul_Id is null
    or
    curso.facul_id = p_Facul_Id 
  )
and
  (
    p_Campus_Id is null
    or
    turma.campus_Id = nvl ( p_Campus_Id , 0 )
  )
and
  (
    p_Periodo_Id is null
    or
    turma.periodo_Id = nvl ( p_Periodo_Id , 0 )
  )
and
  (
    p_Curso_Id is null
    or
    turma.curso_Id = nvl ( p_Curso_Id , 0) 
  )
and
  (
    p_Class_Id is null
    or
    WPessoa.Class_Id = nvl ( p_Class_Id , 0)
  )
and
  (
    p_RegTrab_Id is null
    or 
    WPessoa.RegTrab_Id = nvl ( p_RegTrab_Id , 0)
  )
and
  alocaprof.pletivo_id = nvl ( p_PLetivo_Id , 0 )
union
select
  wpessoa.id   as wpessoa_id,
  wpessoa.nome as professor
from
  wpessoa,
  curso,
  turma,
  alocaprof,
  professor
where
  wpessoa.id = professor.wpessoa_id
and
  alocaprof.professor_01_id=professor.id
and
  alocaProf.turma_Id = turma.id
and
  alocaProf.state_Id = 3000000037001
and
  turma.curso_id = curso.id
and
  (
    p_Facul_Id is null
    or
    curso.facul_id = p_Facul_Id 
  )
and
  (
    p_Campus_Id is null
    or
    turma.campus_Id = nvl ( p_Campus_Id , 0 )
  )
and
  (
    p_Periodo_Id is null
    or
    turma.periodo_Id = nvl ( p_Periodo_Id , 0 )
  )
and
  (
    p_Curso_Id is null
    or
    turma.curso_Id = nvl ( p_Curso_Id , 0) 
  )
and
  (
    p_Class_Id is null
    or
    WPessoa.Class_Id = nvl ( p_Class_Id , 0)
  )
and
  (
    p_RegTrab_Id is null
    or 
    WPessoa.RegTrab_Id = nvl ( p_RegTrab_Id , 0)
  )
and
  alocaprof.pletivo_id = nvl ( p_PLetivo_Pai_Id , 0 )
union
select
  wpessoa.id   as wpessoa_id,
  wpessoa.nome as professor
from
  wpessoa,
  curso,
  turma,
  alocaprof,
  professor
where
  wpessoa.id = professor.wpessoa_id
and
  alocaprof.professor_02_id=professor.id
and
  alocaProf.turma_Id = turma.id
and
  alocaProf.state_Id = 3000000037001
and
  turma.curso_id = curso.id
and
  (
    p_Facul_Id is null
    or
    curso.facul_id = p_Facul_Id 
  )
and
  (
    p_Campus_Id is null
    or
    turma.campus_Id = nvl ( p_Campus_Id , 0 )
  )
and
  (
    p_Periodo_Id is null
    or
    turma.periodo_Id = nvl ( p_Periodo_Id , 0 )
  )
and
  (
    p_Curso_Id is null
    or
    turma.curso_Id = nvl ( p_Curso_Id , 0) 
  )
and
  (
    p_Class_Id is null
    or
    WPessoa.Class_Id = nvl ( p_Class_Id , 0)
  )
and
  (
    p_RegTrab_Id is null
    or 
    WPessoa.RegTrab_Id = nvl ( p_RegTrab_Id , 0)
  )
and
  alocaprof.pletivo_id = nvl ( p_PLetivo_Pai_Id , 0 )
union
select
  wpessoa.id   as wpessoa_id,
  wpessoa.nome as professor
from
  wpessoa,
  curso,
  turma,
  alocaprof,
  professor
where
  wpessoa.id = professor.wpessoa_id
and
  alocaprof.professor_03_id=professor.id
and
  alocaProf.turma_Id = turma.id
and
  alocaProf.state_Id = 3000000037001
and
  turma.curso_id = curso.id
and
  (
    p_Facul_Id is null
    or
    curso.facul_id = p_Facul_Id 
  )
and
  (
    p_Campus_Id is null
    or
    turma.campus_Id = nvl ( p_Campus_Id , 0 )
  )
and
  (
    p_Periodo_Id is null
    or
    turma.periodo_Id = nvl ( p_Periodo_Id , 0 )
  )
and
  (
    p_Curso_Id is null
    or
    turma.curso_Id = nvl ( p_Curso_Id , 0) 
  )
and
  (
    p_Class_Id is null
    or
    WPessoa.Class_Id = nvl ( p_Class_Id , 0)
  )
and
  (
    p_RegTrab_Id is null
    or 
    WPessoa.RegTrab_Id = nvl ( p_RegTrab_Id , 0)
  )
and
  alocaprof.pletivo_id = nvl ( p_PLetivo_Pai_Id , 0 )
union
select
  wpessoa.id   as wpessoa_id,
  wpessoa.nome as professor
from
  wpessoa,
  curso,
  turma,
  alocaprof,
  professor
where
  wpessoa.id = professor.wpessoa_id
and
  alocaprof.professor_04_id=professor.id
and
  alocaProf.turma_Id = turma.id
and
  alocaProf.state_Id = 3000000037001
and
  turma.curso_id = curso.id
and
  (
    p_Facul_Id is null
    or
    curso.facul_id = p_Facul_Id 
  )
and
  (
    p_Campus_Id is null
    or
    turma.campus_Id = nvl ( p_Campus_Id , 0 )
  )
and
  (
    p_Periodo_Id is null
    or
    turma.periodo_Id = nvl ( p_Periodo_Id , 0 )
  )
and
  (
    p_Curso_Id is null
    or
    turma.curso_Id = nvl ( p_Curso_Id , 0) 
  )
and
  (
    p_Class_Id is null
    or
    WPessoa.Class_Id = nvl ( p_Class_Id , 0)
  )
and
  (
    p_RegTrab_Id is null
    or 
    WPessoa.RegTrab_Id = nvl ( p_RegTrab_Id , 0)
  )
and
  alocaprof.pletivo_id = nvl ( p_PLetivo_Pai_Id , 0 )
union
select
  wpessoa.id   as wpessoa_id,
  wpessoa.nome as professor
from
  wpessoa,
  curso,
  turma,
  alocaprof,
  professor
where
  wpessoa.id = professor.wpessoa_id
and
  alocaprof.professor_05_id=professor.id
and
  alocaProf.turma_Id = turma.id
and
  alocaProf.state_Id = 3000000037001
and
  turma.curso_id = curso.id
and
  (
    p_Facul_Id is null
    or
    curso.facul_id = p_Facul_Id 
  )
and
  (
    p_Campus_Id is null
    or
    turma.campus_Id = nvl ( p_Campus_Id , 0 )
  )
and
  (
    p_Periodo_Id is null
    or
    turma.periodo_Id = nvl ( p_Periodo_Id , 0 )
  )
and
  (
    p_Curso_Id is null
    or
    turma.curso_Id = nvl ( p_Curso_Id , 0) 
  )
and
  (
    p_Class_Id is null
    or
    WPessoa.Class_Id = nvl ( p_Class_Id , 0)
  )
and
  (
    p_RegTrab_Id is null
    or 
    WPessoa.RegTrab_Id = nvl ( p_RegTrab_Id , 0)
  )
and
  alocaprof.pletivo_id = nvl ( p_PLetivo_Pai_Id , 0 )
union
select
  wpessoa.id   as wpessoa_id,
  wpessoa.nome as professor
from
  wpessoa,
  curso,
  turma,
  alocaprof,
  professor
where
  wpessoa.id = professor.wpessoa_id
and
  alocaprof.professor_06_id=professor.id
and
  alocaProf.turma_Id = turma.id
and
  alocaProf.state_Id = 3000000037001
and
  turma.curso_id = curso.id
and
  (
    p_Facul_Id is null
    or
    curso.facul_id = p_Facul_Id 
  )
and
  (
    p_Campus_Id is null
    or
    turma.campus_Id = nvl ( p_Campus_Id , 0 )
  )
and
  (
    p_Periodo_Id is null
    or
    turma.periodo_Id = nvl ( p_Periodo_Id , 0 )
  )
and
  (
    p_Curso_Id is null
    or
    turma.curso_Id = nvl ( p_Curso_Id , 0) 
  )
and
  (
    p_Class_Id is null
    or
    WPessoa.Class_Id = nvl ( p_Class_Id , 0)
  )
and
  (
    p_RegTrab_Id is null
    or 
    WPessoa.RegTrab_Id = nvl ( p_RegTrab_Id , 0)
  )
and
  alocaprof.pletivo_id = nvl ( p_PLetivo_Pai_Id , 0 )
) group by wpessoa_id,professor
order by professor
