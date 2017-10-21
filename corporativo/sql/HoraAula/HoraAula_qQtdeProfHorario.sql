select 
  Sum(Total) as Total 
from 
  (
  select 
    count(*) as total
  from 
    horaaula, 
    toxcd
  where
    p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
  and
    toxcd.id = horaaula.toxcd_id
  and 
    horaaula.horario_id = p_Horario_Id
  and
    horaaula.wpessoa_prof1_id = p_WPessoa_Id
  group by horaaula.horario_id
  union
  select 
    count(*) as total
  from 
    horaaula, 
    toxcd
  where
    p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
  and
    toxcd.id = horaaula.toxcd_id
  and 
    horaaula.horario_id = p_Horario_Id
  and
    horaaula.wpessoa_prof2_id = p_WPessoa_Id
  group by horaaula.horario_id
  union
  select 
    count(*) as total
  from 
    horaaula, 
    toxcd
  where
    p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
  and
    toxcd.id = horaaula.toxcd_id
  and 
    horaaula.horario_id = p_Horario_Id
  and
    horaaula.wpessoa_prof3_id = p_WPessoa_Id
  group by horaaula.horario_id
  union
  select 
    count(*) as total
  from 
    horaaula, 
    toxcd
  where
    p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
  and
    toxcd.id = horaaula.toxcd_id
  and 
    horaaula.horario_id = p_Horario_Id
  and
    horaaula.wpessoa_prof4_id = p_WPessoa_Id
  group by horaaula.horario_id
  )