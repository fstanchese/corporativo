select
  GradAlu.Id                                   as GradAlu_Id,
  Horario_Id                                   as Horario_Id,
  GradAlu.WPessoa_Id                           as WPessoa_Id,
  Horario.Semana_Id                            as Semana_Id,
  HoraAula_gnRetEncaGradAlu( GradAlu.Id , Horario.Id , p_WPessoa_Id , Horario.Semana_Id , p_O_Data ) as GradAlu_Enca_Id,
  Semana.Nome                                  as DiaGrad,
  to_char(Horario.HoraInicio,'hh24:mi')        as HoraGrad,
  TurmaOfe_gsRetCodTurma(GradAlu.TurmaOfe_Id)  as TurmaGrad,
  CurrXDisc_gsRetCodDisc(GradAlu.CurrXDisc_Id) as DiscGrad
from
  Semana,
  GradAlu,
  TOXCD,
  Horario,
  HoraAula,
  TurmaOfe
where
  HoraAula_gnEncavalamento( GradAlu.Id , Horario.Id , p_WPessoa_Id , Horario.Semana_Id , p_O_Data )=1
and 
  p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
and
  TurmaOfe_gnRetPLetivo(GradAlu.TurmaOfe_Id) = nvl( p_PLetivo_Id ,0)
and
  Horario.Semana_Id = Semana.Id
and
  HoraAula.Horario_Id = Horario.Id
and
  ( 
    gradalu.divturma_teoria_id is null and gradalu.divturma_pratica_id is null 
      or 
    gradalu.divturma_teoria_id = horaaula.divturma_id
      or 
    gradalu.divturma_pratica_id = horaaula.divturma_id
  )
and
  HoraAula.TOXCD_ID = TOXCD.Id
and
  TurmaOfe.CurrOfe_Id is null
and
  TurmaOfe.Id = TOXCD.TurmaOfe_Id
and
  GradAlu.TurmaOfe_Id = TOXCD.TurmaOfe_Id
and
  GradAlu.GradAluTi_Id >= 8500000000001
and
  GradAlu.State_Id = 3000000003001
and
  GradAlu.WPessoa_Id = nvl( p_WPessoa_Id ,0)
