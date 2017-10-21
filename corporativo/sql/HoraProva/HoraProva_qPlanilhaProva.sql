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
    Disc.Nome                                                    as NomeDisc,
    InitCap(to_char(HoraProva.Data,'day'))                       as StrDia,
    HoraProva.Duracao                                            as Duracao,
    null						   as AreaAcad,
    TurmaOfe.Id                                                  as TurmaOfe_Id,
    Campus_gsRecognize(Turma.Campus_Id)                          as Campus 
  from
    HoraProva,
    TOXCD,
    TurmaOfe,
    CurrOfe,
    Turma,
    Periodo,
    CurrXDisc,
    Disc,
    Curr,
    Curso
  where
    (
      p_Campus_Id is null
       or
      Turma.Campus_Id = nvl( p_Campus_Id ,0)
    )
  and
    ( 
      trunc(HoraProva.data) = p_HoraProva_DataProva 
        or
      p_HoraProva_DataProva is null
    )
  and
    Curr.Curso_Id = Curso.Id
  and
    CurrOfe.Curr_Id = Curr.Id
  and
    CurrXDisc.Disc_Id = Disc.Id
  and
    Periodo.Id = Turma.Periodo_Id
  and
    Turma.Periodo_Id = nvl ( p_Periodo_Id , 0 )
  and
    TOXCD.CurrXDisc_Id = CurrXDisc.Id
  and
    TurmaOfe.Turma_Id = Turma.Id
  and
    TurmaOfe.CurrOfe_Id = CurrOfe.Id
  and
    TOXCD.TurmaOfe_Id = TurmaOfe.Id
  and
    HoraProva.TOXCD_Id = TOXCD.Id
  and
    Curr.Curso_Id = nvl( p_Curso_Id , 0 )
  and
    HoraProva.Facul_Id is null 
  and
    HoraProva.CriAvalPDt_Id = nvl ( p_CriAvalPDt_Id , 0 )
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
    DiscEsp.Nome                                                 as NomeDisc,
    InitCap(to_char(HoraProva.Data,'day'))                       as StrDia,
    HoraProva.Duracao                                            as Duracao,
    AreaAcad_gsRecognize(DiscEsp.AreaAcad_Id)                    as AreaAcad,
    TurmaOfe.Id                                                  as TurmaOfe_Id,
    Campus_gsRecognize(Turma.Campus_Id)                          as Campus 
  from
    HoraProva,
    TOXCD,
    TurmaOfe,
    Turma,
    DiscEsp,
    Curso
  where
    (
      p_Campus_Id is null
       or
      Turma.Campus_Id = nvl( p_Campus_Id ,0)
    )
  and
    ( 
       trunc(HoraProva.data) = p_HoraProva_DataProva 
       or
       p_HoraProva_DataProva is null
    )
  and
    Curso.Id = Turma.Curso_Id
  and
    Turma.Id = TurmaOfe.Turma_Id
  and
    DiscEsp.AreaAcad_Id = nvl ( p_AreaAcad_Id , 0 )
  and
    TurmaOfe.DiscEsp_Id = DiscEsp.Id
  and
    TOXCD.TurmaOfe_Id = TurmaOfe.Id
  and
    HoraProva.TOXCD_Id = TOXCD.Id
  and
    Curso.Id = nvl ( p_Curso_Id , 0 )
  and
    HoraProva.Facul_Id is null 
  and
    HoraProva.CriAvalPDt_Id = nvl ( p_CriAvalPDt_Id , 0 )
)
order by
  Dia,Turma,Hora,DivTurma