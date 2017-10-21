( 
  select  
    gradalu.*,  
    turmaofe_gnRetCursoNivel(gradalu.turmaofe_id)  as CursoNivel,
    CurrOfe.PLetivo_Id  as PLetivoId,
    PLetivo_gsRecognize(CurrOfe.PLetivo_Id) as Pletivo,
    gradaluti_gsrecognize(gradalu.gradaluti_id) as GradAluTi, 
    currxdisc_gsrecognize(gradalu.currxdisc_id) as CurrXDisc_gsRecognize,  
    currxdisc_gsRetCodDisc(gradalu.currxdisc_id)  as Disc,  
    turmaofe_gsRetCodTurma(gradalu.turmaofe_id) as Turma,  
    divturma_gsrecognize(gradalu.divturma_teoria_id) || ' ' ||  divturma_gsrecognize(gradalu.divturma_pratica_id) || ' ' ||  divturma_gsrecognize(gradalu.divturma_lab_id)  as Div,  
    state.nick   as Situacao,  
    Gradalu_gsRetNotasHtml(gradalu.id,gradalu.criaval_id)  as Notas,  
    currxdisc_gnChTotal(gradalu.currxdisc_id, p_PLetivo_Id  , GradAlu.Id ) as ChAnual,  
    currxdisc_gnChLimite(gradalu.currxdisc_id, p_PLetivo_Id  , GradAlu.Id ) as Limite,  
    currxdisc_gsRetDisc(gradalu.currxdisc_id)||' - '||turmaofe_gsRetCodTurma(gradalu.turmaofe_id) ||' - '|| state.nick ||' - '|| GradAlu.N1 as Recognize,  
    matric.id as m_id,  
    currxdisc_gnCursoNivel ( gradalu.currxdisc_id ) as CursoNivel_Id,  
    curso_gsrecognize( matric_gnretcurso( matric.id ) ) as Curso,  
    turmaofe_gnretturmati(gradalu.turmaofe_id) as TurmaTi_Id,  
    decode(CurrXDisc.DiscCat_Id,5900000000001,DuracXCi_gsSerieHtml(CurrXDisc.DuracXCi_Id),5900000000002,DuracXCi_gsSerieHtml(CurrXDisc.DuracXCi_Id),5900000000006,DuracXCi_gsSerieHtml(CurrXDisc.DuracXCi_Id),5900000000008,DuracXCi_gsSerieHtml(CurrXDisc.DuracXCi_Id),5900000000009,DuracXCi_gsSerieHtml(CurrXDisc.DuracXCi_Id),'9'||DuracXCi_gsSerieHtml(CurrXDisc.DuracXCi_Id)) as OrdemSerie,  
    decode(CurrXDisc.DiscCat_Id,5900000000001,'A'||CurrXDisc_gsRetDisc(CurrXDisc.Id) ,5900000000002,'A'||CurrXDisc_gsRetDisc(CurrXDisc.Id) ,'X'||CurrXDisc_gsRetDisc(CurrXDisc.Id)) as OrdemDisc,  
    CurrXDisc.DiscCat_Id,  
    WPessoa_gsRecognize(TOXCD.WPESSOA_PROFRESP_ID) as ProfResp,  
    CurrXDisc.NotaTi_Id,
    CurrXDisc.SemSubs
  from  
    CurrOfe,
    TurmaOfe,
    TOXCD,  
    CurrXDisc,  
    GradAlu,  
    Matric,  
    State 
  where  
    GradAlu.TurmaOfe_Id = TOXCD.TurmaOfe_Id (+) 
  and  
    GradAlu.CurrXDisc_Id = TOXCD.CurrXDisc_Id  (+)
  and  
    CurrXDisc.Id = GradAlu.CurrXDisc_Id 
  and  
    GradAlu.State_Id = State.Id 
  and  
    Matric.State_Id > 3000000002001 
  and  
    Matric.Id = GradAlu.Matric_Id 
  and
    CurrOfe.Id = TurmaOfe.CurrOfe_Id
  and
    GradAlu.TurmaOfe_Id = TurmaOfe.Id
  and  
    GradAlu.State_Id <> 3000000003002 
  and  
    CurrOfe.PLetivo_Id = nvl( p_PLetivo_Id ,0) 
  and  
    GradAlu.WPessoa_Id = nvl( p_WPessoa_Id , 0 ) 
  and
    ( CurrXDisc.Disc_Id = p_Disc_Id or p_Disc_Id is null )
) 
union 
( 
  select  
    gradalu.*,  
    turmaofe_gnRetCursoNivel(gradalu.turmaofe_id)  as CursoNivel,   
    DiscEsp.PLetivo_Id  as PLetivoId,  
    PLetivo_gsRecognize(DiscEsp.PLetivo_Id) as PLetivo,  
    gradaluti_gsrecognize(gradalu.gradaluti_id) as GradAluTi,  
    currxdisc_gsrecognize(gradalu.currxdisc_id) as CurrXDisc_gsRecognize,  
    currxdisc_gsRetCodDisc(gradalu.currxdisc_id)  as Disc,  
    turmaofe_gsRetCodTurma(gradalu.turmaofe_id) as Turma,  
    divturma_gsrecognize(gradalu.divturma_teoria_id) || ' ' ||  divturma_gsrecognize(gradalu.divturma_pratica_id) || ' ' ||  divturma_gsrecognize(gradalu.divturma_lab_id)  as Div,  
    state.nick   as Situacao,  
    Gradalu_gsRetNotasHtml(gradalu.id,gradalu.criaval_id)  as Notas,  
    currxdisc_gnChTotal(gradalu.currxdisc_id, p_PLetivo_Id , GradAlu.Id ) as ChAnual,  
    currxdisc_gnChLimite(gradalu.currxdisc_id, p_PLetivo_Id , GradAlu.Id ) as Limite,  
    currxdisc_gsRetDisc(gradalu.currxdisc_id)||' - '||turmaofe_gsRetCodTurma(gradalu.turmaofe_id) ||' - '|| state.nick || ' - '|| GradAlu.N1 as recognize,  
    matric.id as m_id,  
    currxdisc_gnCursoNivel ( gradalu.currxdisc_id ) as CursoNivel_Id,  
    curso_gsrecognize( matric_gnretcurso( matric.id ) ) as Curso,  
    turmaofe_gnretturmati(gradalu.turmaofe_id) as TurmaTi_Id,  
    decode(CurrXDisc.DiscCat_Id,5900000000001,DuracXCi_gsSerieHtml(CurrXDisc.DuracXCi_Id),5900000000002,DuracXCi_gsSerieHtml(CurrXDisc.DuracXCi_Id),5900000000006,DuracXCi_gsSerieHtml(CurrXDisc.DuracXCi_Id),5900000000008,DuracXCi_gsSerieHtml(CurrXDisc.DuracXCi_Id),5900000000009,DuracXCi_gsSerieHtml(CurrXDisc.DuracXCi_Id),'9'||DuracXCi_gsSerieHtml(CurrXDisc.DuracXCi_Id)) as OrdemSerie,
    decode(CurrXDisc.DiscCat_Id,5900000000001,'A'||CurrXDisc_gsRetDisc(CurrXDisc.Id) ,5900000000002,'A'||CurrXDisc_gsRetDisc(CurrXDisc.Id) ,'X'||CurrXDisc_gsRetDisc(CurrXDisc.Id)) as OrdemDisc,  
    CurrXDisc.DiscCat_Id,  
    WPessoa_gsRecognize(TOXCD.WPESSOA_PROFRESP_ID) as ProfResp,  
    CurrXDisc.NotaTi_Id,
    CurrXDisc.SemSubs
  from  
    DiscEsp,
    TurmaOfe,
    CurrXDisc,  
    GradAlu,  
    Matric,  
    State,  
    TOXCD 
  where  
    ( 
       GradAlu.CurrXDisc_Id = TOXCD.CurrXDisc_Id  
       or  
       toxcd.currxdisc_id is null  
    ) 
  and  
    GradAlu.TurmaOfe_Id = TOXCD.TurmaOfe_Id 
  and  
    CurrXDisc.Id = GradAlu.CurrXDisc_Id 
  and  
    GradAlu.State_Id = State.Id 
  and  
    Matric.State_Id > 3000000002001 
  and  
    Matric.Id = GradAlu.Matric_Id 
  and
    TurmaOfe.DiscEsp_Id = DiscEsp.Id
  and
    GradAlu.TurmaOfe_Id = TurmaOfe.Id 
  and  
    GradAlu.State_Id <> 3000000003002 
  and  
    DiscEsp.PLetivo_Id = nvl( p_PLetivo_Id ,0) 
  and  
    GradAlu.WPessoa_Id = nvl( p_WPessoa_Id , 0 ) 
  and
    ( CurrXDisc.Disc_Id = p_Disc_Id or p_Disc_Id is null )
) order by cursonivel, m_id, turma, ordemserie, ordemdisc