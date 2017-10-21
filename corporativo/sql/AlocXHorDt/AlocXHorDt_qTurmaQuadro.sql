select 
  to_char(horainicio,'hh24:mi') as horainicio, 
  horario.semana_id, 
  semana_gsrecognize(horario.semana_id) as diasemana, 
  Turma.Codigo as Turma, 
  CurrXDisc_gsRetCodDisc(AlocaProf.CurrXDisc_Id) as Disciplina, 
  CurrXDisc_gsRetDisc(AlocaProf.CurrXDisc_Id) as NomeDisc,  
  Professor.Nome as Professor, 
  DivTurma_gsRecognize(AlocaProf.DivTurma_Id) as DivTurma, 
  AlocXHorDt.indice as Indice, 
  AlocXHorDt.AlocaProf_Id as AlocaProf_Id,
  AulaTi_gsRecognize(AlocaProf.AulaTi_Id) as TipoAula,
  trunc(AlocXHorDt.DtInicio) as DtInicio      
from 
  AlocaProf, 
  AlocXHorDt, 
  Horario, 
  Turma, 
  Professor 
where 
  AlocXHorDt.State_Id = 3000000010001
and
  AlocaProf.State_Id = 3000000037001 
and 
  AlocaProf.Turma_Id = Turma.Id 
and 
  AlocXHorDt.Horario_01_Id = Horario.Id (+) 
and 
  AlocXHorDt.AlocaProf_Id = AlocaProf.Id 
and 
  AlocXHorDt.Professor_Id = Professor.Id 
and 
  trunc(AlocXHorDt.DtInicio) > p_O_Data 
and 
  AlocaProf.Turma_Id = nvl ( p_Turma_Id , 0 ) 
union all
select 
  to_char(horainicio,'hh24:mi') as horainicio, 
  horario.semana_id, 
  semana_gsrecognize(horario.semana_id) as diasemana, 
  Turma.Codigo as Turma, 
  CurrXDisc_gsRetCodDisc(AlocaProf.CurrXDisc_Id) as Disciplina, 
  CurrXDisc_gsRetDisc(AlocaProf.CurrXDisc_Id) as NomeDisc,  
  Professor.Nome as Professor, 
  DivTurma_gsRecognize(AlocaProf.DivTurma_Id) as DivTurma, 
  AlocXHorDt.indice as Indice, 
  AlocXHorDt.AlocaProf_Id as AlocaProf_Id,
  AulaTi_gsRecognize(AlocaProf.AulaTi_Id) as TipoAula,
  trunc(AlocXHorDt.DtInicio) as DtInicio                      
from 
  AlocaProf, 
  AlocXHorDt, 
  Horario, 
  Turma, 
  Professor 
where 
  AlocXHorDt.State_Id = 3000000010001
and
  AlocaProf.State_Id = 3000000037001 
and 
  AlocaProf.Turma_Id = Turma.Id 
and 
  AlocXHorDt.Horario_02_Id = Horario.Id (+) 
and 
  AlocXHorDt.AlocaProf_Id = AlocaProf.Id 
and 
  AlocXHorDt.Professor_Id = Professor.Id 
and 
  trunc(AlocXHorDt.DtInicio) > p_O_Data 
and 
  AlocaProf.Turma_Id = nvl ( p_Turma_Id , 0 ) 
union all
select 
  to_char(horainicio,'hh24:mi') as horainicio, 
  horario.semana_id, 
  semana_gsrecognize(horario.semana_id) as diasemana, 
  Turma.Codigo as Turma, 
  CurrXDisc_gsRetCodDisc(AlocaProf.CurrXDisc_Id) as Disciplina, 
  CurrXDisc_gsRetDisc(AlocaProf.CurrXDisc_Id) as NomeDisc,  
  Professor.Nome as Professor, 
  DivTurma_gsRecognize(AlocaProf.DivTurma_Id) as DivTurma, 
  AlocXHorDt.indice as Indice, 
  AlocXHorDt.AlocaProf_Id as AlocaProf_Id,
  AulaTi_gsRecognize(AlocaProf.AulaTi_Id) as TipoAula,
  trunc(AlocXHorDt.DtInicio) as DtInicio                      
