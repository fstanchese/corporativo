select
  DiplReg.*,
  DiplProc.Id as DiplProc_Id,
  DiplProcTi_gsRecognize(DiplProc.DiplProcTi_Id) as TipoProcesso,
  substr(nrprocesso,5,6)||'/'||substr(nrprocesso,1,4) as NumProc,
  to_char(Registro,'00009') as NrRegistro  
from
  DiplReg,
  Diploma,
  Apostila,
  DiplProc
where
  (
    DiplProc.Id = Diploma.DiplProc_Id
    or
    DiplProc.Id = Apostila.DiplProc_Id
  )
and
  DiplReg.Id = Apostila.DiplReg_Id (+)
and
  DiplReg.Id = Diploma.DiplReg_Id (+)
and
  DiplReg.Id = nvl ( p_DiplReg_Id ,0 )

