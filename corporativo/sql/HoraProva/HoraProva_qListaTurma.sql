(
  select
    TOXCD.Id                                                     as TOXCD_ID,
    Periodo.Nome                                                 as Periodo,
    to_char(HoraProva.data,'dd/mm/yyyy')                         as Dia,
    Curso.Nome                                                   as Curso,
    Turma.Codigo                                                 as Turma,
    CriAvalPDt_gsRecognize(HoraProva.CriAvalPDt_Id)              as CriAvalPDt,
    Sala_gsRecognize(HoraProva.Sala_Id)                          as Sala,
    DivTurma_gsRecognize(HoraProva.DivTurma_Id)                  as DivTurma,
    HoraProva.DivTurma_Id                                        as DivTurma_Id,
    to_char(HoraProva.data,'HH24:mi')                            as Hora,
    shortname(WPessoa_gsRecognize(HoraProva.WPessoa_Id),23)      as Professor,
    shortname(WPessoa_gsRecognize(TOXCD.WPessoa_ProfResp_Id),23) as ProfResp,
    Disc.Codigo                                                  as CodDisc,
    shortname(Disc.Nome,35)                                      as NomeDisc,
    to_char(HoraProva.Data,'day')                                as StrDia,
    HoraProva.Duracao                                            as Duracao,
    null                                                         as AreaAcad,
    TurmaOfe.Id                                                  as TurmaOfe_Id,
    PLetivo_gsRecognize(CurrOfe.PLetivo_Id)                      as AnoLetivo,
    Turma.TurmaTi_Id                                             as TurmaTi_Id,
    GradAlu_gnRetQtdeMatric(TOXCD.Id,HoraProva.DivTurma_Id,CriAvalPDt.CriAvalP_Id)      as QtdeAlunos,
    Curso.Id                                                     as Curso_Id,
    CriAvalPDt.CriAvalP_Id                                       as CriAvalP_Id
  from
    HoraProva,
    CriAvalPDt,
    TOXCD,
    TurmaOfe,
    CurrOfe,
    Turma,
    Periodo,
    CurrXDisc,
    Disc,
    Curr,
    Curso,
    DivTurma
  where
    Curso.Id = Curr.Curso_Id
  and
    Curr.Id = CurrOfe.Curr_Id
  and
    Disc.Id = CurrXDisc.Disc_Id
  and
    Periodo.Id = Turma.Periodo_Id
  and
    Turma.Id = TurmaOfe.Turma_Id
  and
    CurrOfe.Id = TurmaOfe.CurrOfe_Id
  and
    TurmaOfe.Id = TOXCD.TurmaOfe_Id 
  and
    CurrXDisc.Id = TOXCD.CurrXDisc_Id 
  and
    HoraProva.CriAvalPDt_Id = CriAvalPDt.Id
  and
    DivTurma.Id = HoraProva.DivTurma_Id
  and
    TOXCD.Id = HoraProva.TOXCD_Id
  and
    (
      p_Campus_Id is null
       or
      Turma.Campus_Id = nvl( p_Campus_Id ,0)
    )
  and
    (
      p_TurmaOfe_Id is null
       or
      TurmaOfe.Id = nvl( p_TurmaOfe_Id ,0)
    )
  and
    (
      p_DivTurma_Id is null
       or
      DivTurma.Id = nvl( p_DivTurma_Id ,0) 
    )
  and
    (
      p_Periodo_Id is null
        or  
      Periodo.Id = nvl( p_Periodo_Id ,0)
    )
  and
    (
      p_TOXCD_Id is null
       or
      TOXCD.Id = nvl( p_TOXCD_Id ,0) 
    )
  and
    (
      p_Curso_Id is null
        or 
      Curso.Id = nvl( p_Curso_Id ,0)
    )
  and
    HoraProva.Facul_Id is null 
  and 
    HoraProva.CriAvalPDt_Id = nvl( p_CriAvalPDt_Id ,0)
)
union
(
  select
    TOXCD.Id                                                     as TOXCD_ID,
    null                                                         as Periodo,
    to_char(HoraProva.data,'dd/mm/yyyy')                         as Dia,
    Curso.Nome                                                   as Curso,
    Turma.Codigo                                                 as Turma,
    CriAvalPDt_gsRecognize(HoraProva.CriAvalPDt_Id)              as CriAvalPDt,
    Sala_gsRecognize(HoraProva.Sala_Id)                          as Sala,
    DivTurma_gsRecognize(HoraProva.DivTurma_Id)                  as DivTurma,
    HoraProva.DivTurma_Id                                        as DivTurma_Id,
    to_char(HoraProva.data,'HH24:mi')                            as Hora,
    shortname(WPessoa_gsRecognize(HoraProva.WPessoa_Id),23)      as Professor,
    shortname(WPessoa_gsRecognize(TOXCD.WPessoa_ProfResp_Id),23) as ProfResp,
    DiscEsp.NomeReduz                                            as CodDisc,
    Shortname(DiscEsp.Nome,35)                                   as NomeDisc,
    to_char(HoraProva.Data,'day')                                as StrDia,
    HoraProva.Duracao                                            as Duracao,
    AreaAcad_gsRecognize(DiscEsp.AreaAcad_Id)                    as AreaAcad,
    TurmaOfe.Id                                                  as TurmaOfe_Id,
    PLetivo_gsRecognize(DiscEsp.PLetivo_Id)                      as AnoLetivo,
    Turma.TurmaTi_Id                                             as TurmaTi_Id,
    GradAlu_gnRetQtdeMatric(TOXCD.Id,HoraProva.DivTurma_Id,CriAvalPDt.CriAvalP_Id)      as QtdeAlunos,
    Curso.Id                                                     as Curso_Id,
    CriAvalPDt.CriAvalP_Id                                       as CriAvalP_Id
  from
    HoraProva,
    CriAvalPDt,
    TOXCD,
    TurmaOfe,
    Turma,
    DiscEsp,
    Curso,
    DivTurma,
    AreaAcad
  where
    Curso.Id = Turma.Curso_Id
  and
    Turma.Id = TurmaOfe.Turma_Id
  and
    AreaAcad.Id = DiscEsp.AreaAcad_Id
  and
    DiscEsp.Id = TurmaOfe.DiscEsp_Id
  and
    TurmaOfe.Id = TOXCD.TurmaOfe_Id 
  and
    HoraProva.CriAvalPDt_Id = CriAvalPDt.Id
  and
    DivTurma.Id = HoraProva.DivTurma_Id
  and
    TOXCD.Id = HoraProva.TOXCD_Id
  and
    (
      p_Campus_Id is null
       or
      Turma.Campus_Id = nvl( p_Campus_Id ,0)
    )
  and
    (
      p_TurmaOfe_Id is null
       or
      TurmaOfe.Id = nvl( p_TurmaOfe_Id ,0) 
    )
  and
    (
      p_AreaAcad_Id is null
        or
      AreaAcad.Id = nvl( p_AreaAcad_Id ,0)
    )
  and
    (
      p_DivTurma_Id is null
       or
      DivTurma.Id = nvl( p_DivTurma_Id ,0) 
    )
  and
    (
      p_TOXCD_Id is null
       or
      TOXCD.Id = nvl( p_TOXCD_Id ,0) 
    )
  and
    ( 
      p_Curso_Id is null
       or
      Curso.Id = nvl( p_Curso_Id ,0)
    )
  and
    HoraProva.Facul_Id is null 
  and
    HoraProva.CriAvalPDt_Id = nvl( p_CriAvalPDt_Id ,0)
)
order by
  Curso,Turma,CodDisc,DivTurma