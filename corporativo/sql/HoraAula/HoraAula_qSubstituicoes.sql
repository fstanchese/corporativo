select
  HoraAula.HoraAula_Troca_Id                                         as id,
  Decode(TurmaOfe.DiscEsp_Id,null,curso.nome,TOXCD_gsRetFacul(TOXCD.Id)) as curso, 
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
  to_char(HoraAula.DtInicio,'DD/MM')                                 as DtInicio,
  HoraAula.DtTermino                                                 as DtTermino,
  Decode(TurmaOfe.DiscEsp_Id,null,'C','F')                           as Tipo_Curso 
from 
  HoraAula,
  Horario,
  Semana,
  TOXCD,
  TurmaOfe,
  Turma,
  Curso
where
  Curso.Id = Turma.Curso_Id
and
  (
    Curso.Id = nvl( p_Curso_Id ,0)
      or
    p_Curso_Id is null
  )
and
  Turma.Id = TurmaOfe.Turma_Id
and
  TurmaOfe.Id = TOXCD.TurmaOfe_Id
and
  TOXCD.Id = HoraAula.TOXCD_Id
and
  Semana.id = Horario.Semana_Id
and
  Horario.Id = HoraAula.Horario_Id 
and
  HoraAula.DtInicio between p_HoraAula_DtInicio and p_HoraAula_DtTermino
and
  HoraAula.HoraAula_Troca_Id is not null
order by curso,turma,coddisc,diasemana,hora,HoraAula.DtInicio