select 
	DiscEsp.*,
	DiscEsp_gsRecognize(id) as Recognize
from
	DiscEsp
where
	DiscEsp.Id = nvl( p_DiscEsp_Id ,0)