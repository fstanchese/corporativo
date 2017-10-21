select
  horaAula.id 		               as id,
  to_char(horario.horainicio,'hh24:mi')       as hora,
  nvl(divturma_gsrecognize(divturma_id),' ')  as divisao,
  semana.numero                               as numero,  
  horaaula_troca_id                           as id_troca,
  horaaula.wpessoa_prof1_id                   as prof1_id,
  replace(replace(horaAula_gsrecognize(horaAula.id),'Noturno - ',''),'Matutino - ','') as recognize
from
  semana,
  horario,
  horaAula
where
  p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
and
  semana.id = horario.semana_id
and
  horario.id = horaAula.horario_id
and
  horaAula.toxcd_id = nvl( p_TOXCD_Id ,0)
order by Semana.Numero,HoraAula.DivTurma_Id,HoraAula.DivDisc_Id,Hora
