SELECT
  ProtMsg.*,
  ProtMsg.Protocolo as Recognize
FROM
  ProtMsg
WHERE
    translate(upper(Protocolo),'��������','AAEIOOUC') LIKE replace( trim( translate(upper( p_ProtMsg_Protocolo ),'��������','AAEIOOUC') ),' ','%')||'%'
ORDER BY 
  Protocolo
