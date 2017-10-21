SELECT
  TO_CHAR(CURSO.ID)||TO_CHAR(DISC.ID)||((PLETIVO.SEMANAS*nvl(CHSEMANALTEORIA,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALPRATICA,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALLAB,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALEXERC,0))) AS COD_DISCIPLINA_EXT,
  DISC.NOME                                                     AS NOM_DISCIPLINA,
  DISC.CODIGO                                                   AS SGL_DISCIPLINA,
  0                                                             AS NUM_CREDITOS,
  NVL(DISCCAT.CODIGOSIAF,DISCCAT.NOME)                          AS COD_TPO_DISCIPLINA,
  'T'                                                           AS COD_TPO_CARGA_HOR_EXT,
  'TEORIA'                                                      AS DSC_TPO_CARGA_HOR,
  'T'                                                           AS SGL_TPO_CHORARIA,
  (PLETIVO.SEMANAS*CHSEMANALTEORIA)                             AS VAL_CARGA_HORARIA,
  NULL                                                          AS DAT_INICIO,
  NULL                                                          AS DAT_FINAL,	 
  'N'                                                           AS IND_COBRADA,
  'N'                                                           AS IND_POSSUI_HORARIO,
  'N'                                                           AS IND_HORA_RELOGIO
FROM 
  DISCCAT,
  CURR,
  CURSO,
  CURRXDISC,
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
  CURRXDISC.DISCCAT_ID=DISCCAT.ID(+)
AND
  CURR.CURSO_MIG_ID=CURSO.ID
AND
  CURRXDISC.CURR_ID=CURR.ID
AND
  CURRXDISC.DISC_ID=DISC.ID
AND
  NVL(CHSEMANALTEORIA,0) > 0
AND 
  NVL(CHTOTAL,0) = 0  
UNION
SELECT
  TO_CHAR(CURSO.ID)||TO_CHAR(DISC.ID)||((PLETIVO.SEMANAS*nvl(CHSEMANALTEORIA,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALPRATICA,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALLAB,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALEXERC,0))) AS COD_DISCIPLINA_EXT,
  DISC.NOME                                                     AS NOM_DISCIPLINA,
  DISC.CODIGO                                                   AS SGL_DISCIPLINA,
  0                                                             AS NUM_CREDITOS,
  NVL(DISCCAT.CODIGOSIAF,DISCCAT.NOME)                          AS COD_TPO_DISCIPLINA,
  'P'                                                           AS COD_TPO_CARGA_HOR_EXT,
  'PRATICA'                                                     AS DSC_TPO_CARGA_HOR,
  'P'                                                           AS SGL_TPO_CHORARIA,
  (PLETIVO.SEMANAS*CHSEMANALPRATICA)                            AS VAL_CARGA_HORARIA,
  NULL                                                          AS DAT_INICIO,
  NULL                                                          AS DAT_FINAL,	 
  'N'                                                           AS IND_COBRADA,
  'N'                                                           AS IND_POSSUI_HORARIO,
  'N'                                                           AS IND_HORA_RELOGIO
FROM 
  DISCCAT,
  CURR,
  CURSO,
  CURRXDISC,
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
  CURRXDISC.DISCCAT_ID=DISCCAT.ID(+)
AND
  CURR.CURSO_MIG_ID=CURSO.ID
AND
  CURRXDISC.CURR_ID=CURR.ID
AND
  CURRXDISC.DISC_ID=DISC.ID
AND
  NVL(CHSEMANALPRATICA,0) > 0
AND
  NVL(CHTOTAL,0) = 0  
UNION
SELECT
  TO_CHAR(CURSO.ID)||TO_CHAR(DISC.ID)||((PLETIVO.SEMANAS*nvl(CHSEMANALTEORIA,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALPRATICA,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALLAB,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALEXERC,0))) AS COD_DISCIPLINA_EXT,
  DISC.NOME                                                     AS NOM_DISCIPLINA,
  DISC.CODIGO                                                   AS SGL_DISCIPLINA,
  0                                                             AS NUM_CREDITOS,
  NVL(DISCCAT.CODIGOSIAF,DISCCAT.NOME)                          AS COD_TPO_DISCIPLINA,
  'L'                                                           AS COD_TPO_CARGA_HOR_EXT,
  'LABORATORIO'                                                 AS DSC_TPO_CARGA_HOR,
  'L'                                                           AS SGL_TPO_CHORARIA,
  (PLETIVO.SEMANAS*CHSEMANALLAB)                                AS VAL_CARGA_HORARIA,
  NULL                                                          AS DAT_INICIO,
  NULL                                                          AS DAT_FINAL,	 
  'N'                                                           AS IND_COBRADA,
  'N'                                                           AS IND_POSSUI_HORARIO,
  'N'                                                           AS IND_HORA_RELOGIO
