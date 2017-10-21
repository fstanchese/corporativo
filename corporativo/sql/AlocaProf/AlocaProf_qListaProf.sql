select 
  alocaprof.professor_01_id as Professor_Id,
  professor_gsrecognize(alocaprof.professor_01_id) as Professor,
  RegTrab_gsRecognize(WPessoa.RegTrab_Id)  as RegTrab,
  Class_gsrecognize(WPessoa.Class_Id) as Classificacao,
  Professor.WPessoa_Id as WPessoa_Id
from
  alocaprof,
  professor,
  wpessoa
where
  wpessoa.id = professor.wpessoa_id
and
  alocaprof.professor_01_id = professor.id
and
  alocaprof.state_id=3000000037001
and
  alocaProf.turma_Id = nvl ( p_Turma_Id , 0 )
and
  alocaProf.currxdisc_id = nvl ( p_CurrXDisc_Id , 0 )
and
  alocaprof.pletivo_id = nvl ( p_PLetivo_Id , 0 )
union 
select 
  alocaprof.professor_02_id as Professor_Id,
  professor_gsrecognize(alocaprof.professor_02_id) as Professor,
  RegTrab_gsRecognize(WPessoa.RegTrab_Id)  as RegTrab,
  Class_gsrecognize(WPessoa.Class_Id) as Classificacao,
  Professor.WPessoa_Id as WPessoa_Id
from
  alocaprof,
  professor,
  wpessoa
where
  wpessoa.id = professor.wpessoa_id
and
  alocaprof.professor_02_id = professor.id
and
  alocaprof.state_id=3000000037001
and
  alocaProf.turma_Id = nvl ( p_Turma_Id , 0 )
and
  alocaProf.currxdisc_id = nvl ( p_CurrXDisc_Id , 0 )
and
  alocaprof.pletivo_id = nvl ( p_PLetivo_Id , 0 )
union 
select 
  alocaprof.professor_03_id as Professor_Id,
  professor_gsrecognize(alocaprof.professor_03_id) as Professor,
  RegTrab_gsRecognize(WPessoa.RegTrab_Id)  as RegTrab,
  Class_gsrecognize(WPessoa.Class_Id) as Classificacao,
  Professor.WPessoa_Id as WPessoa_Id
from
  alocaprof,
  professor,
  wpessoa
where
  wpessoa.id = professor.wpessoa_id
and
  alocaprof.professor_03_id = professor.id
and
  alocaprof.state_id=3000000037001
and
  alocaProf.turma_Id = nvl ( p_Turma_Id , 0 )
and
  alocaProf.currxdisc_id = nvl ( p_CurrXDisc_Id , 0 )
and
  alocaprof.pletivo_id = nvl ( p_PLetivo_Id , 0 )
union 
select 
  alocaprof.professor_04_id as Professor_Id,
  professor_gsrecognize(alocaprof.professor_04_id) as Professor,
  RegTrab_gsRecognize(WPessoa.RegTrab_Id)  as RegTrab,
  Class_gsrecognize(WPessoa.Class_Id) as Classificacao,
  Professor.WPessoa_Id as WPessoa_Id
from
  alocaprof,
  professor,
  wpessoa
where
  wpessoa.id = professor.wpessoa_id
and
  alocaprof.professor_04_id = professor.id
and
  alocaprof.state_id=3000000037001
and
  alocaProf.turma_Id = nvl ( p_Turma_Id , 0 )
and
  alocaProf.currxdisc_id = nvl ( p_CurrXDisc_Id , 0 )
and
  alocaprof.pletivo_id = nvl ( p_PLetivo_Id , 0 )
union 
select 
  alocaprof.professor_05_id as Professor_Id,
  professor_gsrecognize(alocaprof.professor_05_id) as Professor,
  RegTrab_gsRecognize(WPessoa.RegTrab_Id)  as RegTrab,
  Class_gsrecognize(WPessoa.Class_Id) as Classificacao,
  Professor.WPessoa_Id as WPessoa_Id
from
  alocaprof,
  professor,
  wpessoa
where
  wpessoa.id = professor.wpessoa_id
and
  alocaprof.professor_05_id = professor.id
and
  alocaprof.state_id=3000000037001
and
  alocaProf.turma_Id = nvl ( p_Turma_Id , 0 )
and
  alocaProf.currxdisc_id = nvl ( p_CurrXDisc_Id , 0 )
and
  alocaprof.pletivo_id = nvl ( p_PLetivo_Id , 0 )
union 
select 
  alocaprof.professor_06_id as Professor_Id,
  professor_gsrecognize(alocaprof.professor_06_id) as Professor,
  RegTrab_gsRecognize(WPessoa.RegTrab_Id)  as RegTrab,
  Class_gsrecognize(WPessoa.Class_Id) as Classificacao,
  Professor.WPessoa_Id as WPessoa_Id
from
  alocaprof,
  professor,
  wpessoa
where
  wpessoa.id = professor.wpessoa_id
and
  alocaprof.professor_06_id = professor.id
and
  alocaprof.state_id=3000000037001
and
  alocaProf.turma_Id = nvl ( p_Turma_Id , 0 )
and
  alocaProf.currxdisc_id = nvl ( p_CurrXDisc_Id , 0 )
and
  alocaprof.pletivo_id = nvl ( p_PLetivo_Id , 0 )
order by 2
