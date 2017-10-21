SELECT
  DiplProc.*,
  substr(nrprocesso,5,6)||'/'||substr(nrprocesso,1,4)|| ' - ' || DiplProcTi_gsRecognize(DiplProcTi_Id) AS Recognize,
  nvl(curr.CurrNomeDipl,TempTitulo.CurrNomeVerso) AS Curso
FROM
  DiplProc,
  TempTitulo,
  Curr  
WHERE
  curr.id (+) = diplproc.curr_id 
AND
  temptitulo.id (+) = diplproc.temptitulo_id 
AND
  (
    DiplProc.WPessoa_Id = nvl( p_WPessoa_Id ,0)
    OR 
    DiplProc.NrProcesso = nvl( p_DiplProc_NrProcesso ,0)
  )
ORDER BY NrProcesso
  