FROM 
  DISCCAT,
  CURR,
  CURSO,
  CURRXDISC,
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
  CURRXDISC.DISCCAT_ID=DISCCAT.ID(+)
AND
  CURR.CURSO_MIG_ID=CURSO.ID
AND
  CURRXDISC.CURR_ID=CURR.ID
AND
  CURRXDISC.DISC_ID=DISC.ID
AND
  NVL(CHSEMANALLAB,0) > 0
AND
  NVL(CHTOTAL,0) = 0  
UNION
SELECT
  TO_CHAR(CURSO.ID)||TO_CHAR(DISC.ID)||((PLETIVO.SEMANAS*nvl(CHSEMANALTEORIA,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALPRATICA,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALLAB,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALEXERC,0))) AS COD_DISCIPLINA_EXT,
  DISC.NOME                                                     AS NOM_DISCIPLINA,
  DISC.CODIGO                                                   AS SGL_DISCIPLINA,
  0                                                             AS NUM_CREDITOS,
  NVL(DISCCAT.CODIGOSIAF,DISCCAT.NOME)                          AS COD_TPO_DISCIPLINA,
  'E'                                                           AS COD_TPO_CARGA_HOR_EXT,
  'EXERCICIO'                                                   AS DSC_TPO_CARGA_HOR,
  'E'                                                           AS SGL_TPO_CHORARIA,
  (PLETIVO.SEMANAS*CHSEMANALEXERC)                              AS VAL_CARGA_HORARIA,
  NULL                                                          AS DAT_INICIO,
  NULL                                                          AS DAT_FINAL,	 
  'N'                                                           AS IND_COBRADA,
  'N'                                                           AS IND_POSSUI_HORARIO,
  'N'                                                           AS IND_HORA_RELOGIO
FROM 
  DISCCAT,
  CURR,
  CURSO,
  CURRXDISC,
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
  CURRXDISC.DISCCAT_ID=DISCCAT.ID(+)
AND
  CURR.CURSO_MIG_ID=CURSO.ID
AND
  CURRXDISC.CURR_ID=CURR.ID
AND
  CURRXDISC.DISC_ID=DISC.ID
AND
  NVL(CHSEMANALEXERC,0) > 0
AND
  NVL(CHTOTAL,0) = 0  
UNION
SELECT
  TO_CHAR(CURSO.ID)||TO_CHAR(DISC.ID)||CURRXDISC.CHTOTAL AS COD_DISCIPLINA_EXT,
  DISC.NOME                                              AS NOM_DISCIPLINA,
  DISC.CODIGO                                            AS SGL_DISCIPLINA,
  0                                                      AS NUM_CREDITOS,
  NVL(DISCCAT.CODIGOSIAF,DISCCAT.NOME)                   AS COD_TPO_DISCIPLINA,
  'EST'                                                  AS COD_TPO_CARGA_HOR_EXT,
  'ESTAGIO'                                              AS DSC_TPO_CARGA_HOR,
  'EST'                                                  AS SGL_TPO_CHORARIA,
  CURRXDISC.CHTOTAL                                      AS VAL_CARGA_HORARIA,
  NULL                                                   AS DAT_INICIO,
  NULL                                                   AS DAT_FINAL,	 
  'N'                                                    AS IND_COBRADA,
  'N'                                                    AS IND_POSSUI_HORARIO,
  'N'                                                    AS IND_HORA_RELOGIO
FROM 
  DISCCAT,
  CURR,
  CURSO,
  CURRXDISC,
  DISC
WHERE
  CURRXDISC.DISCCAT_ID=DISCCAT.ID(+)
AND
  CURR.CURSO_MIG_ID=CURSO.ID
AND
  CURRXDISC.CURR_ID=CURR.ID
AND
  CURRXDISC.DISC_ID=DISC.ID
AND 
  NVL(CHTOTAL,0) > 0  
