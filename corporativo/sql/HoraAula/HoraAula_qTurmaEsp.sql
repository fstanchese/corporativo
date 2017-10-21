select
  HoraAula.Id                                as Id,
  HoraAula.DtInicio                          as DtInicio,
  DiscEsp.Nome                               as Nomedisc,
  DiscEsp.NomeReduz                          as Coddisc,
  To_Char(Horario.HoraInicio,'hh24:mi')      as Hora,
  AulaTi_gsRecognize(AulaTi_Id)              as TipoAula,
  WPessoa_gsRecognize(WPessoa_Prof1_Id)      as Prof1,
  WPessoa_gsRecognize(WPessoa_Prof2_Id)      as Prof2,
  WPessoa_gsRecognize(WPessoa_Prof3_Id)      as Prof3,
  WPessoa_gsRecognize(WPessoa_Prof4_Id)      as Prof4,
  Sala_gsRecognize(Sala_Especial_Id)         as SalaEspecial,
  nvl(divturma_gsrecognize(DivTurma_Id),' ') as Divisao,
  Semana_gsRecognize(Semana.Id)              as Diasemana,
  Semana.Numero                              as Numero,
  HoraAula_gsRecognize(HoraAula.Id)          as Recognize,
  TurmaOfe.Id                                as TurmaOfe_Id,
  AreaAcad_gsRecognize(DiscEsp.AreaAcad_Id)  as AreaAcad,
  turma_gsrecognize(turmaofe.turma_id)       as Turma,
  Campus_gsRecognize(Turma.Campus_Id)        as Campus
from
  Semana,
  Horario,
  DiscEsp,
  TOXCD,
  HoraAula,
  TurmaOfe,
  Turma
where
  p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
and
  Semana.Id (+) = Horario.Semana_id 
and
  Horario.id (+) = HoraAula.Horario_Id 
and
  HoraAula.TOXCD_Id = TOXCD.Id
and
  TurmaOfe.Turma_Id = Turma.Id
and
  TurmaOfe.Id = TOXCD.TurmaOfe_Id
and
  DiscEsp.id = Turmaofe.DiscEsp_Id
and
  (
    p_TurmaOfe_Id is null
      or
    TurmaOfe.Id = nvl( p_TurmaOfe_Id ,0)
  )
and
  ( 
    p_DiscEspTi_Id is null
      or
    DiscEsp.DiscEspTi_Id = nvl( p_DiscEspTi_Id ,0)
  ) 
and
  ( 
    p_AreaAcad_Id is null
      or
    DiscEsp.AreaAcad_Id = nvl( p_AreaAcad_Id ,0)
  ) 
and
  DiscEsp.PLetivo_Id = nvl( p_PLetivo_Id ,0)
order by
  Turma,Numero,Hora