from 
  AlocaProf, 
  AlocXHorDt, 
  Horario, 
  Turma, 
  Professor 
where 
  AlocXHorDt.State_Id = 3000000010001
and
  AlocaProf.State_Id = 3000000037001 
and 
  AlocaProf.Turma_Id = Turma.Id 
and 
  AlocXHorDt.Horario_03_Id = Horario.Id (+) 
and 
  AlocXHorDt.AlocaProf_Id = AlocaProf.Id 
and 
  AlocXHorDt.Professor_Id = Professor.Id 
and 
  trunc(AlocXHorDt.DtInicio) > p_O_Data 
and 
  AlocaProf.Turma_Id = nvl ( p_Turma_Id , 0 ) 
union all
select 
  to_char(horainicio,'hh24:mi') as horainicio, 
  horario.semana_id, 
  semana_gsrecognize(horario.semana_id) as diasemana, 
  Turma.Codigo as Turma, 
  CurrXDisc_gsRetCodDisc(AlocaProf.CurrXDisc_Id) as Disciplina, 
  CurrXDisc_gsRetDisc(AlocaProf.CurrXDisc_Id) as NomeDisc,  
  Professor.Nome as Professor, 
  DivTurma_gsRecognize(AlocaProf.DivTurma_Id) as DivTurma, 
  AlocXHorDt.indice as Indice, 
  AlocXHorDt.AlocaProf_Id as AlocaProf_Id,
  AulaTi_gsRecognize(AlocaProf.AulaTi_Id) as TipoAula,
  trunc(AlocXHorDt.DtInicio) as DtInicio                      
from 
  AlocaProf, 
  AlocXHorDt, 
  Horario, 
  Turma, 
  Professor 
where 
  AlocXHorDt.State_Id = 3000000010001
and
  AlocaProf.State_Id = 3000000037001 
and 
  AlocaProf.Turma_Id = Turma.Id 
and 
  AlocXHorDt.Horario_04_Id = Horario.Id (+) 
and 
  AlocXHorDt.AlocaProf_Id = AlocaProf.Id 
and 
  AlocXHorDt.Professor_Id = Professor.Id 
and 
  trunc(AlocXHorDt.DtInicio) > p_O_Data 
and 
  AlocaProf.Turma_Id = nvl ( p_Turma_Id , 0 ) 
union all
select 
  to_char(horainicio,'hh24:mi') as horainicio, 
  horario.semana_id, 
  semana_gsrecognize(horario.semana_id) as diasemana, 
  Turma.Codigo as Turma, 
  CurrXDisc_gsRetCodDisc(AlocaProf.CurrXDisc_Id) as Disciplina, 
  CurrXDisc_gsRetDisc(AlocaProf.CurrXDisc_Id) as NomeDisc,  
  Professor.Nome as Professor, 
  DivTurma_gsRecognize(AlocaProf.DivTurma_Id) as DivTurma, 
  AlocXHorDt.indice as Indice, 
  AlocXHorDt.AlocaProf_Id as AlocaProf_Id,
  AulaTi_gsRecognize(AlocaProf.AulaTi_Id) as TipoAula,
  trunc(AlocXHorDt.DtInicio) as DtInicio                      
from 
  AlocaProf, 
  AlocXHorDt, 
  Horario, 
  Turma, 
  Professor 
where 
  AlocXHorDt.State_Id = 3000000010001
and
  AlocaProf.State_Id = 3000000037001 
and 
  AlocaProf.Turma_Id = Turma.Id 
and 
  AlocXHorDt.Horario_05_Id = Horario.Id (+) 
and 
  AlocXHorDt.AlocaProf_Id = AlocaProf.Id 
and 
  AlocXHorDt.Professor_Id = Professor.Id 
and 
  trunc(AlocXHorDt.DtInicio) > p_O_Data 
and 
  AlocaProf.Turma_Id = nvl ( p_Turma_Id , 0 ) 
