(
select 
  horaaula.id as HORAAULA_ID,
  horario.id  as HORARIO_ID,
  horario.horarioti_id,
  to_char(horario.horainicio,'HH24:MI')         as hora_inicio,
  horario.semana_id,
  toxcd_gsretturma(toxcd_id )                   as turma,
  divturma_gsrecognize(divturma_teoria_id)      as divturma_teoria,
  divturma_gsrecognize(divturma_pratica_id)     as divturma_pratica,
  currxdisc_gsretcoddisc(gradalu.currxdisc_id ) as disciplina,
  toxcd_id,
  gradalu.id as gradalu_id,
  horario.horainicio,
  horario.duracao,
  gradalu.gradaluti_id as GRADALUTI_ID,
  aulati_id,
  TOXCD_gsRetSala( HoraAula.TOXCD_Id, decode(horaaula.aulati_id,13300000000002,GradAlu.DivTurma_Pratica_Id,null) ) as Sala
from
  gradalu,
  toxcd,
  horaaula,
  horario
where
( 
  gradalu.divturma_teoria_id is null and horaaula.divturma_id is null 
  or
  gradalu.divturma_pratica_id is null and horaaula.divturma_id is null 
  or 
  gradalu.divturma_teoria_id = horaaula.divturma_id
  or 
  gradalu.divturma_pratica_id = horaaula.divturma_id
)
and
  horario.id = horaaula.horario_id
and
  p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
and
  horaaula.toxcd_id = toxcd.id
and
  toxcd.currxdisc_id = gradalu.currxdisc_id
and
  toxcd.turmaofe_id = gradalu.turmaofe_id
and
  GradAlu.State_Id in ( 3000000003001,3000000003004,3000000003005,3000000003006,3000000003007,3000000003008 )
and
  gradalu.wpessoa_id = nvl( p_WPessoa_Id ,0)
)
union
(
select 
  horaaula.id as HORAAULA_ID,
  horario.id  as HORARIO_ID,
  horario.horarioti_id,
  to_char(horario.horainicio,'HH24:MI') as hora_inicio,
  horario.semana_id,
  toxcd_gsretturma(toxcd_id )                   as turma,
  divturma_gsrecognize(divturma_teoria_id)      as divturma_teoria,
  divturma_gsrecognize(divturma_pratica_id)     as divturma_pratica,
  currxdisc_gsretcoddisc(gradalu.currxdisc_id ) as disciplina,
  toxcd_id,
  gradalu.id as gradalu_id,
  horario.horainicio,
  horario.duracao,
  gradalu.gradaluti_id as GRADALUTI_ID,
  aulati_id,
  TOXCD_gsRetSala( HoraAula.TOXCD_Id, decode(horaaula.aulati_id,13300000000002,GradAlu.DivTurma_Pratica_Id,null) ) as Sala
from
  gradalu,
  toxcd,
  horaaula,
  horario,
  turmaofe,
  discesp
where
( 
  gradalu.divturma_teoria_id is null and horaaula.divturma_id is null 
    or
  gradalu.divturma_pratica_id is null and horaaula.divturma_id is null 
    or 
  gradalu.divturma_teoria_id = horaaula.divturma_id
    or 
  gradalu.divturma_pratica_id = horaaula.divturma_id
)
and
  horario.id = horaaula.horario_id
and
  p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
and
  horaaula.toxcd_id = toxcd.id
and
  discesp.id=turmaofe.discesp_Id
and
  turmaofe.id=toxcd.turmaofe_id
and
  toxcd.turmaofe_id = gradalu.turmaofe_id
and
  GradAlu.State_Id in ( 3000000003001,3000000003004,3000000003005,3000000003006,3000000003007,3000000003008 )
and
  gradalu.wpessoa_id = nvl( p_WPessoa_Id ,0)
)
order by semana_id,hora_inicio