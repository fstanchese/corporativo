select 
  horario.id  as HORARIO_ID,
  gradalu.id as gradalu_id,
  horario.horainicio,
  horario.duracao,
  to_number(to_char(HORAINICIO,'SSSSS')) as HoraAulaSS,
  (DURACAO*60) as DuracaoSS,
  semana.numero,
  to_char(horario.horainicio,'hh24:mi') as horaini
from
  semana,
  gradalu,
  toxcd,
  horaaula,
  horario
where
  ( 
     ( gradalu.divturma_teoria_id is null and gradalu.divturma_pratica_id is null )
       or 
     nvl(gradalu.divturma_teoria_id,0) = nvl(horaaula.divturma_id,0)
       or 
     nvl(gradalu.divturma_pratica_id,0) = nvl(horaaula.divturma_id,0)
  )
and
  horario.semana_id = semana.id
and
  horario.id = horaaula.horario_id
and
  horaaula.toxcd_id = toxcd.id
and
  (
    toxcd.currxdisc_id is null
     or
    toxcd.currxdisc_id = gradalu.currxdisc_id
  )
and
  toxcd.turmaofe_id = gradalu.turmaofe_id
and
  gradalu.state_id = 3000000003001
and
  p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
and
  horario.semana_id = nvl( p_Semana_Id ,0)
and
  gradalu.wpessoa_id = nvl( p_WPessoa_Id ,0)
