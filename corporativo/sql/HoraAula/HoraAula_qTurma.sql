(
select
  disc.nome                                  as nomedisc,
  disc.codigo                                as coddisc,
  divdisc.nome                               as divdisc,
  to_char(horario.horainicio,'hh24:mi')      as hora,
  aulaTi_gsrecognize(HoraAula.aulaTi_id)     as tipoaula,
  nvl(wpessoa_gsrecognize(wPessoa_Prof1_id),'*** SEM PROFESSOR ***') as prof1,
  wpessoa_gsrecognize(wPessoa_Prof2_id)      as prof2,
  wpessoa_gsrecognize(wPessoa_Prof3_id)      as prof3,
  wpessoa_gsrecognize(wPessoa_Prof4_id)      as prof4,
  sala_gsrecognize(sala_especial_id)         as salaespecial,
  nvl(divturma_gsrecognize(divturma_id),' ') as divisao,
  semana_gsrecognize(semana.id)              as diasemana,
  semana.numero                              as numero,
  divdisc.id                                 as divdisc_id,
  horaaula.id                                as horaaula_id,
  campus_gsrecognize(turma.campus_id)        as campus,
  wPessoa_Prof1_id                           as wpessoa_prof1_id,
  wPessoa_Prof2_id                           as wpessoa_prof2_id,
  wPessoa_Prof3_id                           as wpessoa_prof3_id,
  wPessoa_Prof4_id                           as wpessoa_prof4_id,
  horario.id                                 as horario_id
from
  semana,
  horario,
  currxdisc,
  disc,
  toxcd,
  horaAula,
  turmaofe,
  divdisc,
  turma
where
  p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
and
  divdisc.id (+) = horaAula.divdisc_id
and
  semana.id = horario.semana_id
and
  horario.id (+) = horaAula.horario_id 
and
  horaAula.toxcd_id = toxcd.id
and
  disc.id = currxdisc.disc_id
and
  currxdisc.id = toxcd.currxdisc_id
and
  turmaofe.id = toxcd.turmaofe_id
and
  turma.id=turmaofe.turma_id
and
  turmaofe.id = nvl( p_TurmaOfe_Id ,0)
)
union
(
select
  '' as nomedisc,
  '' as coddisc,
  '' as divdisc,
  to_char(horario.horainicio,'hh24:mi') as hora,
  '' as tipoaula,
  '' as prof1,
  '' as prof2,
  '' as prof3,
  '' as prof4,
  '' as salaespecial,
  '' as divisao,
  semana_gsrecognize(semana.id) as diasemana,
  semana.numero as numero,
  0             as divdisc_id,
  null          as horaaula_id,
  null          as campus,
  null as wpessoa_prof1_id,
  null as wpessoa_prof2_id,
  null as wpessoa_prof3_id,
  null as wpessoa_prof4_id,
  horario.id as horario_id
from
  semana,
  horario
where
  semana.id = horario.semana_id
and
  horario.id  not in ( 
                       select 
                          horaAula.horario_id
                       from 
                          horaaula,
                          toxcd,
                          turmaofe
                       where
                          p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
                       and
                          horaAula.toxcd_id = toxcd.id
                       and
                          toxcd.turmaofe_id = turmaofe.id 
                       and
                          turmaofe.id = nvl( p_TurmaOfe_Id ,0)
                      )
and
  horario.periodo_id = nvl( p_Periodo_Id ,0)
and
  horario.horarioti_id = 12800000000001
)
order by
  numero,hora,coddisc,divdisc,divisao