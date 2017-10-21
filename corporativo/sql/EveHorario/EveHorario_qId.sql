select
  EveHorario.*
from
  EveHorario
where
  Id = nvl( p_EveHorario_Id ,0)