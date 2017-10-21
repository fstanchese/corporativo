select
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
  Diploma.DiplProc_Id = nvl ( p_DiplProc_Id ,0)

