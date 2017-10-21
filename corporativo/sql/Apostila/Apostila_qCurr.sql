select
  Apostila.*,
  decode(Curr.CurrNomeApostila,null,Upper(TempTitulo.CurrNomeApostila),Upper(Curr.CurrNomeApostila)) || Decode(Apostila.Curr_02_Id,null,'',' e '||Upper(Curr_gsApostila(Apostila.Curr_02_Id))) as CURRAPOSTILA,
  Diplproc.DiplProcTi_Id       as DiplProcTi_Id,
  DiplProc.State_Id            as State_Id,
  substr(nrprocesso,5,6)||'/'||substr(nrprocesso,1,4) as NumProc,
  Decode(WPessoa.Sexo_Id,500000000001,'Profª.',500000000002,'Prof.')||' '||WPessoa_gsrecognize(WPessoa_Diretor_Id) as Diretor,
  Decode(WPessoa.Sexo_Id,500000000001,'a','')     as Sexo_Diretor,
  DECODE(Curr.RECONHECIMENTO,NULL,temptitulo.reconhecimento, Curr.RECONHECIMENTO) as Reconhecimento,
  diplproc.id as diplproc_processo_id
from
  WPessoa,
  DiplProc,
  Apostila,
  TempTitulo,
  Curr
where
  DiplProc.State_Id <> 3000000026011
and
  WPessoa.Id (+)= Apostila.WPessoa_Diretor_Id
and
  DiplProc.Id = Apostila.DiplProc_Id (+)
and
  Apostila.Curr_Id = Curr.Id (+)
and
  Apostila.TempTitulo_Id = TempTitulo.Id (+)
and
  DiplProc.Id in
  ( select DiplProc.Id from DiplProc start with DiplProc.Id = nvl( p_DiplProc_Id ,0) connect by PRIOR DiplProc_Pai_Id = DiplProc.Id )
order by DiplProc.NrProcesso,Apostila.Id