(
  ( /* QUERY 1 HABILITACAO IS NULL MONTAGEM DO CURRICULO PAI FILHO*/
    SELECT 
      CURR.CODIGO||PLETIVO.SEMANAS                                               AS COD_GRD_CURRICULAR_EXT,
      CURR.CODIGO||PLETIVO.SEMANAS                                               AS SGL_GRD_CURRICULAR,
      CURR_GNRETDURACAO(CURR.ID)                                                 AS NUM_TOTAL_PERIODO,
      NVL(DURACXCI.SEQUENCIA,1)                                                  AS NUM_PERIODO,
      NULL                                                                       AS OBS_GRD_CURRICULAR,
      NULL                                                                       AS DAT_CADASTRAMENTO, 	
      TO_CHAR(CURSO.ID)                                                          AS COD_CURSO_EXT,
      CURSO.ID||' '||DECODE(CURSO.ID,5700000003226,'Sequencial',5700000005279,'Sequencial',MODALIDADE.NOME) AS COD_HABILITACAO_EXT, 
      'C'                                                                        AS IND_TPO_HABILITACAO,
      DECODE(CURRXDISC.OBRIG,'on','OBRIGATORIA','OPCIONAL')                      AS COD_TPO_DISC_GRADE_EXT,
      DECODE(CURRXDISC.OBRIG,'on','OBRIGATORIA','OPCIONAL')                      AS DSC_TPO_DISC_GRADE,
      DECODE(CURRXDISC.OBRIG,'on','OBRIGATORIA','OPCIONAL')                      AS SGL_TPO_DISC_GRADE,
      DECODE(NVL(CURRXDISC.CHTOTAL,0),0,TO_CHAR(CURSO.ID)||TO_CHAR(DISC.ID)||((PLETIVO.SEMANAS*nvl(CHSEMANALTEORIA,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALPRATICA,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALLAB,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALEXERC,0))),TO_CHAR(CURSO.ID)||TO_CHAR(DISC.ID)||CURRXDISC.CHTOTAl ) AS COD_DISCIPLINA_EXT,
      0                                                                          AS NUM_CREDITO_FINANC,
      DECODE(NVL(CURRXDISC.CHTOTAL,0),0,((PLETIVO.SEMANAS*nvl(CHSEMANALTEORIA,0))+(PLETIVO.SEMANAS*nvl(CHSEMANALPRATICA,0))+(PLETIVO.SEMANAS*nvl(CHSEMANALLAB,0))+(PLETIVO.SEMANAS*nvl(CHSEMANALEXERC,0))),CURRXDISC.CHTOTAL)  AS VAL_CARGA_HORARIA,
      'N'                                                                        AS IND_HORA_RELOGIO
    FROM 
      MODALIDADE,
      RECCURSO,
      DURACXCI,
      CURRXDISC,
      CURR,
      CURSO,
      DISC,
      ( 
      SELECT
        PLETIVO.SEMANAS
      FROM
        PLETIVO
      WHERE
        PLETIVO.CICLO_ID=5400000000001
      AND
        PLETIVO.ID >= 7200000000022 
      GROUP BY PLETIVO.SEMANAS
      ) PLETIVO
    WHERE 
      CURR_PAI_ID NOT IN (5800000000256,5800000000249,5800000000250,5800000000271)
    AND
      RECCURSO.HABILITACAO IS NULL
    AND
      RECCURSO.MODALIDADE_ID=MODALIDADE.ID(+)
    AND
      CURRXDISC.DURACXCI_ID=DURACXCI.ID(+)
    AND
      RECCURSO.CAMPUS_ID=6400000000001
    AND
      RECCURSO.VIGENTE='on'
    AND
      RECCURSO.CURSO_ID=CURSO.ID
    AND
      CURR.CURSO_MIG_ID=CURSO.ID
    AND
      CURRXDISC.CURR_ID=CURR.CURR_PAI_ID
    AND
      CURRXDISC.DISC_ID=DISC.ID
    AND  
      CURR.CURR_PAI_ID IS NOT NULL
    UNION
    SELECT 
      CURR.CODIGO||PLETIVO.SEMANAS                                               AS COD_GRD_CURRICULAR_EXT,
      CURR.CODIGO||PLETIVO.SEMANAS                                               AS SGL_GRD_CURRICULAR,
      CURR_GNRETDURACAO(CURR.ID)                                                 AS NUM_TOTAL_PERIODO,
      NVL(DURACXCI.SEQUENCIA,1)                                                  AS NUM_PERIODO,
      NULL                                                                       AS OBS_GRD_CURRICULAR,
      NULL                                                                       AS DAT_CADASTRAMENTO, 	
      TO_CHAR(CURSO.ID)                                                          AS COD_CURSO_EXT,
      CURSO.ID||' '||DECODE(CURSO.ID,5700000003226,'Sequencial',5700000005279,'Sequencial',MODALIDADE.NOME) AS COD_HABILITACAO_EXT, 
      'C'                                                                        AS IND_TPO_HABILITACAO,
      DECODE(CURRXDISC.OBRIG,'on','OBRIGATORIA','OPCIONAL')                      AS COD_TPO_DISC_GRADE_EXT,
      DECODE(CURRXDISC.OBRIG,'on','OBRIGATORIA','OPCIONAL')                      AS DSC_TPO_DISC_GRADE,
      DECODE(CURRXDISC.OBRIG,'on','OBRIGATORIA','OPCIONAL')                      AS SGL_TPO_DISC_GRADE,
      DECODE(NVL(CURRXDISC.CHTOTAL,0),0,TO_CHAR(CURSO.ID)||TO_CHAR(DISC.ID)||((PLETIVO.SEMANAS*nvl(CHSEMANALTEORIA,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALPRATICA,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALLAB,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALEXERC,0))),TO_CHAR(CURSO.ID)||TO_CHAR(DISC.ID)||CURRXDISC.CHTOTAl ) AS COD_DISCIPLINA_EXT,
      0                                                                          AS NUM_CREDITO_FINANC,
      DECODE(NVL(CURRXDISC.CHTOTAL,0),0,((PLETIVO.SEMANAS*nvl(CHSEMANALTEORIA,0))+(PLETIVO.SEMANAS*nvl(CHSEMANALPRATICA,0))+(PLETIVO.SEMANAS*nvl(CHSEMANALLAB,0))+(PLETIVO.SEMANAS*nvl(CHSEMANALEXERC,0))),CURRXDISC.CHTOTAL)  AS VAL_CARGA_HORARIA,
      'N'                                                                        AS IND_HORA_RELOGIO
    FROM 
      MODALIDADE,
      RECCURSO,
      DURACXCI,
      CURRXDISC,
      CURR,
      CURSO,
      DISC,
      ( 
      SELECT
        PLETIVO.SEMANAS
      FROM
        PLETIVO
      WHERE
        PLETIVO.CICLO_ID=5400000000001
      AND
        PLETIVO.ID >= 7200000000022 
      GROUP BY PLETIVO.SEMANAS
      ) PLETIVO
    WHERE 
      CURR_PAI_ID NOT IN (5800000000256,5800000000249,5800000000250,5800000000271)
    AND
      RECCURSO.HABILITACAO IS NULL
    AND
      RECCURSO.MODALIDADE_ID=MODALIDADE.ID(+)
    AND
      CURRXDISC.DURACXCI_ID=DURACXCI.ID(+)
    AND
      RECCURSO.CAMPUS_ID=6400000000001
    AND
      RECCURSO.VIGENTE='on'
    AND
      RECCURSO.CURSO_ID=CURSO.ID
    AND
      CURR.CURSO_MIG_ID=CURSO.ID
    AND
      CURRXDISC.CURR_ID=CURR.ID
    AND
      CURRXDISC.DISC_ID=DISC.ID
    AND  
      CURR.CURR_PAI_ID IS NOT NULL
  )
  UNION
  ( /* QUERY 2 HABILITACAO IS NOT NULL MONTAGEM DO CURRICULO PAI FILHO*/
    SELECT 
      CURR.CODIGO||PLETIVO.SEMANAS                                               AS COD_GRD_CURRICULAR_EXT,
      CURR.CODIGO||PLETIVO.SEMANAS                                               AS SGL_GRD_CURRICULAR,
      CURR_GNRETDURACAO(CURR.ID)                                                 AS NUM_TOTAL_PERIODO,
      NVL(DURACXCI.SEQUENCIA,1)                                                  AS NUM_PERIODO,
      NULL                                                                       AS OBS_GRD_CURRICULAR,
      NULL                                                                       AS DAT_CADASTRAMENTO, 	
      TO_CHAR(CURSO.ID)                                                          AS COD_CURSO_EXT,
      CURSO.ID||' '||RECCURSO.HABILITACAO                                        AS COD_HABILITACAO_EXT,
      'C'                                                                        AS IND_TPO_HABILITACAO,
      DECODE(CURRXDISC.OBRIG,'on','OBRIGATORIA','OPCIONAL')                      AS COD_TPO_DISC_GRADE_EXT,
      DECODE(CURRXDISC.OBRIG,'on','OBRIGATORIA','OPCIONAL')                      AS DSC_TPO_DISC_GRADE,
      DECODE(CURRXDISC.OBRIG,'on','OBRIGATORIA','OPCIONAL')                      AS SGL_TPO_DISC_GRADE,
      DECODE(NVL(CURRXDISC.CHTOTAL,0),0,TO_CHAR(CURSO.ID)||TO_CHAR(DISC.ID)||((PLETIVO.SEMANAS*nvl(CHSEMANALTEORIA,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALPRATICA,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALLAB,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALEXERC,0))),TO_CHAR(CURSO.ID)||TO_CHAR(DISC.ID)||CURRXDISC.CHTOTAl ) AS COD_DISCIPLINA_EXT,
      0                                                                          AS NUM_CREDITO_FINANC,
      DECODE(NVL(CURRXDISC.CHTOTAL,0),0,((PLETIVO.SEMANAS*nvl(CHSEMANALTEORIA,0))+(PLETIVO.SEMANAS*nvl(CHSEMANALPRATICA,0))+(PLETIVO.SEMANAS*nvl(CHSEMANALLAB,0))+(PLETIVO.SEMANAS*nvl(CHSEMANALEXERC,0))),CURRXDISC.CHTOTAL)  AS VAL_CARGA_HORARIA,
      'N'                                                                        AS IND_HORA_RELOGIO
    FROM 
      MODALIDADE,
      RECCURSO,
      DURACXCI,
      CURRXDISC,
      CURR,
      CURSO,
      DISC,
      ( 
      SELECT
        PLETIVO.SEMANAS
      FROM
        PLETIVO
      WHERE
        PLETIVO.CICLO_ID=5400000000001
      AND
        PLETIVO.ID >= 7200000000022 
      GROUP BY PLETIVO.SEMANAS
      ) PLETIVO
    WHERE 
      CURR_PAI_ID NOT IN (5800000000256,5800000000249)
    AND
      RECCURSO.HABILITACAO IS NOT NULL
    AND
      RECCURSO.MODALIDADE_ID=MODALIDADE.ID(+)
    AND
      CURRXDISC.DURACXCI_ID=DURACXCI.ID(+)
    AND
      RECCURSO.CAMPUS_ID=6400000000001
    AND
      RECCURSO.VIGENTE='on'
    AND
      RECCURSO.CURSO_ID=CURSO.ID
    AND
      CURR.CURSO_MIG_ID=CURSO.ID
    AND
      CURRXDISC.CURR_ID=CURR.CURR_PAI_ID
    AND
      CURRXDISC.DISC_ID=DISC.ID
    AND  
      CURR.CURR_PAI_ID IS NOT NULL
    UNION
    SELECT 
      CURR.CODIGO||PLETIVO.SEMANAS                                               AS COD_GRD_CURRICULAR_EXT,
      CURR.CODIGO||PLETIVO.SEMANAS                                               AS SGL_GRD_CURRICULAR,
      CURR_GNRETDURACAO(CURR.ID)                                                 AS NUM_TOTAL_PERIODO,
      NVL(DURACXCI.SEQUENCIA,1)                                                  AS NUM_PERIODO,
      NULL                                                                       AS OBS_GRD_CURRICULAR,
      NULL                                                                       AS DAT_CADASTRAMENTO, 	
      TO_CHAR(CURSO.ID)                                                          AS COD_CURSO_EXT,
      CURSO.ID||' '||RECCURSO.HABILITACAO                                        AS COD_HABILITACAO_EXT,
      'C'                                                                        AS IND_TPO_HABILITACAO,
      DECODE(CURRXDISC.OBRIG,'on','OBRIGATORIA','OPCIONAL')                      AS COD_TPO_DISC_GRADE_EXT,
      DECODE(CURRXDISC.OBRIG,'on','OBRIGATORIA','OPCIONAL')                      AS DSC_TPO_DISC_GRADE,
      DECODE(CURRXDISC.OBRIG,'on','OBRIGATORIA','OPCIONAL')                      AS SGL_TPO_DISC_GRADE,
      DECODE(NVL(CURRXDISC.CHTOTAL,0),0,TO_CHAR(CURSO.ID)||TO_CHAR(DISC.ID)||((PLETIVO.SEMANAS*nvl(CHSEMANALTEORIA,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALPRATICA,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALLAB,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALEXERC,0))),TO_CHAR(CURSO.ID)||TO_CHAR(DISC.ID)||CURRXDISC.CHTOTAl ) AS COD_DISCIPLINA_EXT,
      0                                                                          AS NUM_CREDITO_FINANC,
      DECODE(NVL(CURRXDISC.CHTOTAL,0),0,((PLETIVO.SEMANAS*nvl(CHSEMANALTEORIA,0))+(PLETIVO.SEMANAS*nvl(CHSEMANALPRATICA,0))+(PLETIVO.SEMANAS*nvl(CHSEMANALLAB,0))+(PLETIVO.SEMANAS*nvl(CHSEMANALEXERC,0))),CURRXDISC.CHTOTAL)  AS VAL_CARGA_HORARIA,
      'N'                                                                        AS IND_HORA_RELOGIO
    FROM 
      MODALIDADE,
      RECCURSO,
      DURACXCI,
      CURRXDISC,
      CURR,
      CURSO,
      DISC,
      ( 
      SELECT
        PLETIVO.SEMANAS
      FROM
        PLETIVO
      WHERE
        PLETIVO.CICLO_ID=5400000000001
      AND
        PLETIVO.ID >= 7200000000022 
      GROUP BY PLETIVO.SEMANAS
      ) PLETIVO
    WHERE 
      CURR_PAI_ID NOT IN (5800000000256,5800000000249)
    AND
      RECCURSO.HABILITACAO IS NOT NULL
    AND
      RECCURSO.MODALIDADE_ID=MODALIDADE.ID(+)
    AND
      CURRXDISC.DURACXCI_ID=DURACXCI.ID(+)
    AND
      RECCURSO.CAMPUS_ID=6400000000001
    AND
      RECCURSO.VIGENTE='on'
    AND
      RECCURSO.CURSO_ID=CURSO.ID
    AND
      CURR.CURSO_MIG_ID=CURSO.ID
    AND
      CURRXDISC.CURR_ID=CURR.ID
    AND
      CURRXDISC.DISC_ID=DISC.ID
    AND  
      CURR.CURR_PAI_ID IS NOT NULL
  )  
  UNION
  ( /* QUERY 3 HABILITACAO NULL CURRICULO SEM HIERARQUIA*/
    SELECT 
      CURR.CODIGO||PLETIVO.SEMANAS                                               AS COD_GRD_CURRICULAR_EXT,
      CURR.CODIGO||PLETIVO.SEMANAS                                               AS SGL_GRD_CURRICULAR,
      CURR_GNRETDURACAO(CURR.ID,'on')                                            AS NUM_TOTAL_PERIODO,
      NVL(DURACXCI.SEQUENCIA,1)                                                  AS NUM_PERIODO,
      NULL                                                                       AS OBS_GRD_CURRICULAR,
      NULL                                                                       AS DAT_CADASTRAMENTO, 	
      TO_CHAR(CURSO.ID)                                                          AS COD_CURSO_EXT,
      CURSO.ID||' '||DECODE(CURSO.ID,5700000003226,'Sequencial',5700000005279,'Sequencial',MODALIDADE.NOME) AS COD_HABILITACAO_EXT, 
      'C'                                                                        AS IND_TPO_HABILITACAO,
      DECODE(CURRXDISC.OBRIG,'on','OBRIGATORIA','OPCIONAL')                      AS COD_TPO_DISC_GRADE_EXT,
      DECODE(CURRXDISC.OBRIG,'on','OBRIGATORIA','OPCIONAL')                      AS DSC_TPO_DISC_GRADE,
      DECODE(CURRXDISC.OBRIG,'on','OBRIGATORIA','OPCIONAL')                      AS SGL_TPO_DISC_GRADE,
      DECODE(NVL(CURRXDISC.CHTOTAL,0),0,TO_CHAR(CURSO.ID)||TO_CHAR(DISC.ID)||((PLETIVO.SEMANAS*nvl(CHSEMANALTEORIA,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALPRATICA,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALLAB,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALEXERC,0))),TO_CHAR(CURSO.ID)||TO_CHAR(DISC.ID)||CURRXDISC.CHTOTAl ) AS COD_DISCIPLINA_EXT,
      0                                                                          AS NUM_CREDITO_FINANC,
      DECODE(NVL(CURRXDISC.CHTOTAL,0),0,((PLETIVO.SEMANAS*nvl(CHSEMANALTEORIA,0))+(PLETIVO.SEMANAS*nvl(CHSEMANALPRATICA,0))+(PLETIVO.SEMANAS*nvl(CHSEMANALLAB,0))+(PLETIVO.SEMANAS*nvl(CHSEMANALEXERC,0))),CURRXDISC.CHTOTAL)  AS VAL_CARGA_HORARIA,
      'N'                                                                        AS IND_HORA_RELOGIO
    FROM 
      MODALIDADE,
      RECCURSO,
      DURACXCI,
      CURRXDISC,
      CURR,
      CURSO,
      DISC,
      ( 
      SELECT
        PLETIVO.SEMANAS
      FROM
        PLETIVO
      WHERE
        PLETIVO.CICLO_ID=5400000000001
      AND
        PLETIVO.ID >= 7200000000022 
      GROUP BY PLETIVO.SEMANAS
      ) PLETIVO
    WHERE 
      RECCURSO.HABILITACAO IS NULL
    AND
      RECCURSO.MODALIDADE_ID=MODALIDADE.ID(+)
    AND
      CURRXDISC.DURACXCI_ID=DURACXCI.ID(+)
    AND
      RECCURSO.CAMPUS_ID=6400000000001
    AND
      RECCURSO.VIGENTE='on'
    AND
      RECCURSO.CURSO_ID=CURSO.ID
    AND
      CURR.CURSO_MIG_ID=CURSO.ID
    AND
      CURRXDISC.CURR_ID=CURR.CURR_PAI_ID
    AND
      CURRXDISC.DISC_ID=DISC.ID
    AND  
      CURR.CURR_PAI_ID IS NULL
    UNION
    SELECT 
      CURR.CODIGO||PLETIVO.SEMANAS                                               AS COD_GRD_CURRICULAR_EXT,
      CURR.CODIGO||PLETIVO.SEMANAS                                               AS SGL_GRD_CURRICULAR,
      CURR_GNRETDURACAO(CURR.ID,'on')                                            AS NUM_TOTAL_PERIODO,
      NVL(DURACXCI.SEQUENCIA,1)                                                  AS NUM_PERIODO,
      NULL                                                                       AS OBS_GRD_CURRICULAR,
      NULL                                                                       AS DAT_CADASTRAMENTO, 	
      TO_CHAR(CURSO.ID)                                                          AS COD_CURSO_EXT,
      CURSO.ID||' '||DECODE(CURSO.ID,5700000003226,'Sequencial',5700000005279,'Sequencial',MODALIDADE.NOME) AS COD_HABILITACAO_EXT, 
      'C'                                                                        AS IND_TPO_HABILITACAO,
      DECODE(CURRXDISC.OBRIG,'on','OBRIGATORIA','OPCIONAL')                      AS COD_TPO_DISC_GRADE_EXT,
      DECODE(CURRXDISC.OBRIG,'on','OBRIGATORIA','OPCIONAL')                      AS DSC_TPO_DISC_GRADE,
      DECODE(CURRXDISC.OBRIG,'on','OBRIGATORIA','OPCIONAL')                      AS SGL_TPO_DISC_GRADE,
      DECODE(NVL(CURRXDISC.CHTOTAL,0),0,TO_CHAR(CURSO.ID)||TO_CHAR(DISC.ID)||((PLETIVO.SEMANAS*nvl(CHSEMANALTEORIA,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALPRATICA,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALLAB,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALEXERC,0))),TO_CHAR(CURSO.ID)||TO_CHAR(DISC.ID)||CURRXDISC.CHTOTAl ) AS COD_DISCIPLINA_EXT,
      0                                                                          AS NUM_CREDITO_FINANC,
      DECODE(NVL(CURRXDISC.CHTOTAL,0),0,((PLETIVO.SEMANAS*nvl(CHSEMANALTEORIA,0))+(PLETIVO.SEMANAS*nvl(CHSEMANALPRATICA,0))+(PLETIVO.SEMANAS*nvl(CHSEMANALLAB,0))+(PLETIVO.SEMANAS*nvl(CHSEMANALEXERC,0))),CURRXDISC.CHTOTAL)  AS VAL_CARGA_HORARIA,
      'N'                                                                        AS IND_HORA_RELOGIO
    FROM 
      MODALIDADE,
      RECCURSO,
      DURACXCI,
      CURRXDISC,
      CURR,
      CURSO,
      DISC,
      ( 
      SELECT
        PLETIVO.SEMANAS
      FROM
        PLETIVO
      WHERE
        PLETIVO.CICLO_ID=5400000000001
      AND
        PLETIVO.ID >= 7200000000022 
      GROUP BY PLETIVO.SEMANAS
      ) PLETIVO
    WHERE 
      RECCURSO.HABILITACAO IS NULL
    AND
      RECCURSO.MODALIDADE_ID=MODALIDADE.ID(+)
    AND
      CURRXDISC.DURACXCI_ID=DURACXCI.ID(+)
    AND
      RECCURSO.CAMPUS_ID=6400000000001
    AND
      RECCURSO.VIGENTE='on'
    AND
      RECCURSO.CURSO_ID=CURSO.ID
    AND
      CURR.CURSO_MIG_ID=CURSO.ID
    AND
      CURRXDISC.CURR_ID=CURR.ID
    AND
      CURRXDISC.DISC_ID=DISC.ID
    AND  
      CURR.CURR_PAI_ID IS NULL
  )
  UNION
  ( /* QUERY 4 HABILITACAO IS NOT NULL CURRICULO SEM HIERARQUIA*/
    SELECT 
      CURR.CODIGO||PLETIVO.SEMANAS                                               AS COD_GRD_CURRICULAR_EXT,
      CURR.CODIGO||PLETIVO.SEMANAS                                               AS SGL_GRD_CURRICULAR,
      CURR_GNRETDURACAO(CURR.ID,'on')                                            AS NUM_TOTAL_PERIODO,
      NVL(DURACXCI.SEQUENCIA,1)                                                  AS NUM_PERIODO,
      NULL                                                                       AS OBS_GRD_CURRICULAR,
      NULL                                                                       AS DAT_CADASTRAMENTO, 	
      TO_CHAR(CURSO.ID)                                                          AS COD_CURSO_EXT,
      CURSO.ID||' '||RECCURSO.HABILITACAO                                        AS COD_HABILITACAO_EXT,
      'C'                                                                        AS IND_TPO_HABILITACAO,
      DECODE(CURRXDISC.OBRIG,'on','OBRIGATORIA','OPCIONAL')                      AS COD_TPO_DISC_GRADE_EXT,
      DECODE(CURRXDISC.OBRIG,'on','OBRIGATORIA','OPCIONAL')                      AS DSC_TPO_DISC_GRADE,
      DECODE(CURRXDISC.OBRIG,'on','OBRIGATORIA','OPCIONAL')                      AS SGL_TPO_DISC_GRADE,
      DECODE(NVL(CURRXDISC.CHTOTAL,0),0,TO_CHAR(CURSO.ID)||TO_CHAR(DISC.ID)||((PLETIVO.SEMANAS*nvl(CHSEMANALTEORIA,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALPRATICA,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALLAB,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALEXERC,0))),TO_CHAR(CURSO.ID)||TO_CHAR(DISC.ID)||CURRXDISC.CHTOTAl ) AS COD_DISCIPLINA_EXT,
      0                                                                          AS NUM_CREDITO_FINANC,
      DECODE(NVL(CURRXDISC.CHTOTAL,0),0,((PLETIVO.SEMANAS*nvl(CHSEMANALTEORIA,0))+(PLETIVO.SEMANAS*nvl(CHSEMANALPRATICA,0))+(PLETIVO.SEMANAS*nvl(CHSEMANALLAB,0))+(PLETIVO.SEMANAS*nvl(CHSEMANALEXERC,0))),CURRXDISC.CHTOTAL)  AS VAL_CARGA_HORARIA,
      'N'                                                                        AS IND_HORA_RELOGIO
    FROM 
      MODALIDADE,
      RECCURSO,
      DURACXCI,
      CURRXDISC,
      CURR,
      CURSO,
      DISC,
      ( 
      SELECT
        PLETIVO.SEMANAS
      FROM
        PLETIVO
      WHERE
        PLETIVO.CICLO_ID=5400000000001
      AND
        PLETIVO.ID >= 7200000000022 
      GROUP BY PLETIVO.SEMANAS
      ) PLETIVO
    WHERE 
      RECCURSO.HABILITACAO IS NOT NULL
    AND
      RECCURSO.MODALIDADE_ID=MODALIDADE.ID(+)
    AND
      CURRXDISC.DURACXCI_ID=DURACXCI.ID(+)
    AND
      RECCURSO.CAMPUS_ID=6400000000001
    AND
      RECCURSO.VIGENTE='on'
    AND
      RECCURSO.CURSO_ID=CURSO.ID
    AND
      CURR.CURSO_MIG_ID=CURSO.ID
    AND
      CURRXDISC.CURR_ID=CURR.CURR_PAI_ID
    AND
      CURRXDISC.DISC_ID=DISC.ID
    AND  
      CURR.CURR_PAI_ID IS NULL
    UNION
    SELECT 
      CURR.CODIGO||PLETIVO.SEMANAS                                               AS COD_GRD_CURRICULAR_EXT,
      CURR.CODIGO||PLETIVO.SEMANAS                                               AS SGL_GRD_CURRICULAR,
      CURR_GNRETDURACAO(CURR.ID,'on')                                            AS NUM_TOTAL_PERIODO,
      NVL(DURACXCI.SEQUENCIA,1)                                                  AS NUM_PERIODO,
      NULL                                                                       AS OBS_GRD_CURRICULAR,
      NULL                                                                       AS DAT_CADASTRAMENTO, 	
      TO_CHAR(CURSO.ID)                                                          AS COD_CURSO_EXT,
      CURSO.ID||' '||RECCURSO.HABILITACAO                                        AS COD_HABILITACAO_EXT,
      'C'                                                                        AS IND_TPO_HABILITACAO,
      DECODE(CURRXDISC.OBRIG,'on','OBRIGATORIA','OPCIONAL')                      AS COD_TPO_DISC_GRADE_EXT,
      DECODE(CURRXDISC.OBRIG,'on','OBRIGATORIA','OPCIONAL')                      AS DSC_TPO_DISC_GRADE,
      DECODE(CURRXDISC.OBRIG,'on','OBRIGATORIA','OPCIONAL')                      AS SGL_TPO_DISC_GRADE,
      DECODE(NVL(CURRXDISC.CHTOTAL,0),0,TO_CHAR(CURSO.ID)||TO_CHAR(DISC.ID)||((PLETIVO.SEMANAS*nvl(CHSEMANALTEORIA,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALPRATICA,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALLAB,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALEXERC,0))),TO_CHAR(CURSO.ID)||TO_CHAR(DISC.ID)||CURRXDISC.CHTOTAl ) AS COD_DISCIPLINA_EXT,
      0                                                                          AS NUM_CREDITO_FINANC,
      DECODE(NVL(CURRXDISC.CHTOTAL,0),0,((PLETIVO.SEMANAS*nvl(CHSEMANALTEORIA,0))+(PLETIVO.SEMANAS*nvl(CHSEMANALPRATICA,0))+(PLETIVO.SEMANAS*nvl(CHSEMANALLAB,0))+(PLETIVO.SEMANAS*nvl(CHSEMANALEXERC,0))),CURRXDISC.CHTOTAL)  AS VAL_CARGA_HORARIA,
      'N'                                                                        AS IND_HORA_RELOGIO
    FROM 
      MODALIDADE,
      RECCURSO,
      DURACXCI,
      CURRXDISC,
      CURR,
      CURSO,
      DISC,
      ( 
      SELECT
        PLETIVO.SEMANAS
      FROM
        PLETIVO
      WHERE
        PLETIVO.CICLO_ID=5400000000001
      AND
        PLETIVO.ID >= 7200000000022 
      GROUP BY PLETIVO.SEMANAS
      ) PLETIVO
    WHERE 
      RECCURSO.HABILITACAO IS NOT NULL
    AND
      RECCURSO.MODALIDADE_ID=MODALIDADE.ID(+)
    AND
      CURRXDISC.DURACXCI_ID=DURACXCI.ID(+)
    AND
      RECCURSO.CAMPUS_ID=6400000000001
    AND
      RECCURSO.VIGENTE='on'
    AND
      RECCURSO.CURSO_ID=CURSO.ID
    AND
      CURR.CURSO_MIG_ID=CURSO.ID
    AND
      CURRXDISC.CURR_ID=CURR.ID
    AND
      CURRXDISC.DISC_ID=DISC.ID
    AND  
      CURR.CURR_PAI_ID IS NULL
  )  
  UNION
  (
    SELECT /* QUERY 5 HIERARQUIA PAI FILHO NETO */
      '25111994'||PLETIVO.SEMANAS                                                AS COD_GRD_CURRICULAR_EXT,
      '25111994'||PLETIVO.SEMANAS                                                AS SGL_GRD_CURRICULAR,
      CURR_GNRETDURACAO(CURR.ID)                                                 AS NUM_TOTAL_PERIODO,
      NVL(DURACXCI.SEQUENCIA,1)                                                  AS NUM_PERIODO,
      NULL                                                                       AS OBS_GRD_CURRICULAR,
      NULL                                                                       AS DAT_CADASTRAMENTO, 	
      TO_CHAR(CURSO.ID)                                                          AS COD_CURSO_EXT,
      CURSO.ID||' '||DECODE(CURSO.ID,5700000003226,'Sequencial',5700000005279,'Sequencial',MODALIDADE.NOME) AS COD_HABILITACAO_EXT, 
      'C'                                                                        AS IND_TPO_HABILITACAO,
      DECODE(CURRXDISC.OBRIG,'on','OBRIGATORIA','OPCIONAL')                      AS COD_TPO_DISC_GRADE_EXT,
      DECODE(CURRXDISC.OBRIG,'on','OBRIGATORIA','OPCIONAL')                      AS DSC_TPO_DISC_GRADE,
      DECODE(CURRXDISC.OBRIG,'on','OBRIGATORIA','OPCIONAL')                      AS SGL_TPO_DISC_GRADE,
      DECODE(NVL(CURRXDISC.CHTOTAL,0),0,TO_CHAR(CURSO.ID)||TO_CHAR(DISC.ID)||((PLETIVO.SEMANAS*nvl(CHSEMANALTEORIA,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALPRATICA,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALLAB,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALEXERC,0))),TO_CHAR(CURSO.ID)||TO_CHAR(DISC.ID)||CURRXDISC.CHTOTAl ) AS COD_DISCIPLINA_EXT,
      0                                                                          AS NUM_CREDITO_FINANC,
      DECODE(NVL(CURRXDISC.CHTOTAL,0),0,((PLETIVO.SEMANAS*nvl(CHSEMANALTEORIA,0))+(PLETIVO.SEMANAS*nvl(CHSEMANALPRATICA,0))+(PLETIVO.SEMANAS*nvl(CHSEMANALLAB,0))+(PLETIVO.SEMANAS*nvl(CHSEMANALEXERC,0))),CURRXDISC.CHTOTAL)  AS VAL_CARGA_HORARIA,
      'N'                                                                        AS IND_HORA_RELOGIO
    FROM 
      MODALIDADE,
      RECCURSO,
      DURACXCI,
      CURRXDISC,
      CURR,
      CURSO,
      DISC,
      ( 
      SELECT
        PLETIVO.SEMANAS
      FROM
        PLETIVO
      WHERE
        PLETIVO.CICLO_ID=5400000000001
      AND
        PLETIVO.ID >= 7200000000022 
      GROUP BY PLETIVO.SEMANAS
      ) PLETIVO
    WHERE 
      RECCURSO.HABILITACAO IS NULL
    AND
      RECCURSO.MODALIDADE_ID=MODALIDADE.ID(+)
    AND
      CURRXDISC.DURACXCI_ID=DURACXCI.ID(+)
    AND
      RECCURSO.CAMPUS_ID=6400000000001
    AND
      RECCURSO.VIGENTE='on'
    AND
      RECCURSO.CURSO_ID=CURSO.ID
    AND
      CURR.CURSO_MIG_ID=CURSO.ID
    AND
      CURRXDISC.CURR_ID=CURR.ID
    AND
      CURRXDISC.DISC_ID=DISC.ID
    AND  
      CURR.ID IN (5800000000257,5800000000256,5800000000229)
    UNION
    SELECT 
      '25131994'||PLETIVO.SEMANAS                                                AS COD_GRD_CURRICULAR_EXT,
      '25131994'||PLETIVO.SEMANAS                                                AS SGL_GRD_CURRICULAR,
      CURR_GNRETDURACAO(CURR.ID)                                                 AS NUM_TOTAL_PERIODO,
      NVL(DURACXCI.SEQUENCIA,1)                                                  AS NUM_PERIODO,
      NULL                                                                       AS OBS_GRD_CURRICULAR,
      NULL                                                                       AS DAT_CADASTRAMENTO, 	
      TO_CHAR(CURSO.ID)                                                          AS COD_CURSO_EXT,
      CURSO.ID||' '||DECODE(CURSO.ID,5700000003226,'Sequencial',5700000005279,'Sequencial',MODALIDADE.NOME) AS COD_HABILITACAO_EXT, 
      'C'                                                                        AS IND_TPO_HABILITACAO,
      DECODE(CURRXDISC.OBRIG,'on','OBRIGATORIA','OPCIONAL')                      AS COD_TPO_DISC_GRADE_EXT,
      DECODE(CURRXDISC.OBRIG,'on','OBRIGATORIA','OPCIONAL')                      AS DSC_TPO_DISC_GRADE,
      DECODE(CURRXDISC.OBRIG,'on','OBRIGATORIA','OPCIONAL')                      AS SGL_TPO_DISC_GRADE,
      DECODE(NVL(CURRXDISC.CHTOTAL,0),0,TO_CHAR(CURSO.ID)||TO_CHAR(DISC.ID)||((PLETIVO.SEMANAS*nvl(CHSEMANALTEORIA,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALPRATICA,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALLAB,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALEXERC,0))),TO_CHAR(CURSO.ID)||TO_CHAR(DISC.ID)||CURRXDISC.CHTOTAl ) AS COD_DISCIPLINA_EXT,
      0                                                                          AS NUM_CREDITO_FINANC,
      DECODE(NVL(CURRXDISC.CHTOTAL,0),0,((PLETIVO.SEMANAS*nvl(CHSEMANALTEORIA,0))+(PLETIVO.SEMANAS*nvl(CHSEMANALPRATICA,0))+(PLETIVO.SEMANAS*nvl(CHSEMANALLAB,0))+(PLETIVO.SEMANAS*nvl(CHSEMANALEXERC,0))),CURRXDISC.CHTOTAL)  AS VAL_CARGA_HORARIA,
      'N'                                                                        AS IND_HORA_RELOGIO
    FROM 
      MODALIDADE,
      RECCURSO,
      DURACXCI,
      CURRXDISC,
      CURR,
      CURSO,
      DISC,
      ( 
      SELECT
        PLETIVO.SEMANAS
      FROM
        PLETIVO
      WHERE
        PLETIVO.CICLO_ID=5400000000001
      AND
        PLETIVO.ID >= 7200000000022 
      GROUP BY PLETIVO.SEMANAS
      ) PLETIVO
    WHERE 
      RECCURSO.HABILITACAO IS NULL
    AND
      RECCURSO.MODALIDADE_ID=MODALIDADE.ID(+)
    AND
      CURRXDISC.DURACXCI_ID=DURACXCI.ID(+)
    AND
      RECCURSO.CAMPUS_ID=6400000000001
    AND
      RECCURSO.VIGENTE='on'
    AND
      RECCURSO.CURSO_ID=CURSO.ID
    AND
      CURR.CURSO_MIG_ID=CURSO.ID
    AND
      CURRXDISC.CURR_ID=CURR.ID
    AND
      CURRXDISC.DISC_ID=DISC.ID
    AND  
      CURR.ID IN (5800000000257,5800000000256,5800000000230)
    UNION   
    SELECT 
      '25110001'||PLETIVO.SEMANAS                                                AS COD_GRD_CURRICULAR_EXT,
      '25110001'||PLETIVO.SEMANAS                                                AS SGL_GRD_CURRICULAR,
      CURR_GNRETDURACAO(CURR.ID)                                                 AS NUM_TOTAL_PERIODO,
      NVL(DURACXCI.SEQUENCIA,1)                                                  AS NUM_PERIODO,
      NULL                                                                       AS OBS_GRD_CURRICULAR,
      NULL                                                                       AS DAT_CADASTRAMENTO, 	
      TO_CHAR(CURSO.ID)                                                          AS COD_CURSO_EXT,
      CURSO.ID||' '||DECODE(CURSO.ID,5700000003226,'Sequencial',5700000005279,'Sequencial',MODALIDADE.NOME) AS COD_HABILITACAO_EXT, 
      'C'                                                                        AS IND_TPO_HABILITACAO,
      DECODE(CURRXDISC.OBRIG,'on','OBRIGATORIA','OPCIONAL')                      AS COD_TPO_DISC_GRADE_EXT,
      DECODE(CURRXDISC.OBRIG,'on','OBRIGATORIA','OPCIONAL')                      AS DSC_TPO_DISC_GRADE,
      DECODE(CURRXDISC.OBRIG,'on','OBRIGATORIA','OPCIONAL')                      AS SGL_TPO_DISC_GRADE,
      DECODE(NVL(CURRXDISC.CHTOTAL,0),0,TO_CHAR(CURSO.ID)||TO_CHAR(DISC.ID)||((PLETIVO.SEMANAS*nvl(CHSEMANALTEORIA,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALPRATICA,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALLAB,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALEXERC,0))),TO_CHAR(CURSO.ID)||TO_CHAR(DISC.ID)||CURRXDISC.CHTOTAl ) AS COD_DISCIPLINA_EXT,
      0                                                                          AS NUM_CREDITO_FINANC,
      DECODE(NVL(CURRXDISC.CHTOTAL,0),0,((PLETIVO.SEMANAS*nvl(CHSEMANALTEORIA,0))+(PLETIVO.SEMANAS*nvl(CHSEMANALPRATICA,0))+(PLETIVO.SEMANAS*nvl(CHSEMANALLAB,0))+(PLETIVO.SEMANAS*nvl(CHSEMANALEXERC,0))),CURRXDISC.CHTOTAL)  AS VAL_CARGA_HORARIA,
      'N'                                                                        AS IND_HORA_RELOGIO
    FROM 
      MODALIDADE,
      RECCURSO,
      DURACXCI,
      CURRXDISC,
      CURR,
      CURSO,
      DISC,
      ( 
      SELECT
        PLETIVO.SEMANAS
      FROM
        PLETIVO
      WHERE
        PLETIVO.CICLO_ID=5400000000001
      AND
        PLETIVO.ID >= 7200000000022 
      GROUP BY PLETIVO.SEMANAS
      ) PLETIVO
    WHERE 
      RECCURSO.HABILITACAO IS NULL
    AND
      RECCURSO.MODALIDADE_ID=MODALIDADE.ID(+)
    AND
      CURRXDISC.DURACXCI_ID=DURACXCI.ID(+)
    AND
      RECCURSO.CAMPUS_ID=6400000000001
    AND
      RECCURSO.VIGENTE='on'
    AND
      RECCURSO.CURSO_ID=CURSO.ID
    AND
      CURR.CURSO_MIG_ID=CURSO.ID
    AND
      CURRXDISC.CURR_ID=CURR.ID
    AND
      CURRXDISC.DISC_ID=DISC.ID
    AND  
      CURR.ID IN (5800000000251,5800000000249,5800000000227)
    UNION
    SELECT 
      '25130001'||PLETIVO.SEMANAS                                                AS COD_GRD_CURRICULAR_EXT,
      '25130001'||PLETIVO.SEMANAS                                                AS SGL_GRD_CURRICULAR,
      CURR_GNRETDURACAO(CURR.ID)                                                 AS NUM_TOTAL_PERIODO,
      NVL(DURACXCI.SEQUENCIA,1)                                                  AS NUM_PERIODO,
      NULL                                                                       AS OBS_GRD_CURRICULAR,
      NULL                                                                       AS DAT_CADASTRAMENTO, 	
      TO_CHAR(CURSO.ID)                                                          AS COD_CURSO_EXT,
      CURSO.ID||' '||DECODE(CURSO.ID,5700000003226,'Sequencial',5700000005279,'Sequencial',MODALIDADE.NOME) AS COD_HABILITACAO_EXT, 
      'C'                                                                        AS IND_TPO_HABILITACAO,
      DECODE(CURRXDISC.OBRIG,'on','OBRIGATORIA','OPCIONAL')                      AS COD_TPO_DISC_GRADE_EXT,
      DECODE(CURRXDISC.OBRIG,'on','OBRIGATORIA','OPCIONAL')                      AS DSC_TPO_DISC_GRADE,
      DECODE(CURRXDISC.OBRIG,'on','OBRIGATORIA','OPCIONAL')                      AS SGL_TPO_DISC_GRADE,
      DECODE(NVL(CURRXDISC.CHTOTAL,0),0,TO_CHAR(CURSO.ID)||TO_CHAR(DISC.ID)||((PLETIVO.SEMANAS*nvl(CHSEMANALTEORIA,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALPRATICA,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALLAB,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALEXERC,0))),TO_CHAR(CURSO.ID)||TO_CHAR(DISC.ID)||CURRXDISC.CHTOTAl ) AS COD_DISCIPLINA_EXT,
      0                                                                          AS NUM_CREDITO_FINANC,
      DECODE(NVL(CURRXDISC.CHTOTAL,0),0,((PLETIVO.SEMANAS*nvl(CHSEMANALTEORIA,0))+(PLETIVO.SEMANAS*nvl(CHSEMANALPRATICA,0))+(PLETIVO.SEMANAS*nvl(CHSEMANALLAB,0))+(PLETIVO.SEMANAS*nvl(CHSEMANALEXERC,0))),CURRXDISC.CHTOTAL)  AS VAL_CARGA_HORARIA,
      'N'                                                                        AS IND_HORA_RELOGIO
    FROM 
      MODALIDADE,
      RECCURSO,
      DURACXCI,
      CURRXDISC,
      CURR,
      CURSO,
      DISC,
      ( 
      SELECT
        PLETIVO.SEMANAS
      FROM
        PLETIVO
      WHERE
        PLETIVO.CICLO_ID=5400000000001
      AND
        PLETIVO.ID >= 7200000000022 
      GROUP BY PLETIVO.SEMANAS
      ) PLETIVO
    WHERE 
      RECCURSO.HABILITACAO IS NULL
    AND
      RECCURSO.MODALIDADE_ID=MODALIDADE.ID(+)
    AND
      CURRXDISC.DURACXCI_ID=DURACXCI.ID(+)
    AND
      RECCURSO.CAMPUS_ID=6400000000001
    AND
      RECCURSO.VIGENTE='on'
    AND
      RECCURSO.CURSO_ID=CURSO.ID
    AND
      CURR.CURSO_MIG_ID=CURSO.ID
    AND
      CURRXDISC.CURR_ID=CURR.ID
    AND
      CURRXDISC.DISC_ID=DISC.ID
    AND  
      CURR.ID IN (5800000000251,5800000000249,5800000000228)      
  )  
)
