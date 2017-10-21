select
  LPre.Id                                    as LPRE_ID,
  TOXCD_gsRetTurma(HoraAula.TOXCD_Id)        as TURMA,
  TOXCD_gsRetDisciplina(HoraAula.TOXCD_Id)   as DISCIPLINA,
  TOXCD_gsRetCodDisc(HoraAula.TOXCD_Id)      as CODDISC,
  SubStr(LPreFolha.Id,8,7)                   as CODIGO,
  WPessoa_gsRecognize(LPre.WPessoa_Prof1_Id) as PROFESSOR,
  HoraAula.WPessoa_Prof1_Id                  as WPESSOA_ID,
  Campus_gsRecognize(Turma.Campus_Id)        as CAMPUS
from 
  LPre,
  LPreFolha,
  HoraAula,
  TOXCD,
  TurmaOfe,
  CurrOfe,
  Turma
where
  (
    p_Periodo_Id is null
    or
    CurrOfe.Periodo_Id = nvl ( p_Periodo_Id , 0 )
  )
and
  CurrOfe.Id = TurmaOfe.CurrOfe_Id
and
  Turma.Campus_Id = nvl( p_Campus_Id , 0 )
and
  TurmaOfe.Turma_Id = Turma.Id
and
  TOXCD.TurmaOfe_Id = TurmaOfe.Id
and
  HoraAula.TOXCD_Id = TOXCD.Id
and
  LPre.HoraAula_Id = HoraAula.Id
and
  LPreFolha.State_Id = 3000000009004
and
  LPreFolha.LPre_Id = LPre.Id 
and
  LPre.PLetivoP_Id = nvl( p_PLetivoP_Id ,0)
order by 
  Professor, Turma, CodDisc