select
	WOcorrAssReP.*,
  	WOcorrAssReP_gsRecognize(WOcorrAssRep.Id) as Recognize,
  	Depart_gsRecognize(WOcorrAssReP.Depart_Id) as Depart_Recognize,
  	WOcorrAss_gsRecognize(WOAXWOARep.WOcorrAss_Id) as WOcorrAss_Recognize
from
  	WOcorrAssReP,
  	WOAXWOARep
where
  	WOcorrAssReP.Id = WOAXWOAReP.WOcorrAssReP_Id
and
	(
		WOcorrAssReP.Depart_Id = p_Depart_Id 
	or
		p_Depart_Id is null
	)
and
	(
  		WOAXWOAReP.WOcorrAss_Id = p_WOcorrAss_Id
  	or
  		p_WOcorrAss_Id is null
  	)
order by
  WOcorrAss_Recognize, Depart_Recognize, Referencia