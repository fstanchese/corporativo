
select
  horario.*,
  horario_gsrecognize(horario.id)         as recognize,
  to_char(horario.horainicio,'hh24:mi')   as horainiciotxt,
  semana_gsrecognize(semana_id)           as Semana,
  to_number(to_char(HORAINICIO,'SSSSS')) as HoraInicioSS,
  (DURACAO*60) as DuracaoSS 
from
  horario
where
  id = nvl( p_Horario_Id ,0)
