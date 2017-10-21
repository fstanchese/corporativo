select
	CAAssunto.*,
	CAEvento_gsRecognize(CAEvento_Id) as CAEvento_Recognize
from
	CAAssunto
where
	CAAssunto.Id = p_CAAssunto_Id 
	
