SELECT
  WOcorrAss.*,
  WOcorrAss.Nomenet as Recognize
FROM
  WOcorrAss
WHERE
    translate(upper(nomenet),'ацимстзг','AAEIOOUC') LIKE replace( trim( translate(upper( p_WOcorrAss_Nomenet ),'ацимстзг','AAEIOOUC') ),' ','%')||'%'
ORDER BY 
  Nomenet
 
