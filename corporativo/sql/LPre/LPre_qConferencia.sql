select * from (
select
  LPreFolha_gnRetQtdLPre(LPre.PLetivoP_Id,HoraAula.TOXCD_Id,HoraAula.DivTurma_Id,HoraAula.AulaTi_Id) as Qtde,
  shortname(nvl(WPessoa_gsRecognize(LPre.WPessoa_Prof1_Id),'Sem Professor'),35)                      as WPessoa_Recognize,
  shortname(nvl(WPessoa_gsRecognize(LPre.WPessoa_Prof2_Id),''),35)                                   as WPessoa2_Recognize,
  shortname(nvl(WPessoa_gsRecognize(LPre.WPessoa_Prof3_Id),''),35)                                   as WPessoa3_Recognize,
  shortname(nvl(WPessoa_gsRecognize(LPre.WPessoa_Prof4_Id),''),35)                                   as WPessoa4_Recognize,
  AulaTi_gsRecognize(AulaTi_Id)                                                                      as AulaTi_Recognize,
  nvl(DivTurma_gsRecognize(DivTurma_Id),'Única')                                                     as DivTurma_Recognize,
  TOXCD_gsRetCodDisc(HoraAula.TOXCD_Id)                                                              as CodDisc,
  TOXCD_gsRetTurma(HoraAula.TOXCD_Id)                                                                as Turma,
  Turma.Campus_Id                                                                                    as Campus_Id
from
  LPre,
  HoraAula,
  Horario,
  TOXCD,
  TurmaOfe,
  Turma,
  CurrOfe,
  Curr,
  Curso
where
  CurrOfe.Curr_Id = Curr.Id
and
  TurmaOfe.CurrOfe_Id = CurrOfe.Id
and
  TurmaOfe.Turma_Id = Turma.Id
and
  TOXCD.TurmaOfe_Id = TurmaOfe.Id
and
  HoraAula.TOXCD_Id = TOXCD.Id
and
  HoraAula.Horario_Id = Horario.Id
and
  LPre.HoraAula_Id = HoraAula.Id
and
  (
    Curr.Curso_Id = nvl( p_Curso_Id ,0)
     or
    p_Curso_Id is null
  )
and
  (
    Turma.Campus_Id = nvl( p_Campus_Id ,0)
    or
    p_Campus_Id is null
  )
and
  (    
    Horario.Periodo_Id = nvl( p_Periodo_Id ,0)
    or
    p_Periodo_Id is null
  )
and
  LPre.PLetivoP_Id = nvl( p_PLetivoP_Id ,0)
group by
  LPre.PLetivoP_Id,HoraAula.TOXCD_Id,LPre.WPessoa_Prof1_Id,LPre.WPessoa_Prof2_Id,LPre.WPessoa_Prof3_Id,LPre.WPessoa_Prof4_Id,AulaTi_Id,DivTurma_Id,Turma.Campus_Id
union
select
  LPreFolha_gnRetQtdLPre(LPre.PLetivoP_Id,HoraAula.TOXCD_Id,HoraAula.DivTurma_Id,HoraAula.AulaTi_Id) as Qtde,
  shortname(nvl(WPessoa_gsRecognize(LPre.WPessoa_Prof1_Id),'Sem Professor'),35)                      as WPessoa_Recognize,
  shortname(nvl(WPessoa_gsRecognize(LPre.WPessoa_Prof2_Id),''),35)                                   as WPessoa2_Recognize,
  shortname(nvl(WPessoa_gsRecognize(LPre.WPessoa_Prof3_Id),''),35)                                   as WPessoa3_Recognize,
  shortname(nvl(WPessoa_gsRecognize(LPre.WPessoa_Prof4_Id),''),35)                                   as WPessoa4_Recognize,
  AulaTi_gsRecognize(AulaTi_Id)                                                                      as AulaTi_Recognize,
  nvl(DivTurma_gsRecognize(DivTurma_Id),'Única')                                                     as DivTurma_Recognize,
  TOXCD_gsRetCodDisc(HoraAula.TOXCD_Id)                                                              as CodDisc,
  TOXCD_gsRetTurma(HoraAula.TOXCD_Id)                                                                as Turma,
  Turma.Campus_Id                                                                                    as Campus_Id
from
  LPre,
  HoraAula,
  Horario,
  TOXCD,
  TurmaOfe,
  Turma,
  DiscEsp
where
  TurmaOfe.DiscEsp_Id = DiscEsp.Id
and
  TurmaOfe.Turma_Id = Turma.Id
and
  TOXCD.TurmaOfe_Id = TurmaOfe.Id
and
  HoraAula.TOXCD_Id = TOXCD.Id
and
  HoraAula.Horario_Id = Horario.Id
and
  LPre.HoraAula_Id = HoraAula.Id
and
  (
    Turma.Curso_Id = nvl( p_Curso_Id ,0)
     or
    p_Curso_Id is null
  )
and
  (
    Turma.Campus_Id = nvl( p_Campus_Id ,0)
    or
    p_Campus_Id is null
  )
and
  (    
    Horario.Periodo_Id = nvl( p_Periodo_Id ,0)
    or
    p_Periodo_Id is null
  )
and
  LPre.PLetivoP_Id = nvl( p_PLetivoP_Id ,0)
group by
  LPre.PLetivoP_Id,HoraAula.TOXCD_Id,LPre.WPessoa_Prof1_Id,LPre.WPessoa_Prof2_Id,LPre.WPessoa_Prof3_Id,LPre.WPessoa_Prof4_Id,AulaTi_Id,DivTurma_Id,Turma.Campus_Id
)
order by
  Campus_Id,WPessoa_Recognize,Turma,CodDisc,DivTurma_Recognize