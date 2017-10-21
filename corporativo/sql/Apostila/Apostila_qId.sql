select
  Apostila.*,
  decode(Curr.CurrNomeApostila,null,Upper(TempTitulo.CurrNomeApostila),Upper(Curr.CurrNomeApostila)) as CURRAPOSTILA,
  Diplproc.DiplProcTi_Id       as DiplProcTi_Id,
  DiplProc.State_Id            as State_Id,
  substr(nrprocesso,5,6)||'/'||substr(nrprocesso,1,4) as NumProc,
  Decode(WPessoa.Sexo_Id,500000000001,'Profª.',500000000002,'Prof.')||' '||WPessoa_gsrecognize(WPessoa_Diretor_Id) as Diretor,
  Decode(Apostila.Curr_Id,null,'',Curr.CurrNomeApostila||' ') || Decode(Apostila.Curr_02_Id,null,'',' e '||Curr_gsApostila(Apostila.Curr_02_Id)||' ') || Decode(Apostila.TempTitulo_Id,null,'',TempTitulo.CurrNomeApostila||' ')||decode(Apostila.Texto,null,'',substr(Apostila.Texto,1,180)||'...') as Recognize
from
  WPessoa,
  DiplProc,
  Apostila,
  TempTitulo,
  Curr
where
  diplproc.state_id <> 3000000026011
and
  WPessoa.Id = Apostila.WPessoa_Diretor_Id
and
  DiplProc.Id = Apostila.DiplProc_Id
and
  Apostila.Curr_Id = Curr.Id (+)
and
  Apostila.TempTitulo_Id = TempTitulo.Id (+)
and
  Apostila.Id = nvl( p_Apostila_Id ,0 )