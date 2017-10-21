select
  HoraAula.Id                                                        as id,
  curso_gsrecognize(curso.id)                                        as curso, 
  TurmaOfe_gsRetCodTurma(turmaofe.id)                                as turma,
  TOXCD_gsRetCodDisc(toxcd.id)                                       as coddisc,
  TOXCD_gsRetDisciplina(toxcd.id)                                    as disc,
  to_char(horario.horainicio,'hh24:mi')                              as hora,
  nvl(wpessoa_gsrecognize(wPessoa_Prof1_id),'*** SEM PROFESSOR ***') as prof1,
  wpessoa_gsrecognize(wPessoa_Prof2_id)                              as prof2,
  wpessoa_gsrecognize(wPessoa_Prof3_id)                              as prof3,
  wpessoa_gsrecognize(wPessoa_Prof4_id)                              as prof4,
  nvl(divturma_gsrecognize(horaaula.divturma_id),' ')                as divisao,
  semana_gsrecognize(semana.id)                                      as diasemana,
  to_char(HoraAula.DtInicio,'DD/MM')                                 as Inicio,
  HoraAula.DtTermino,
  HoraAula.CustoZero
from 
  horaaula,
  horario,
  semana,
  toxcd,
  turmaofe,
  turma,
  curso
where
  curso.id=turma.curso_id
and
  turma.id = turmaofe.turma_id
and
  turmaofe.id = toxcd.turmaofe_id
and
  toxcd.id = horaaula.toxcd_id
and
  semana.id = horario.semana_id
and
  horario.id = horaAula.horario_id 
and
  HoraAula.Id = nvl( p_HoraAula_Id ,0)
