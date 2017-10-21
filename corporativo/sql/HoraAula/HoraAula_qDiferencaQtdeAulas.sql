(
select
  WPessoa.Id                    as WPessoa_Id,
  shortname(WPessoa.Nome,50)    as Professor,
  WPessoa.Sexo_Id               as Sexo_Id
from
  HoraAula,
  Horario,
  WPessoa
where
  HoraAula.WPessoa_Prof1_Id = WPessoa.Id
and
  HoraAula.Horario_Id = Horario.Id
and
(
  p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
or
  p_O_DtA between HoraAula.DtInicio and HoraAula.DtTermino
)
)
union
(
select
  WPessoa.Id                    as WPessoa_Id,
  shortname(WPessoa.Nome,50)    as Professor,
  WPessoa.Sexo_Id               as Sexo_Id
from
  HoraAula,
  Horario,
  WPessoa
where
  HoraAula.WPessoa_Prof2_Id = WPessoa.Id
and
  HoraAula.Horario_Id = Horario.Id
and
(
  p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
or
  p_O_DtA between HoraAula.DtInicio and HoraAula.DtTermino
)
)
union
(
select
  WPessoa.Id                    as WPessoa_Id,
  shortname(WPessoa.Nome,50)    as Professor,
  WPessoa.Sexo_Id               as Sexo_Id
from
  HoraAula,
  Horario,
  WPessoa
where
  HoraAula.WPessoa_Prof3_Id = WPessoa.Id
and
  HoraAula.Horario_Id = Horario.Id
and
(
  p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
or
  p_O_DtA between HoraAula.DtInicio and HoraAula.DtTermino
)
)
union
(
select
  WPessoa.Id                    as WPessoa_Id,
  shortname(WPessoa.Nome,50)    as Professor,
  WPessoa.Sexo_Id               as Sexo_Id
from
  HoraAula,
  Horario,
  WPessoa
where
  HoraAula.WPessoa_Prof4_Id = WPessoa.Id
and
  HoraAula.Horario_Id = Horario.Id
and
(
  p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
or
  p_O_DtA between HoraAula.DtInicio and HoraAula.DtTermino
)
)
order by professor