union all
select 
  to_char(horainicio,'hh24:mi') as horainicio, 
  horario.semana_id, 
  semana_gsrecognize(horario.semana_id) as diasemana, 
  Turma.Codigo as Turma, 
  CurrXDisc_gsRetCodDisc(AlocaProf.CurrXDisc_Id) as Disciplina, 
  CurrXDisc_gsRetDisc(AlocaProf.CurrXDisc_Id) as NomeDisc,  
  Professor.Nome as Professor, 
  DivTurma_gsRecognize(AlocaProf.DivTurma_Id) as DivTurma, 
  AlocXHorDt.indice as Indice, 
  AlocXHorDt.AlocaProf_Id as AlocaProf_Id,
  AulaTi_gsRecognize(AlocaProf.AulaTi_Id) as TipoAula,
  trunc(AlocXHorDt.DtInicio) as DtInicio                      
from 
  AlocaProf, 
  AlocXHorDt, 
  Horario, 
  Turma, 
  Professor 
where 
  AlocXHorDt.State_Id = 3000000010001
and
  AlocaProf.State_Id = 3000000037001 
and 
  AlocaProf.Turma_Id = Turma.Id 
and 
  AlocXHorDt.Horario_06_Id = Horario.Id (+) 
and 
  AlocXHorDt.AlocaProf_Id = AlocaProf.Id 
and 
  AlocXHorDt.Professor_Id = Professor.Id 
and 
  trunc(AlocXHorDt.DtInicio) > p_O_Data 
and 
  AlocaProf.Turma_Id = nvl ( p_Turma_Id , 0 ) 
union all
select
  to_char(horainicio,'hh24:mi') as horainicio,
  horario.semana_id,
  semana_gsrecognize(horario.semana_id) as diasemana,
  Turma.Codigo as Turma,
  CurrXDisc_gsRetCodDisc(AlocaProf.CurrXDisc_Id) as Disciplina,
  CurrXDisc_gsRetDisc(AlocaProf.CurrXDisc_Id) as NomeDisc,
  Professor.Nome as Professor,
  DivTurma_gsRecognize(AlocaProf.DivTurma_Id) as DivTurma,
  AlocXHorDt.indice as Indice,
  AlocXHorDt.AlocaProf_Id as AlocaProf_Id,
  AulaTi_gsRecognize(AlocaProf.AulaTi_Id) as TipoAula,
  trunc(AlocXHorDt.DtInicio) as DtInicio
from
  AlocaProf,
  AlocXHorDt,
  Horario,
  Turma,
  Professor
where
  AlocXHorDt.State_Id = 3000000010001
and
  AlocaProf.State_Id = 3000000037001
and
  AlocaProf.Turma_Id = Turma.Id
and
  AlocXHorDt.Horario_01_Id = Horario.Id (+)
and
  AlocXHorDt.AlocaProf_Id = AlocaProf.Id
and
  AlocXHorDt.Professor_Id = Professor.Id
and
  trunc(AlocXHorDt.DtInicio) > p_O_Data
and
  alocaprof.id in 
  ( 
  select   
    alocxhor.alocaprof_junto_id
  from
    alocxhor,alocaprof,turma
  where
    alocxhor.alocaprof_junto_id is not null
  and
    alocxhor.alocaprof_id=alocaprof.id
  and
    alocaprof.turma_id=turma.id
  and
    turma.id = nvl ( p_Turma_Id , 0 )
  )
union all
select
  to_char(horainicio,'hh24:mi') as horainicio,
  horario.semana_id,
  semana_gsrecognize(horario.semana_id) as diasemana,
  Turma.Codigo as Turma,
  CurrXDisc_gsRetCodDisc(AlocaProf.CurrXDisc_Id) as Disciplina,
  CurrXDisc_gsRetDisc(AlocaProf.CurrXDisc_Id) as NomeDisc,
  Professor.Nome as Professor,
  DivTurma_gsRecognize(AlocaProf.DivTurma_Id) as DivTurma,
  AlocXHorDt.indice as Indice,
  AlocXHorDt.AlocaProf_Id as AlocaProf_Id,
  AulaTi_gsRecognize(AlocaProf.AulaTi_Id) as TipoAula,
  trunc(AlocXHorDt.DtInicio) as DtInicio
from
  AlocaProf,
  AlocXHorDt,
  Horario,
  Turma,
  Professor
