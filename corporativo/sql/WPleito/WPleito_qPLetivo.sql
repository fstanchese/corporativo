select
	WPleito.*,
	WPleito.Nome as Recognize
from
	WPleito
where
	WPleito.PLetivo_Id = p_PLetivo_Id 