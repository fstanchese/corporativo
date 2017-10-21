select
  to_char(horainicio,'hh24:mi') as horainicio,
  horario.semana_id,
  Turma.Codigo as Turma,
  CurrXDisc_gsRetCodDisc(AlocaProf.CurrXDisc_Id) as Disciplina,
  DivTurma_gsRecognize(AlocaProf.DivTurma_Id) as DivTurma,
  AulaTi_gsRecognize(AlocaProf.AulaTi_Id) as TipoAula,
  AlocXHorDt.indice as Indice, 
  AlocXHorDt.AlocaProf_Id as AlocaProf_Id,
  trunc(AlocXHorDt.DtInicio) as DtInicio        
from
  AlocaProf,
  AlocXHorDt,
  Horario,
  Turma
where
  AlocXHorDt.State_Id = 3000000010001
and
  AlocaProf.State_Id = 3000000037001
and
  AlocXHorDt.Horario_01_Id = Horario.Id
and
  AlocaProf.Turma_Id = Turma.Id
and
  AlocXHorDt.AlocaProf_Id = AlocaProf.Id
and
  (
     Horario.Periodo_Id = nvl ( p_Periodo_Id , 0 )
     or
     p_Periodo_Id is null
  )
and
  (
     Horario.Semana_Id = nvl ( p_Semana_Id , 0 )
     or
     p_Semana_Id is null
  )
and 
  trunc(AlocXHorDt.DtInicio) > p_O_Data 
and
  AlocXHorDt.Professor_Id = nvl ( p_Professor_Id , 0 )
union all
select
  to_char(horainicio,'hh24:mi') as horainicio,
  horario.semana_id,
  Turma.Codigo as Turma,
  CurrXDisc_gsRetCodDisc(AlocaProf.CurrXDisc_Id) as Disciplina,
  DivTurma_gsRecognize(AlocaProf.DivTurma_Id) as DivTurma,
  AulaTi_gsRecognize(AlocaProf.AulaTi_Id) as TipoAula,
  AlocXHorDt.indice as Indice, 
  AlocXHorDt.AlocaProf_Id as AlocaProf_Id,
  trunc(AlocXHorDt.DtInicio) as DtInicio          
from
  AlocaProf,
  AlocXHorDt,
  Horario,
  Turma
where
  AlocXHorDt.State_Id = 3000000010001
and
  AlocaProf.State_Id = 3000000037001
and
  AlocaProf.Turma_Id = Turma.Id
and
  AlocXHorDt.Horario_02_Id = Horario.Id
and
  AlocXHorDt.AlocaProf_Id = AlocaProf.Id
and
  (
     Horario.Periodo_Id = nvl ( p_Periodo_Id , 0 )
     or
     p_Periodo_Id is null
  )
and
  (
     Horario.Semana_Id = nvl ( p_Semana_Id , 0 )
     or
     p_Semana_Id is null
  )
and 
  trunc(AlocXHorDt.DtInicio) > p_O_Data 
and
  AlocXHorDt.Professor_Id = nvl ( p_Professor_Id , 0 )
union all
select
  to_char(horainicio,'hh24:mi') as horainicio,
  horario.semana_id,
  Turma.Codigo as Turma,
  CurrXDisc_gsRetCodDisc(AlocaProf.CurrXDisc_Id) as Disciplina,
  DivTurma_gsRecognize(AlocaProf.DivTurma_Id) as DivTurma,
  AulaTi_gsRecognize(AlocaProf.AulaTi_Id) as TipoAula,
  AlocXHorDt.indice as Indice, 
  AlocXHorDt.AlocaProf_Id as AlocaProf_Id,
  trunc(AlocXHorDt.DtInicio) as DtInicio          
from
  AlocaProf,
  AlocXHorDt,
  Horario,
  Turma
where
  AlocXHorDt.State_Id = 3000000010001
and
  AlocaProf.State_Id = 3000000037001
and
  AlocaProf.Turma_Id = Turma.Id
and
  AlocXHorDt.Horario_03_Id = Horario.Id
and
  AlocXHorDt.AlocaProf_Id = AlocaProf.Id
