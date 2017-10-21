(
select
  HoraAula_gnAulaProfessor( WPessoa_Prof1_Id, p_TurmaTi_Id , null,null,null,null,null) as NrAulas,
  WPessoa.Nome                                                as Professor,
  WPessoa.RegTrab_Id                                          as RegTrab_Id,
  WPessoa_gnMemAdm(WPessoa_Prof1_Id)                          as MemAdm,
  RegTrab_gsrecognize(wpessoa.regtrab_id)                     as REGTRAB, 
  class_gsrecognize(class_id)                                 as CLASSIFICACAO
from
  HoraAula,
  Horario,
  WPessoa
where
  HoraAula.WPessoa_Prof1_Id = WPessoa.Id
and
  HoraAula.Horario_Id=Horario.Id
and
  p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
)
union
(
select
  HoraAula_gnAulaProfessor( WPessoa_Prof2_Id, p_TurmaTi_Id , null,null,null,null,null) as NrAulas,
  WPessoa.Nome                                                as Professor,
  WPessoa.RegTrab_Id                                          as RegTrab_Id,
  WPessoa_gnMemAdm(WPessoa_Prof2_Id)                          as MemAdm,
  RegTrab_gsrecognize(wpessoa.regtrab_id)                     as REGTRAB, 
  class_gsrecognize(class_id)                                 as CLASSIFICACAO
from
  HoraAula,
  Horario,
  WPessoa
where
  HoraAula.WPessoa_Prof2_Id = WPessoa.Id
and
  HoraAula.Horario_Id=Horario.Id
and
  p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
)
union
(
select
  HoraAula_gnAulaProfessor( WPessoa_Prof3_Id, p_TurmaTi_Id , null,null,null,null,null) as NrAulas,
  WPessoa.Nome                                                as Professor,
  WPessoa.RegTrab_Id                                          as RegTrab_Id,
  WPessoa_gnMemAdm(WPessoa_Prof3_Id)                          as MemAdm,
  RegTrab_gsrecognize(wpessoa.regtrab_id)                     as REGTRAB, 
  class_gsrecognize(class_id)                                 as CLASSIFICACAO
from
  HoraAula,
  Horario,
  WPessoa
where
  HoraAula.WPessoa_Prof3_Id = WPessoa.Id
and
  HoraAula.Horario_Id=Horario.Id
and
  p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
)
union
(
select
  HoraAula_gnAulaProfessor( WPessoa_Prof4_Id, p_TurmaTi_Id , null,null,null,null,null) as NrAulas,
  WPessoa.Nome                                                as Professor,
  WPessoa.RegTrab_Id                                          as RegTrab_Id,
  WPessoa_gnMemAdm(WPessoa_Prof4_Id)                          as MemAdm,
  RegTrab_gsrecognize(wpessoa.regtrab_id)                     as REGTRAB, 
  class_gsrecognize(class_id)                                 as CLASSIFICACAO
from
  HoraAula,
  Horario,
  WPessoa
where
  HoraAula.WPessoa_Prof4_Id = WPessoa.Id
and
  HoraAula.Horario_Id=Horario.Id
and
  p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
)
order by Professor