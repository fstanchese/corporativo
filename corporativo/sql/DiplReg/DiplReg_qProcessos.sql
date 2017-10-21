select * from 
(
select 
  DiplReg.Registro                       as Registro,
  Diploma.DtExpedicao                    as DtExpedicao, 
  ShortName(WPessoa.Nome,35)             as NomeAluno,
  DiplProc.NrProcesso                    as NrProcesso,
  DiplReg.DtRegistro                     as DtRegistro,
  Depart_gsRecognize(DiplProc.Depart_Id) as Depart
from  
  DiplReg,
  DiplProc,
  Diploma,
  WPessoa
where
  Diploma.DiplReg_Id = DiplReg.Id
and
  Diploma.DiplProc_Id = DiplProc.Id
and
  DiplProc.WPessoa_Id = WPessoa.Id
and
  ( 
    trunc(Diploma.DtExpedicao) between p_HoraAula_DtInicio and p_HoraAula_DtTermino
    or
    ( p_HoraAula_DtInicio is null and p_HoraAula_DtTermino is null )
  )
and
  (
    p_DiplProc_Depart_Id is null
    or
    DiplProc.Depart_Id = nvl ( p_DiplProc_Depart_Id , 0 )
  )
and
  (  
     p_DiplProcTi_Id is null
     or
     DiplProc.DiplProcTi_Id = nvl ( p_DiplProcTi_Id , 0 )
  )
union
select 
  DiplReg.Registro                       as Registro,
  Apostila.DtApostila                    as DtExpedicao, 
  ShortName(WPessoa.Nome,35)             as NomeAluno,
  DiplProc.NrProcesso                    as NrProcesso,
  DiplReg.DtRegistro                     as DtRegistro,
  Depart_gsRecognize(DiplProc.Depart_Id) as Depart
from  
  DiplReg,
  DiplProc,
  Apostila,
  WPessoa
where
  Apostila.DiplReg_Id = DiplReg.Id
and
  Apostila.DiplProc_Id = DiplProc.Id
and
  DiplProc.WPessoa_Id = WPessoa.Id
and
  (
    p_DiplProc_Depart_Id is null
    or
    DiplProc.Depart_Id = nvl ( p_DiplProc_Depart_Id , 0 )
  )
and
  ( 
    trunc(Apostila.DtApostila) between p_HoraAula_DtInicio and p_HoraAula_DtTermino
    or
    ( p_HoraAula_DtInicio is null and p_HoraAula_DtTermino is null )
  )
and
  DiplProc.DiplProcTi_Id >= 118900000000004
)
order by 1