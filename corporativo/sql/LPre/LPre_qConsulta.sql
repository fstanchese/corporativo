select
  PLetivoP.Nome || ' - ' || PLetivo.Nome           as NomePLetP,
  LPreFolha.LPre_Id                                as LPre_Id,
  LPreFolha.Id                                     as LPreFolha_Id,
  WPessoa_gsRecognize(LPre.WPessoa_Prof1_Id)       as Professor1,
  WPessoa_gsRecognize(LPre.WPessoa_Prof2_Id)       as Professor2,
  WPessoa_gsRecognize(LPre.WPessoa_Prof3_Id)       as Professor3,
  WPessoa_gsRecognize(LPre.WPessoa_Prof4_Id)       as Professor4,
  TOXCD_gsRetTurma(TOXCD.Id)                       as Turma,
  Sala_gsRecognize(Sala_Id)                        as Sala,
  TOXCD_gsRetCodDisc(TOXCD.Id)                     as CodDisc,
  DivTurma_gsRecognize(HoraAula.DivTurma_Id)       as DivTurma,
  shortname(DivDisc_gsRecognize(HoraAula.DivDisc_Id),30) as DivDisc,
  shortname(TOXCD_gsRetDisciplina(TOXCD_Id),30)    as NomeDisc,
  AulaTi_gsRecognize(HoraAula.AulaTi_Id)           as TipoAula,
  to_char(LPre.Dt1,'dd/mm/yyyy')                   as Dt1,
  to_char(LPre.Dt2,'dd/mm/yyyy')                   as Dt2,
  to_char(LPre.Dt3,'dd/mm/yyyy')                   as Dt3,
  upper(SubStr(to_char(LPre.Dt1,'day'),1,3))       as StrDt1,
  upper(SubStr(to_char(LPre.Dt2,'day'),1,3))       as StrDt2,
  upper(SubStr(to_char(LPre.Dt3,'day'),1,3))       as StrDt3,
  to_char(LPreFolha.Folha,'00')                    as Pagina,
  SubStr(LPreFolha.Id,8,7)                         as Codigo,
  to_char(LPre.Dt1,'HH24"h"MI"min."')              as Horario1,
  to_char(LPre.Dt2,'HH24"h"MI"min."')              as Horario2,
  to_char(LPre.Dt3,'HH24"h"MI"min."')              as Horario3,
  to_char(QtdAulas1,'00')                          as QtdAulas1,
  to_char(QtdAulas2,'00')                          as QtdAulas2,
  to_char(QtdAulas3,'00')                          as QtdAulas3,
  to_char(TOXCD_gnRetChAnual(PLetivo.Id,TOXCD.ID)/4,'000') as LimiteFaltas,
  Curso.Nome                                       as Curso,
  LPre.HoraAula_Id                                 as HoraAula_Id,
  HoraAula.DivDisc_Id                              as DivDisc_Id,
  State_gsRecognize(LPreFolha.State_Id)            as State
from
  LPre,
  LPreFolha,
  Horario,
  HoraAula,
  TOXCD,
  TurmaOfe,
  Curso,
  Turma,
  PLetivoP,
  PLetivo
where
  LPre.Id = LPreFolha.LPre_Id
and
  Curso.Id = Turma.Curso_Id
and
  Turma.Id = TurmaOfe.Turma_Id
and
  TurmaOfe.Id = TOXCD.TurmaOfe_Id
and
  TOXCD.Id = HoraAula.TOXCD_Id
and
  (
    p_TurmaOfe_Id is null
      or
    TurmaOfe.Id = nvl( p_TurmaOfe_Id ,0)
  )
and
  (
    p_TOXCD_Id is null
      or
    HoraAula.TOXCD_Id = nvl( p_TOXCD_Id ,0)
  )
and
  ( 
    p_AulaTi_Id is null
      or
    HoraAula.AulaTi_Id = nvl( p_AulaTi_Id ,0)
  )
and
  ( 
    p_DivTurma_Id is null
      or
    HoraAula.DivTurma_Id = nvl( p_DivTurma_Id ,0)
  )
and
  ( 
    p_DivDisc_Id is null
      or
    HoraAula.DivDisc_Id = nvl( p_DivDisc_Id ,0)
  )
and
  Horario.Id = HoraAula.Horario_Id
and
  HoraAula.Id = LPre.HoraAula_Id
and
  (
    p_WPessoa_Id is null
      or
    LPre.WPessoa_Prof1_Id  = nvl( p_WPessoa_Id ,0)
  ) 
and
  PLetivoP.Id = LPre.PLetivoP_Id
and
  PLetivo.Id = PLetivoP.PLetivo_Id
and
  PLetivoP.Id  = nvl( p_PLetivoP_Id ,0)
order by
  LPreFolha.LPre_Id,Professor1,Professor2,LPreFolha.Folha