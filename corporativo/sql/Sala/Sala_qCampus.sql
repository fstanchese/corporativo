
select
  sala.*,
  sala_gsRecognize(Sala.Id) as recognize
from
  sala
where
  sala.Campus_Id = nvl( p_Campus_Id ,0)
order by
  recognize
