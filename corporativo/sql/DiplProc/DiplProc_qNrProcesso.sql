SELECT
  DiplProc.*
FROM
  DiplProc,
  TempTitulo,
  Curr  
WHERE
  curr.id (+) = diplproc.curr_id 
AND
  temptitulo.id (+) = diplproc.temptitulo_id 
AND
  DiplProc.NrProcesso = nvl( p_DiplProc_NrProcesso ,0)  
  