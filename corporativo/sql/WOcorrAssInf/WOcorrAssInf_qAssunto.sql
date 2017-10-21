select 
	WOcorrAssInf.Id as id, 
	WOcorrAssInf.Informacao as Recognize
from
  	WOAXWOAInf,
  	WOcorrAssInf
where
  	WOAXWOAInf.WOcorrAssInf_Id = WOcorrAssInf.Id
and
  	WOAXWOAInf.WOcorrAss_Id = p_WOcorrAss_Id  
order by
  	WOcorrAssInf.Informacao 