where
  AlocXHorDt.State_Id = 3000000010001
and
  AlocaProf.State_Id = 3000000037001
and
  AlocaProf.Turma_Id = Turma.Id
and
  AlocXHorDt.Horario_02_Id = Horario.Id (+)
and
  AlocXHorDt.AlocaProf_Id = AlocaProf.Id
and
  AlocXHorDt.Professor_Id = Professor.Id
and
  trunc(AlocXHorDt.DtInicio) > p_O_Data
and
  alocaprof.id in 
  ( 
  select   
    alocxhor.alocaprof_junto_id
  from
    alocxhor,alocaprof,turma
  where
    alocxhor.alocaprof_junto_id is not null
  and
    alocxhor.alocaprof_id=alocaprof.id
  and
    alocaprof.turma_id=turma.id
  and
    turma.id = nvl ( p_Turma_Id , 0 )
  )
union all
select
  to_char(horainicio,'hh24:mi') as horainicio,
  horario.semana_id,
  semana_gsrecognize(horario.semana_id) as diasemana,
  Turma.Codigo as Turma,
  CurrXDisc_gsRetCodDisc(AlocaProf.CurrXDisc_Id) as Disciplina,
  CurrXDisc_gsRetDisc(AlocaProf.CurrXDisc_Id) as NomeDisc,
  Professor.Nome as Professor,
  DivTurma_gsRecognize(AlocaProf.DivTurma_Id) as DivTurma,
  AlocXHorDt.indice as Indice,
  AlocXHorDt.AlocaProf_Id as AlocaProf_Id,
  AulaTi_gsRecognize(AlocaProf.AulaTi_Id) as TipoAula,
  trunc(AlocXHorDt.DtInicio) as DtInicio
from
  AlocaProf,
  AlocXHorDt,
  Horario,
  Turma,
  Professor
where
  AlocXHorDt.State_Id = 3000000010001
and
  AlocaProf.State_Id = 3000000037001
and
  AlocaProf.Turma_Id = Turma.Id
and
  AlocXHorDt.Horario_03_Id = Horario.Id (+)
and
  AlocXHorDt.AlocaProf_Id = AlocaProf.Id
and
  AlocXHorDt.Professor_Id = Professor.Id
and
  trunc(AlocXHorDt.DtInicio) > p_O_Data
and
  alocaprof.id in 
  ( 
  select   
    alocxhor.alocaprof_junto_id
  from
    alocxhor,alocaprof,turma
  where
    alocxhor.alocaprof_junto_id is not null
  and
    alocxhor.alocaprof_id=alocaprof.id
  and
    alocaprof.turma_id=turma.id
  and
    turma.id = nvl ( p_Turma_Id , 0 )
  )
union all
select
  to_char(horainicio,'hh24:mi') as horainicio,
  horario.semana_id,
  semana_gsrecognize(horario.semana_id) as diasemana,
  Turma.Codigo as Turma,
  CurrXDisc_gsRetCodDisc(AlocaProf.CurrXDisc_Id) as Disciplina,
  CurrXDisc_gsRetDisc(AlocaProf.CurrXDisc_Id) as NomeDisc,
  Professor.Nome as Professor,
  DivTurma_gsRecognize(AlocaProf.DivTurma_Id) as DivTurma,
  AlocXHorDt.indice as Indice,
  AlocXHorDt.AlocaProf_Id as AlocaProf_Id,
  AulaTi_gsRecognize(AlocaProf.AulaTi_Id) as TipoAula,
  trunc(AlocXHorDt.DtInicio) as DtInicio
from
  AlocaProf,
  AlocXHorDt,
  Horario,
  Turma,
  Professor
where
  AlocXHorDt.State_Id = 3000000010001
and
  AlocaProf.State_Id = 3000000037001
and
  AlocaProf.Turma_Id = Turma.Id
and
  AlocXHorDt.Horario_04_Id = Horario.Id (+)
and
  AlocXHorDt.AlocaProf_Id = AlocaProf.Id
and
  AlocXHorDt.Professor_Id = Professor.Id
and
  trunc(AlocXHorDt.DtInicio) > p_O_Data