and
  (
     Horario.Periodo_Id = nvl ( p_Periodo_Id , 0 )
     or
     p_Periodo_Id is null
  )
and
  (
     Horario.Semana_Id = nvl ( p_Semana_Id , 0 )
     or
     p_Semana_Id is null
  )
and 
  trunc(AlocXHorDt.DtInicio) > p_O_Data 
and
  AlocXHorDt.Professor_Id = nvl ( p_Professor_Id , 0 )
union all
select
  to_char(horainicio,'hh24:mi') as horainicio,
  horario.semana_id,
  Turma.Codigo as Turma,
  CurrXDisc_gsRetCodDisc(AlocaProf.CurrXDisc_Id) as Disciplina,
  DivTurma_gsRecognize(AlocaProf.DivTurma_Id) as DivTurma,
  AulaTi_gsRecognize(AlocaProf.AulaTi_Id) as TipoAula,
  AlocXHorDt.indice as Indice, 
  AlocXHorDt.AlocaProf_Id as AlocaProf_Id,
  trunc(AlocXHorDt.DtInicio) as DtInicio          
from
  AlocaProf,
  AlocXHorDt,
  Horario,
  Turma
where
  AlocXHorDt.State_Id = 3000000010001
and
  AlocaProf.State_Id = 3000000037001
and
  AlocaProf.Turma_Id = Turma.Id
and
  AlocXHorDt.Horario_04_Id = Horario.Id
and
  AlocXHorDt.AlocaProf_Id = AlocaProf.Id
and
  (
     Horario.Periodo_Id = nvl ( p_Periodo_Id , 0 )
     or
     p_Periodo_Id is null
  )
and
  (
     Horario.Semana_Id = nvl ( p_Semana_Id , 0 )
     or
     p_Semana_Id is null
  )
and 
  trunc(AlocXHorDt.DtInicio) > p_O_Data 
and
  AlocXHorDt.Professor_Id = nvl ( p_Professor_Id , 0 )
union all
select
  to_char(horainicio,'hh24:mi') as horainicio,
  horario.semana_id,
  Turma.Codigo as Turma,
  CurrXDisc_gsRetCodDisc(AlocaProf.CurrXDisc_Id) as Disciplina,
  DivTurma_gsRecognize(AlocaProf.DivTurma_Id) as DivTurma,
  AulaTi_gsRecognize(AlocaProf.AulaTi_Id) as TipoAula,
  AlocXHorDt.indice as Indice, 
  AlocXHorDt.AlocaProf_Id as AlocaProf_Id,
  trunc(AlocXHorDt.DtInicio) as DtInicio          
from
  AlocaProf,
  AlocXHorDt,
  Horario,
  Turma
where
  AlocXHorDt.State_Id = 3000000010001
and
  AlocaProf.State_Id = 3000000037001
and
  AlocaProf.Turma_Id = Turma.Id
and
  AlocXHorDt.Horario_05_Id = Horario.Id
and
  AlocXHorDt.AlocaProf_Id = AlocaProf.Id
and
  (
     Horario.Periodo_Id = nvl ( p_Periodo_Id , 0 )
     or
     p_Periodo_Id is null
  )
and
  (
     Horario.Semana_Id = nvl ( p_Semana_Id , 0 )
     or
     p_Semana_Id is null
  )
and 
  trunc(AlocXHorDt.DtInicio) > p_O_Data 
and
  AlocXHorDt.Professor_Id = nvl ( p_Professor_Id , 0 )
union all
select
  to_char(horainicio,'hh24:mi') as horainicio,
  horario.semana_id,
  Turma.Codigo as Turma,
  CurrXDisc_gsRetCodDisc(AlocaProf.CurrXDisc_Id) as Disciplina,
  DivTurma_gsRecognize(AlocaProf.DivTurma_Id) as DivTurma,
  AulaTi_gsRecognize(AlocaProf.AulaTi_Id) as TipoAula,
  AlocXHorDt.indice as Indice, 
  AlocXHorDt.AlocaProf_Id as AlocaProf_Id,
  trunc(AlocXHorDt.DtInicio) as DtInicio          
from
  AlocaProf,
  AlocXHorDt,
  Horario,
  Turma
