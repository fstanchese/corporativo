SELECT
  WOcorrAss.*,
  WOcorrAss.Nomenet as Recognize
FROM
  WOcorrAss
WHERE
    translate(upper(nomenet),'��������','AAEIOOUC') LIKE replace( trim( translate(upper( p_WOcorrAss_Nomenet ),'��������','AAEIOOUC') ),' ','%')||'%'
ORDER BY 
  Nomenet
 