and
  alocaprof.id in 
  ( 
  select   
    alocxhor.alocaprof_junto_id
  from
    alocxhor,alocaprof,turma
  where
    alocxhor.alocaprof_junto_id is not null
  and
    alocxhor.alocaprof_id=alocaprof.id
  and
    alocaprof.turma_id=turma.id
  and
    turma.id = nvl ( p_Turma_Id , 0 )
  )
union all
select
  to_char(horainicio,'hh24:mi') as horainicio,
  horario.semana_id,
  semana_gsrecognize(horario.semana_id) as diasemana,
  Turma.Codigo as Turma,
  CurrXDisc_gsRetCodDisc(AlocaProf.CurrXDisc_Id) as Disciplina,
  CurrXDisc_gsRetDisc(AlocaProf.CurrXDisc_Id) as NomeDisc,
  Professor.Nome as Professor,
  DivTurma_gsRecognize(AlocaProf.DivTurma_Id) as DivTurma,
  AlocXHorDt.indice as Indice,
  AlocXHorDt.AlocaProf_Id as AlocaProf_Id,
  AulaTi_gsRecognize(AlocaProf.AulaTi_Id) as TipoAula,
  trunc(AlocXHorDt.DtInicio) as DtInicio
from
  AlocaProf,
  AlocXHorDt,
  Horario,
  Turma,
  Professor
where
  AlocXHorDt.State_Id = 3000000010001
and
  AlocaProf.State_Id = 3000000037001
and
  AlocaProf.Turma_Id = Turma.Id
and
  AlocXHorDt.Horario_05_Id = Horario.Id (+)
and
  AlocXHorDt.AlocaProf_Id = AlocaProf.Id
and
  AlocXHorDt.Professor_Id = Professor.Id
and
  trunc(AlocXHorDt.DtInicio) > p_O_Data
and
  alocaprof.id in 
  ( 
  select   
    alocxhor.alocaprof_junto_id
  from
    alocxhor,alocaprof,turma
  where
    alocxhor.alocaprof_junto_id is not null
  and
    alocxhor.alocaprof_id=alocaprof.id
  and
    alocaprof.turma_id=turma.id
  and
    turma.id = nvl ( p_Turma_Id , 0 )
  )
union all
select
  to_char(horainicio,'hh24:mi') as horainicio,
  horario.semana_id,
  semana_gsrecognize(horario.semana_id) as diasemana,
  Turma.Codigo as Turma,
  CurrXDisc_gsRetCodDisc(AlocaProf.CurrXDisc_Id) as Disciplina,
  CurrXDisc_gsRetDisc(AlocaProf.CurrXDisc_Id) as NomeDisc,
  Professor.Nome as Professor,
  DivTurma_gsRecognize(AlocaProf.DivTurma_Id) as DivTurma,
  AlocXHorDt.indice as Indice,
  AlocXHorDt.AlocaProf_Id as AlocaProf_Id,
  AulaTi_gsRecognize(AlocaProf.AulaTi_Id) as TipoAula,
  trunc(AlocXHorDt.DtInicio) as DtInicio
from
  AlocaProf,
  AlocXHorDt,
  Horario,
  Turma,
  Professor
where
  AlocXHorDt.State_Id = 3000000010001
and
  AlocaProf.State_Id = 3000000037001
and
  AlocaProf.Turma_Id = Turma.Id
and
  AlocXHorDt.Horario_06_Id = Horario.Id (+)
and
  AlocXHorDt.AlocaProf_Id = AlocaProf.Id
and
  AlocXHorDt.Professor_Id = Professor.Id
and
  trunc(AlocXHorDt.DtInicio) > p_O_Data
and
  alocaprof.id in 
  ( 
  select   
    alocxhor.alocaprof_junto_id
  from
    alocxhor,alocaprof,turma
  where
    alocxhor.alocaprof_junto_id is not null
  and
    alocxhor.alocaprof_id=alocaprof.id
  and
    alocaprof.turma_id=turma.id
  and
    turma.id = nvl ( p_Turma_Id , 0 )
  )
order by semana_id,horainicio,divturma,disciplina,professor,indice   
