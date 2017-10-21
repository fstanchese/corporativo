select
  StateGru.*,
  StateGru.Nome as Recognize
from
  StateGru,
  StatexStateGru
where
  StateGru.Id = StateXStateGru.StateGru_Id
and
  StateXStateGru.Sistema_Id = p_Sistema_Id 