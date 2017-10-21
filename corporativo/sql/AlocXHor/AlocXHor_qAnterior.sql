select 
  to_char(horainicio,'hh24:mi') as horainicio,
  horario.semana_id,
  semana_gsrecognize(horario.semana_id) as diasemana,
  Turma.Codigo as Turma,
  CurrXDisc_gsRetCodDisc(AlocaProf.CurrXDisc_Id) as Disciplina,
  CurrXDisc_gsRetDisc(AlocaProf.CurrXDisc_Id) as NomeDisc,   
  professor.nome as Professor,
  DivTurma_gsRecognize(AlocaProf.DivTurma_Id) as DivTurma,
  alocxhor.indice as Indice,
  alocxhor.alocaprof_id as alocaprof_id,
  AulaTi_gsRecognize(AlocaProf.AulaTi_Id) as TipoAula,
  horario.id as horario_id,
  professor.id as professor_id,
  to_char(alocxhorhi.dt,'dd/mm/yyyy') as validade
from 
  alocxhorhi,
  alocxhor,
  horario,
  alocaprof,
  turma,
  professor
where
  (
    ( 
    alocxhor.indice = 1
    and
    alocaprof.professor_01_id=professor.id
    )
    or
    ( 
    alocxhor.indice = 2
    and
    alocaprof.professor_02_id=professor.id
    )
    or
    ( 
    alocxhor.indice = 3
    and
    alocaprof.professor_03_id=professor.id
    )
    or
    ( 
    alocxhor.indice = 4
    and
    alocaprof.professor_04_id=professor.id
    )
    or
    ( 
    alocxhor.indice = 5
    and
    alocaprof.professor_05_id=professor.id
    )
    or
    ( 
    alocxhor.indice = 6
    and
    alocaprof.professor_06_id=professor.id
    )
  )
and
  alocaprof.turma_id=turma.id
and
  alocaprof.id=alocxhor.alocaprof_id
and
  to_number(alocxhorhi.old) = horario.id
and
  upper(alocxhorhi.col) like 'HORARIO%'
and
  alocxhor.id=alocxhorhi.alocxhor_id
and
  alocxhor.indice = p_AlocXHor_Indice
and
  alocxhor.alocaprof_id = p_AlocaProf_Id 
order by validade,semana_id,horainicio,divturma,disciplina,professor,indice  