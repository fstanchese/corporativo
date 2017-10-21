select
	DiscEsp.*,
	DiscEsp_gsrecognize(DiscEsp.Id) as Recognize
from
	DiscEsp
where
	(
	p_DiscEspTi_Id is null
    or
    DiscEsp.DiscEspTi_Id = nvl( p_DiscEspTi_Id ,0)
  	)
and
	(
    p_AreaAcad_Id is null
    or
    DiscEsp.AreaAcad_Id = nvl( p_AreaAcad_Id ,0)
  	)
and
  	DiscEsp.PLetivo_Id = nvl( p_PLetivo_Id ,0)
order by
	Nome