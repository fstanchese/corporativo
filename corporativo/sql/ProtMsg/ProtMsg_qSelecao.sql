SELECT
  ProtMsg.*,
  ProtMsg.Protocolo as Recognize
FROM
  ProtMsg
WHERE
    translate(upper(Protocolo),'ацимстзг','AAEIOOUC') LIKE replace( trim( translate(upper( p_ProtMsg_Protocolo ),'ацимстзг','AAEIOOUC') ),' ','%')||'%'
ORDER BY 
  Protocolo
