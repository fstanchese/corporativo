SELECT
  WOcorrAssInf.*,
  WOcorrAssInf.Informacao as Recognize
FROM
  WOcorrAssInf
WHERE
    translate(upper(Informacao),'ацимстзг','AAEIOOUC') LIKE replace( trim( translate(upper( p_WOcorrAssInf_Informacao ),'ацимстзг','AAEIOOUC') ),' ','%')||'%'
ORDER BY 
  Informacao 