where
  AlocXHorDt.State_Id = 3000000010001
and
  AlocaProf.State_Id = 3000000037001
and
  AlocaProf.Turma_Id = Turma.Id
and
  AlocXHorDt.Horario_06_Id = Horario.Id
and
  AlocXHorDt.AlocaProf_Id = AlocaProf.Id
and
  (
     Horario.Periodo_Id = nvl ( p_Periodo_Id , 0 )
     or
     p_Periodo_Id is null
  )
and
  (
     Horario.Semana_Id = nvl ( p_Semana_Id , 0 )
     or
     p_Semana_Id is null
  )
and 
  trunc(AlocXHorDt.DtInicio) > p_O_Data 
and
  AlocXHorDt.Professor_Id = nvl ( p_Professor_Id , 0 )
union all
select
  to_char(horainicio,'hh24:mi') as horainicio,
  horario.semana_id,
  Turma.Codigo as Turma,
  CurrXDisc_gsRetCodDisc(AlocaProf.CurrXDisc_Id) as Disciplina,
  DivTurma_gsRecognize(AlocaProf.DivTurma_Id) as DivTurma,
  AulaTi_gsRecognize(AlocaProf.AulaTi_Id) as TipoAula,
  AlocXHorDt.indice as Indice, 
  AlocXHorDt.AlocaProf_Id as AlocaProf_Id,
  trunc(AlocXHorDt.DtInicio) as DtInicio        
from
  alocxhordt,
  horario,
  alocxhor,
  alocaprof,
  turma
where
  alocxhordt.alocaprof_id=alocaprof_junto_id
and  
  alocxhordt.horario_01_id=horario.id
and
  alocxhor.alocaprof_junto_id is not null
and
  alocxhor.alocaprof_id=alocaprof.id
and
  alocaprof.turma_id=turma.id
and
  (
  alocaprof.professor_01_id = nvl ( p_Professor_Id , 0 )
  or
  alocaprof.professor_02_id = nvl ( p_Professor_Id , 0 )
  or
  alocaprof.professor_03_id = nvl ( p_Professor_Id , 0 )
  or
  alocaprof.professor_04_id = nvl ( p_Professor_Id , 0 )
  or
  alocaprof.professor_05_id = nvl ( p_Professor_Id , 0 )
  or
  alocaprof.professor_06_id = nvl ( p_Professor_Id , 0 )
  )
and 
  trunc(AlocXHorDt.DtInicio) > p_O_Data 
union all
select
  to_char(horainicio,'hh24:mi') as horainicio,
  horario.semana_id,
  Turma.Codigo as Turma,
  CurrXDisc_gsRetCodDisc(AlocaProf.CurrXDisc_Id) as Disciplina,
  DivTurma_gsRecognize(AlocaProf.DivTurma_Id) as DivTurma,
  AulaTi_gsRecognize(AlocaProf.AulaTi_Id) as TipoAula,
  AlocXHorDt.indice as Indice, 
  AlocXHorDt.AlocaProf_Id as AlocaProf_Id,
  trunc(AlocXHorDt.DtInicio) as DtInicio        
from
  alocxhordt,
  horario,
  alocxhor,
  alocaprof,
  turma
where
  alocxhordt.alocaprof_id=alocaprof_junto_id
and  
  alocxhordt.horario_02_id=horario.id
and
  alocxhor.alocaprof_junto_id is not null
and
  alocxhor.alocaprof_id=alocaprof.id
and
  alocaprof.turma_id=turma.id
and
  (
  alocaprof.professor_01_id = nvl ( p_Professor_Id , 0 )
  or
  alocaprof.professor_02_id = nvl ( p_Professor_Id , 0 )
  or
  alocaprof.professor_03_id = nvl ( p_Professor_Id , 0 )
  or
  alocaprof.professor_04_id = nvl ( p_Professor_Id , 0 )
  or
  alocaprof.professor_05_id = nvl ( p_Professor_Id , 0 )
  or
  alocaprof.professor_06_id = nvl ( p_Professor_Id , 0 )
  )
and 
  trunc(AlocXHorDt.DtInicio) > p_O_Data 
order by semana_id,horainicio,turma,disciplina,divturma
