SELECT
  WOcorrAssInf.*,
  WOcorrAssInf.Informacao as Recognize
FROM
  WOcorrAssInf
WHERE
    translate(upper(Informacao),'��������','AAEIOOUC') LIKE replace( trim( translate(upper( p_WOcorrAssInf_Informacao ),'��������','AAEIOOUC') ),' ','%')||'%'
ORDER BY 
  Informacao 
