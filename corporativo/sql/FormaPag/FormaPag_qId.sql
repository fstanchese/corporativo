
select
  FormaPag.*,
  FormaPag_gsRecognize(Id) as recognize
from
  FormaPag
where
  Id = nvl( p_FormaPag_Id ,0)
