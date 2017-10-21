select
  Turma_gsRecognize(Turma.Id)             as Turma,
  Semana_gsRecognize(Horario.Semana_Id)   as Dia,
  to_char(HoraInicio,'hh24:mi')           as Hora,
  WPessoa_gsRecognize(WPessoa_Prof1_Id)   as Professor,
  WPessoa_Prof1_Id                        as Professor_Id,
  DiscEsp.DiscEspTi_Id                    as DiscEspTi_Id,
  RegTrab_gsRecognize(WPessoa.RegTrab_Id) as RegTrab,
  Class_gsRecognize(WPessoa.Class_Id)     as Classificacao,
  HoraAula.DtInicio                       as DtInicio,
  TurmaOfe.Id                             as TurmaOfe_Id,
  Horario.Id                              as Horario_Id,
  TOXCD.CustoZero                         as CustoZero
from
  Horario,
  HoraAula,
  TOXCD,
  TurmaOfe,
  Turma,
  DiscEsp,
  WPessoa
where
  p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
and
  WPessoa.Id = HoraAula.WPessoa_Prof1_Id
and
  HoraAula.TOXCD_Id = TOXCD.Id
and
  TOXCD.TurmaOfe_Id = TurmaOfe.Id
and
  TurmaOfe.Turma_Id = Turma.Id
and
  TurmaOfe.DiscEsp_Id = DiscEsp.Id
and
  Turma.TurmaTi_Id = 6600000000002
and
  HoraAula.Horario_Id = Horario.Id
and
  (
    p_DiscEspTi_Id is null
    or
    DiscEsp.DiscEspTi_Id = nvl ( p_DiscEspTi_Id , 0 )
  )
order by
  Professor,Dia,Hora,Turma