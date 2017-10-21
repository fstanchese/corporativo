select
  substr(nrprocesso,5,6)||'/'||substr(nrprocesso,1,4) as NumProc,
  to_char(DiplReg.Registro,'000009') as NrRegistro,  
  DiplReg.Registro,
  DiplReg.DtRegistro,
  Diploma.Vias,
  Diploma.Id as Id
from
  Diploma,
  DiplReg,
  DiplProc
where
  DiplProc.State_Id <> 3000000026011
and
  DiplProc.Id = Diploma.DiplProc_Id
and
  DiplReg.Id = Diploma.DiplReg_Id
and
  Diploma.DiplReg_Id = nvl ( p_DiplReg_Id ,0)

