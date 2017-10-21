select count(turma) as Qtde
from
(
(
select
  SubStr(Periodo_gsRecognize(Periodo_Id),1,12)     as Periodo_Recognize,
  SubStr(Semana_gsRecognize(Semana_Id),1,12)       as Semana_Recognize,
  to_char(Horario.HoraInicio,'hh24:mi')            as Horario,
  Semana_Id                                        as Semana_Id ,
  SubStr(TOXCD_gsRetTurma(HoraAula.TOXCD_Id),1,12) as Turma
from
  HoraAula,
  Horario
where
  p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
and  
  HoraAula.Horario_Id = Horario.Id
and
  Horario.Semana_Id = p_Semana_Id
and
  Periodo_Id = p_Periodo_Id
and
  Admissao_gnAtivo(HoraAula.WPessoa_Prof1_Id , p_O_Data ) = 1
and
  WPessoa_Prof1_Id = p_WPessoa_Id
)
union
(
select
  SubStr(Periodo_gsRecognize(Periodo_Id),1,12)     as Periodo_Recognize,
  SubStr(Semana_gsRecognize(Semana_Id),1,12)       as Semana_Recognize,
  to_char(Horario.HoraInicio,'hh24:mi')            as Horario,
  Semana_Id                                        as Semana_Id ,
  SubStr(TOXCD_gsRetTurma(HoraAula.TOXCD_Id),1,12) as Turma
from
  HoraAula,
  Horario
where
  p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
and  
  HoraAula.Horario_Id = Horario.Id
and
  Horario.Semana_Id = p_Semana_Id
and
  Periodo_Id = p_Periodo_Id
and
  Admissao_gnAtivo(HoraAula.WPessoa_Prof2_Id , p_O_Data ) = 1
and
  WPessoa_Prof2_Id = p_WPessoa_Id
)
union
(
select
  SubStr(Periodo_gsRecognize(Periodo_Id),1,12)   as Periodo_Recognize,
  SubStr(Semana_gsRecognize(Semana_Id),1,12)     as Semana_Recognize,
  to_char(Horario.HoraInicio,'hh24:mi')          as Horario,
  Semana_Id                                      as Semana_Id ,
  SubStr(TOXCD_gsRetTurma(HoraAula.TOXCD_Id),1,12) as Turma
from
  HoraAula,
  Horario
where
  p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
and  
  HoraAula.Horario_Id = Horario.Id
and
  Horario.Semana_Id = p_Semana_Id
and
  Periodo_Id = p_Periodo_Id
and
  Admissao_gnAtivo(HoraAula.WPessoa_Prof3_Id , p_O_Data ) = 1
and
  WPessoa_Prof3_Id = p_WPessoa_Id
)
union
(
select
  SubStr(Periodo_gsRecognize(Periodo_Id),1,12)     as Periodo_Recognize,
  SubStr(Semana_gsRecognize(Semana_Id),1,12)       as Semana_Recognize,
  to_char(Horario.HoraInicio,'hh24:mi')            as Horario,
  Semana_Id                                        as Semana_Id,
  SubStr(TOXCD_gsRetTurma(HoraAula.TOXCD_Id),1,12) as Turma
from
  HoraAula,
  Horario
where
  p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
and  
  HoraAula.Horario_Id = Horario.Id
and
  Horario.Semana_Id = p_Semana_Id
and
  Periodo_Id = p_Periodo_Id
and
  Admissao_gnAtivo(HoraAula.WPessoa_Prof4_Id , p_O_Data ) = 1
and
  WPessoa_Prof4_Id = p_WPessoa_Id
)
order by
  Semana_Id,Horario
)