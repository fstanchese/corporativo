(
  SELECT /* professor 1*/
    TO_CHAR(TURMAOFE.ID)||TO_CHAR(CURSO.ID)||TO_CHAR(CURRXDISC.DISC_ID)||((PLETIVO.SEMANAS*nvl(CURRXDISC.CHSEMANALTEORIA,0))||(PLETIVO.SEMANAS*nvl(CURRXDISC.CHSEMANALPRATICA,0))||(PLETIVO.SEMANAS*nvl(CURRXDISC.CHSEMANALLAB,0))||(PLETIVO.SEMANAS*nvl(CURRXDISC.CHSEMANALEXERC,0)))||'T'||DIVTURMA_ID AS COD_TURMA_EXT,
    TURMA.CODIGO                                                                         AS NOM_TURMA,
    DURACXCI.SEQUENCIA                                                                   AS NUM_PERIODO,
    'N'                                                                                  AS IND_ESPECIAL,
    'S'                                                                                  AS IND_HORARIO,
    'N'                                                                                  AS IND_EAD,
    NVL(TO_CHAR(HORAAULA.WPESSOA_PROF1_ID),'a definir')                                  AS COD_PROFESSOR_EXT,
    'S'                                                                                  AS IND_PROFESSOR_PRINCIPAL,
    TO_CHAR(PLETIVO.ID)||TO_CHAR(CURSO.CURSONIVEL_ID)                                    AS COD_PERIODO_LETIVO_EXT,
    TO_CHAR(CURSO.ID)                                                                    AS COD_CURSO_EXT,
    DECODE(RECCURSO.HABILITACAO,NULL,DECODE(CURSO.CODIGO,'4003','Sequencial','4017','Sequencial','9999','Bacharelado',MODALIDADE.NOME),CURSO.ID||' '||RECCURSO.HABILITACAO)	AS COD_HABILITACAO_EXT, 
    TO_CHAR(TURMA.CAMPUS_ID)                                                             AS COD_CAMPUS_EXT,
    TO_CHAR(NVL(TURMA.PERIODO_ID,6500000000002))                                         AS COD_TURNO_EXT,
    TO_CHAR(CURSO.ID)||TO_CHAR(CURRXDISC.DISC_ID)||((PLETIVO.SEMANAS*nvl(CHSEMANALTEORIA,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALPRATICA,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALLAB,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALEXERC,0))) AS COD_DISCIPLINA_EXT,
    CURR.CODIGO||PLETIVO.SEMANAS                                                         AS COD_GRD_CURRICULAR_EXT,
    'T'                                                                                  AS COD_TPO_CARGA_HOR_EXT,
    NULL                                                                                 AS DAT_HORARIO,
    SUBSTR(HORARIO_GNRETSEMANA(HORAAULA.HORARIO_ID),-1)                                  AS DIA_SEMANA,
    HORARIO_GSHORAINICIO(HORAAULA.HORARIO_ID)                                            AS HOR_INICIO,
    NULL                                                                                 AS HOR_FIM,
    NULL                                                                                 AS DAT_INICIO_DURACAO,
    NULL                                                                                 AS DAT_FIM_DURACAO,
    0                                                                                    AS NUM_CAPACIDADE,
    ALOCAPROF_GSRETSALA( PLETIVO.ID , TURMAOFE.TURMA_ID , TOXCD.CURRXDISC_ID , HORAAULA.DIVTURMA_ID , HORAAULA.ID ) AS DSC_SALA,
    ALOCAPROF_GSRETSALA( PLETIVO.ID , TURMAOFE.TURMA_ID , TOXCD.CURRXDISC_ID , HORAAULA.DIVTURMA_ID , HORAAULA.ID ) AS NUM_SALA,
    NULL AS COD_CURSO_VAG_EXT,
    NULL AS COD_HABILITACAO_VAG_EXT,
    NULL AS COD_CAMPUS_VAG_EXT,
    NULL AS NUM_PERIODO_VAG,
    NULL AS IND_CALOURO,
    NULL AS IND_OUTRAS_CAPTACOES,
    NULL AS IND_PROUNI,
    NULL AS NUM_VAGAS,
    DECODE(HORAAULA.DIVTURMA_ID,NULL,NULL,TO_CHAR(TURMAOFE.ID)||TO_CHAR(CURSO.ID)||TO_CHAR(CURRXDISC.DISC_ID)||((PLETIVO.SEMANAS*nvl(CHSEMANALTEORIA,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALPRATICA,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALLAB,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALEXERC,0)))) AS COD_TURMA_ASSOC_EXT
  FROM
    MODALIDADE,
    HORAAULA,
    RECCURSO,
    CURSO,
    CURR,
    DURACXCI,
    TURMA,
    CURRXDISC,
    CURROFE,
    TURMAOFE,
    PLETIVO,
    TOXCD
  WHERE
    ( HORAAULA.AULATI_ID=13300000000001 OR HORAAULA.AULATI_ID IS NULL )
  AND
    RECCURSO.MODALIDADE_ID=MODALIDADE.ID(+)
  AND
    ( PLETIVO.FINAL BETWEEN HORAAULA.DTINICIO AND HORAAULA.DTTERMINO OR HORAAULA.ID IS NULL )  
  AND
    HORAAULA.TOXCD_ID (+)= TOXCD.ID
  AND
    CURSONIVEL_ID NOT IN (6200000000002,6200000000008)
  AND
    RECCURSO.VIGENTE='on'
  AND
    RECCURSO.CAMPUS_ID=TURMA.CAMPUS_ID
  AND
    RECCURSO.CURSO_ID=CURSO.ID
  AND
    TOXCD.TURMAOFE_ID=TURMAOFE.ID
  AND
    TOXCD.CURRXDISC_ID=CURRXDISC.ID
  AND
    CURR.CURSO_MIG_ID=CURSO.ID
  AND
    CURROFE.CURR_ID=CURR.ID
  AND
    TURMA.DURACXCI_ID=DURACXCI.ID
  AND
    TURMAOFE.TURMA_ID=TURMA.ID
  AND
    TURMAOFE.CURROFE_ID=CURROFE.ID
  AND
    CURROFE.PLETIVO_ID=PLETIVO.ID
  AND 
    NVL(CHSEMANALTEORIA,0) > 0
  AND
    NVL(CHTOTAL,0) = 0
  UNION ALL
  SELECT
    TO_CHAR(TURMAOFE.ID)||TO_CHAR(CURSO.ID)||TO_CHAR(CURRXDISC.DISC_ID)||((PLETIVO.SEMANAS*nvl(CURRXDISC.CHSEMANALTEORIA,0))||(PLETIVO.SEMANAS*nvl(CURRXDISC.CHSEMANALPRATICA,0))||(PLETIVO.SEMANAS*nvl(CURRXDISC.CHSEMANALLAB,0))||(PLETIVO.SEMANAS*nvl(CURRXDISC.CHSEMANALEXERC,0)))||'P'||DIVTURMA_ID AS COD_TURMA_EXT,
    TURMA.CODIGO                                                                         AS NOM_TURMA,
    DURACXCI.SEQUENCIA                                                                   AS NUM_PERIODO,
    'N'                                                                                  AS IND_ESPECIAL,
    'S'                                                                                  AS IND_HORARIO,
    'N'                                                                                  AS IND_EAD,
    NVL(TO_CHAR(HORAAULA.WPESSOA_PROF1_ID),'a definir')                                  AS COD_PROFESSOR_EXT,
    'S'                                                                                  AS IND_PROFESSOR_PRINCIPAL,
    TO_CHAR(PLETIVO.ID)||TO_CHAR(CURSO.CURSONIVEL_ID)                                    AS COD_PERIODO_LETIVO_EXT,
    TO_CHAR(CURSO.ID)                                                                    AS COD_CURSO_EXT,
    DECODE(RECCURSO.HABILITACAO,NULL,DECODE(CURSO.CODIGO,'4003','Sequencial','4017','Sequencial','9999','Bacharelado',MODALIDADE.NOME),CURSO.ID||' '||RECCURSO.HABILITACAO)	AS COD_HABILITACAO_EXT, 
    TO_CHAR(TURMA.CAMPUS_ID)                                                             AS COD_CAMPUS_EXT,
    TO_CHAR(NVL(TURMA.PERIODO_ID,6500000000001))                                         AS COD_TURNO_EXT,
    TO_CHAR(CURSO.ID)||TO_CHAR(CURRXDISC.DISC_ID)||((PLETIVO.SEMANAS*nvl(CHSEMANALTEORIA,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALPRATICA,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALLAB,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALEXERC,0))) AS COD_DISCIPLINA_EXT,
    CURR.CODIGO||PLETIVO.SEMANAS                                                         AS COD_GRD_CURRICULAR_EXT,
    'P'                                                                                  AS COD_TPO_CARGA_HOR_EXT,
    NULL                                                                                 AS DAT_HORARIO,
    SUBSTR(HORARIO_GNRETSEMANA(HORAAULA.HORARIO_ID),-1)                                  AS DIA_SEMANA,
    HORARIO_GSHORAINICIO(HORAAULA.HORARIO_ID)                                            AS HOR_INICIO,
    NULL                                                                                 AS HOR_FIM,
    NULL                                                                                 AS DAT_INICIO_DURACAO,
    NULL                                                                                 AS DAT_FIM_DURACAO,
    NULL                                                                                 AS NUM_CAPACIDADE,
    ALOCAPROF_GSRETSALA( PLETIVO.ID , TURMAOFE.TURMA_ID , TOXCD.CURRXDISC_ID , HORAAULA.DIVTURMA_ID , HORAAULA.ID ) AS DSC_SALA,
    ALOCAPROF_GSRETSALA( PLETIVO.ID , TURMAOFE.TURMA_ID , TOXCD.CURRXDISC_ID , HORAAULA.DIVTURMA_ID , HORAAULA.ID ) AS NUM_SALA,
    NULL AS COD_CURSO_VAG_EXT,
    NULL AS COD_HABILITACAO_VAG_EXT,
    NULL AS COD_CAMPUS_VAG_EXT,
    NULL AS NUM_PERIODO_VAG,
    NULL AS IND_CALOURO,
    NULL AS IND_OUTRAS_CAPTACOES,
    NULL AS IND_PROUNI,
    NULL AS NUM_VAGAS,
    DECODE(HORAAULA.DIVTURMA_ID,NULL,NULL,TO_CHAR(TURMAOFE.ID)||TO_CHAR(CURSO.ID)||TO_CHAR(CURRXDISC.DISC_ID)||((PLETIVO.SEMANAS*nvl(CHSEMANALTEORIA,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALPRATICA,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALLAB,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALEXERC,0)))) AS COD_TURMA_ASSOC_EXT
  FROM
    MODALIDADE,
    HORAAULA,
    RECCURSO,
    CURSO,
    CURR,
    DURACXCI,
    TURMA,
    CURRXDISC,
    CURROFE,
    TURMAOFE,
    PLETIVO,
    TOXCD
  WHERE
    ( HORAAULA.AULATI_ID=13300000000002 OR HORAAULA.AULATI_ID IS NULL )
  AND
    RECCURSO.MODALIDADE_ID=MODALIDADE.ID(+)
  AND
    ( PLETIVO.FINAL BETWEEN HORAAULA.DTINICIO AND HORAAULA.DTTERMINO OR HORAAULA.ID IS NULL )  
  AND
    HORAAULA.TOXCD_ID (+)= TOXCD.ID
  AND
    CURSONIVEL_ID NOT IN (6200000000002,6200000000008)
  AND
    RECCURSO.VIGENTE='on'
  AND
    RECCURSO.CAMPUS_ID=TURMA.CAMPUS_ID
  AND
    RECCURSO.CURSO_ID=CURSO.ID
  AND
    TOXCD.TURMAOFE_ID=TURMAOFE.ID
  AND
    TOXCD.CURRXDISC_ID=CURRXDISC.ID
  AND
    CURR.CURSO_MIG_ID=CURSO.ID
  AND
    CURROFE.CURR_ID=CURR.ID
  AND
    TURMA.DURACXCI_ID=DURACXCI.ID
  AND
    TURMAOFE.TURMA_ID=TURMA.ID
  AND
    TURMAOFE.CURROFE_ID=CURROFE.ID
  AND
    CURROFE.PLETIVO_ID=PLETIVO.ID
  AND 
    NVL(CHSEMANALPRATICA,0) > 0
  AND
    NVL(CHTOTAL,0) = 0	
  UNION ALL
  SELECT
    TO_CHAR(TURMAOFE.ID)||TO_CHAR(CURSO.ID)||TO_CHAR(CURRXDISC.DISC_ID)||((PLETIVO.SEMANAS*nvl(CURRXDISC.CHSEMANALTEORIA,0))||(PLETIVO.SEMANAS*nvl(CURRXDISC.CHSEMANALPRATICA,0))||(PLETIVO.SEMANAS*nvl(CURRXDISC.CHSEMANALLAB,0))||(PLETIVO.SEMANAS*nvl(CURRXDISC.CHSEMANALEXERC,0)))||'L'||DIVTURMA_ID AS COD_TURMA_EXT,
    TURMA.CODIGO                                                                         AS NOM_TURMA,
    DURACXCI.SEQUENCIA                                                                   AS NUM_PERIODO,
    'N'                                                                                  AS IND_ESPECIAL,
    'S'                                                                                  AS IND_HORARIO,
    'N'                                                                                  AS IND_EAD,
    NVL(TO_CHAR(HORAAULA.WPESSOA_PROF1_ID),'a definir')                                  AS COD_PROFESSOR_EXT,
    'S'                                                                                  AS IND_PROFESSOR_PRINCIPAL,
    TO_CHAR(PLETIVO.ID)||TO_CHAR(CURSO.CURSONIVEL_ID)                                    AS COD_PERIODO_LETIVO_EXT,
    TO_CHAR(CURSO.ID)                                                                    AS COD_CURSO_EXT,
    DECODE(RECCURSO.HABILITACAO,NULL,DECODE(CURSO.CODIGO,'4003','Sequencial','4017','Sequencial','9999','Bacharelado',MODALIDADE.NOME),CURSO.ID||' '||RECCURSO.HABILITACAO)	AS COD_HABILITACAO_EXT, 
    TO_CHAR(TURMA.CAMPUS_ID)                                                             AS COD_CAMPUS_EXT,
    TO_CHAR(NVL(TURMA.PERIODO_ID,6500000000001))                                         AS COD_TURNO_EXT,
    TO_CHAR(CURSO.ID)||TO_CHAR(CURRXDISC.DISC_ID)||((PLETIVO.SEMANAS*nvl(CHSEMANALTEORIA,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALPRATICA,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALLAB,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALEXERC,0))) AS COD_DISCIPLINA_EXT,
    CURR.CODIGO||PLETIVO.SEMANAS                                                         AS COD_GRD_CURRICULAR_EXT,
    'L'                                                                                  AS COD_TPO_CARGA_HOR_EXT,
    NULL                                                                                 AS DAT_HORARIO,
    SUBSTR(HORARIO_GNRETSEMANA(HORAAULA.HORARIO_ID),-1)                                  AS DIA_SEMANA,
    HORARIO_GSHORAINICIO(HORAAULA.HORARIO_ID)                                            AS HOR_INICIO,
    NULL                                                                                 AS HOR_FIM,
    NULL                                                                                 AS DAT_INICIO_DURACAO,
    NULL                                                                                 AS DAT_FIM_DURACAO,
    NULL                                                                                 AS NUM_CAPACIDADE,
    ALOCAPROF_GSRETSALA( PLETIVO.ID , TURMAOFE.TURMA_ID , TOXCD.CURRXDISC_ID , HORAAULA.DIVTURMA_ID , HORAAULA.ID ) AS DSC_SALA,
    ALOCAPROF_GSRETSALA( PLETIVO.ID , TURMAOFE.TURMA_ID , TOXCD.CURRXDISC_ID , HORAAULA.DIVTURMA_ID , HORAAULA.ID ) AS NUM_SALA,
    NULL AS COD_CURSO_VAG_EXT,
    NULL AS COD_HABILITACAO_VAG_EXT,
    NULL AS COD_CAMPUS_VAG_EXT,
    NULL AS NUM_PERIODO_VAG,
    NULL AS IND_CALOURO,
    NULL AS IND_OUTRAS_CAPTACOES,
    NULL AS IND_PROUNI,
    NULL AS NUM_VAGAS,
    DECODE(HORAAULA.DIVTURMA_ID,NULL,NULL,TO_CHAR(TURMAOFE.ID)||TO_CHAR(CURSO.ID)||TO_CHAR(CURRXDISC.DISC_ID)||((PLETIVO.SEMANAS*nvl(CHSEMANALTEORIA,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALPRATICA,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALLAB,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALEXERC,0)))) AS COD_TURMA_ASSOC_EXT
  FROM
    MODALIDADE,
    HORAAULA,
    RECCURSO,
    CURSO,
    CURR,
    DURACXCI,
    TURMA,
    CURRXDISC,
    CURROFE,
    TURMAOFE,
    PLETIVO,
    TOXCD
  WHERE
    RECCURSO.MODALIDADE_ID=MODALIDADE.ID(+)
  AND
    ( PLETIVO.FINAL BETWEEN HORAAULA.DTINICIO AND HORAAULA.DTTERMINO OR HORAAULA.ID IS NULL )  
  AND
    HORAAULA.TOXCD_ID (+)= TOXCD.ID
  AND
    CURSONIVEL_ID NOT IN (6200000000002,6200000000008)
  AND
    RECCURSO.VIGENTE='on'
  AND
    RECCURSO.CAMPUS_ID=TURMA.CAMPUS_ID
  AND
    RECCURSO.CURSO_ID=CURSO.ID
  AND
    TOXCD.TURMAOFE_ID=TURMAOFE.ID
  AND
    TOXCD.CURRXDISC_ID=CURRXDISC.ID
  AND
    CURR.CURSO_MIG_ID=CURSO.ID
  AND
    CURROFE.CURR_ID=CURR.ID
  AND
    TURMA.DURACXCI_ID=DURACXCI.ID
  AND
    TURMAOFE.TURMA_ID=TURMA.ID
  AND
    TURMAOFE.CURROFE_ID=CURROFE.ID
  AND
    CURROFE.PLETIVO_ID=PLETIVO.ID
  AND 
    NVL(CHSEMANALLAB,0) > 0
  AND
    NVL(CHTOTAL,0) = 0	
  UNION ALL
  SELECT
    TO_CHAR(TURMAOFE.ID)||TO_CHAR(CURSO.ID)||TO_CHAR(CURRXDISC.DISC_ID)||((PLETIVO.SEMANAS*nvl(CURRXDISC.CHSEMANALTEORIA,0))||(PLETIVO.SEMANAS*nvl(CURRXDISC.CHSEMANALPRATICA,0))||(PLETIVO.SEMANAS*nvl(CURRXDISC.CHSEMANALLAB,0))||(PLETIVO.SEMANAS*nvl(CURRXDISC.CHSEMANALEXERC,0)))||'E'||DIVTURMA_ID AS COD_TURMA_EXT,
    TURMA.CODIGO                                                                         AS NOM_TURMA,
    DURACXCI.SEQUENCIA                                                                   AS NUM_PERIODO,
    'N'                                                                                  AS IND_ESPECIAL,
    'S'                                                                                  AS IND_HORARIO,
    'N'                                                                                  AS IND_EAD,
    NVL(TO_CHAR(HORAAULA.WPESSOA_PROF1_ID),'a definir')                                  AS COD_PROFESSOR_EXT,
    'S'                                                                                  AS IND_PROFESSOR_PRINCIPAL,
    TO_CHAR(PLETIVO.ID)||TO_CHAR(CURSO.CURSONIVEL_ID)                                    AS COD_PERIODO_LETIVO_EXT,
    TO_CHAR(CURSO.ID)                                                                    AS COD_CURSO_EXT,
    DECODE(RECCURSO.HABILITACAO,NULL,DECODE(CURSO.CODIGO,'4003','Sequencial','4017','Sequencial','9999','Bacharelado',MODALIDADE.NOME),CURSO.ID||' '||RECCURSO.HABILITACAO)	AS COD_HABILITACAO_EXT, 
    TO_CHAR(TURMA.CAMPUS_ID)                                                             AS COD_CAMPUS_EXT,
    TO_CHAR(NVL(TURMA.PERIODO_ID,6500000000001))                                         AS COD_TURNO_EXT,
    TO_CHAR(CURSO.ID)||TO_CHAR(CURRXDISC.DISC_ID)||((PLETIVO.SEMANAS*nvl(CHSEMANALTEORIA,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALPRATICA,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALLAB,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALEXERC,0))) AS COD_DISCIPLINA_EXT,
    CURR.CODIGO||PLETIVO.SEMANAS                                                         AS COD_GRD_CURRICULAR_EXT,
    'E'                                                                                  AS COD_TPO_CARGA_HOR_EXT,
    NULL                                                                                 AS DAT_HORARIO,
    SUBSTR(HORARIO_GNRETSEMANA(HORAAULA.HORARIO_ID),-1)                                  AS DIA_SEMANA,
    HORARIO_GSHORAINICIO(HORAAULA.HORARIO_ID)                                            AS HOR_INICIO,
    NULL                                                                                 AS HOR_FIM,
    NULL                                                                                 AS DAT_INICIO_DURACAO,
    NULL                                                                                 AS DAT_FIM_DURACAO,
    NULL                                                                                 AS NUM_CAPACIDADE,
    ALOCAPROF_GSRETSALA( PLETIVO.ID , TURMAOFE.TURMA_ID , TOXCD.CURRXDISC_ID , HORAAULA.DIVTURMA_ID , HORAAULA.ID ) AS DSC_SALA,
    ALOCAPROF_GSRETSALA( PLETIVO.ID , TURMAOFE.TURMA_ID , TOXCD.CURRXDISC_ID , HORAAULA.DIVTURMA_ID , HORAAULA.ID ) AS NUM_SALA,
    NULL AS COD_CURSO_VAG_EXT,
    NULL AS COD_HABILITACAO_VAG_EXT,
    NULL AS COD_CAMPUS_VAG_EXT,
    NULL AS NUM_PERIODO_VAG,
    NULL AS IND_CALOURO,
    NULL AS IND_OUTRAS_CAPTACOES,
    NULL AS IND_PROUNI,
    NULL AS NUM_VAGAS,
    DECODE(HORAAULA.DIVTURMA_ID,NULL,NULL,TO_CHAR(TURMAOFE.ID)||TO_CHAR(CURSO.ID)||TO_CHAR(CURRXDISC.DISC_ID)||((PLETIVO.SEMANAS*nvl(CHSEMANALTEORIA,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALPRATICA,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALLAB,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALEXERC,0)))) AS COD_TURMA_ASSOC_EXT
  FROM
    MODALIDADE,
    HORAAULA,
    RECCURSO,
    CURSO,
    CURR,
    DURACXCI,
    TURMA,
    CURRXDISC,
    CURROFE,
    TURMAOFE,
    PLETIVO,
    TOXCD
  WHERE
    RECCURSO.MODALIDADE_ID=MODALIDADE.ID(+)
  AND
    ( PLETIVO.FINAL BETWEEN HORAAULA.DTINICIO AND HORAAULA.DTTERMINO OR HORAAULA.ID IS NULL )  
  AND
    HORAAULA.TOXCD_ID (+)= TOXCD.ID
  AND
    CURSONIVEL_ID NOT IN (6200000000002,6200000000008)
  AND
    RECCURSO.VIGENTE='on'
  AND
    RECCURSO.CAMPUS_ID=TURMA.CAMPUS_ID
  AND
    RECCURSO.CURSO_ID=CURSO.ID
  AND
    TOXCD.TURMAOFE_ID=TURMAOFE.ID
  AND
    TOXCD.CURRXDISC_ID=CURRXDISC.ID
  AND
    CURR.CURSO_MIG_ID=CURSO.ID
  AND
    CURROFE.CURR_ID=CURR.ID
  AND
    TURMA.DURACXCI_ID=DURACXCI.ID
  AND
    TURMAOFE.TURMA_ID=TURMA.ID
  AND
    TURMAOFE.CURROFE_ID=CURROFE.ID
  AND
    CURROFE.PLETIVO_ID=PLETIVO.ID
  AND 
    NVL(CHSEMANALEXERC,0) > 0
  AND
    NVL(CHTOTAL,0) = 0		
)  
UNION ALL /* professor 2*/
(
  SELECT
    TO_CHAR(TURMAOFE.ID)||TO_CHAR(CURSO.ID)||TO_CHAR(CURRXDISC.DISC_ID)||((PLETIVO.SEMANAS*nvl(CURRXDISC.CHSEMANALTEORIA,0))||(PLETIVO.SEMANAS*nvl(CURRXDISC.CHSEMANALPRATICA,0))||(PLETIVO.SEMANAS*nvl(CURRXDISC.CHSEMANALLAB,0))||(PLETIVO.SEMANAS*nvl(CURRXDISC.CHSEMANALEXERC,0)))||'T'||DIVTURMA_ID AS COD_TURMA_EXT,
    TURMA.CODIGO                                                                         AS NOM_TURMA,
    DURACXCI.SEQUENCIA                                                                   AS NUM_PERIODO,
    'N'                                                                                  AS IND_ESPECIAL,
    'S'                                                                                  AS IND_HORARIO,
    'N'                                                                                  AS IND_EAD,
    NVL(TO_CHAR(HORAAULA.WPESSOA_PROF2_ID),'a definir')                                  AS COD_PROFESSOR_EXT,
    'N'                                                                                  AS IND_PROFESSOR_PRINCIPAL,
    TO_CHAR(PLETIVO.ID)||TO_CHAR(CURSO.CURSONIVEL_ID)                                    AS COD_PERIODO_LETIVO_EXT,
    TO_CHAR(CURSO.ID)                                                                    AS COD_CURSO_EXT,
    DECODE(RECCURSO.HABILITACAO,NULL,DECODE(CURSO.CODIGO,'4003','Sequencial','4017','Sequencial','9999','Bacharelado',MODALIDADE.NOME),CURSO.ID||' '||RECCURSO.HABILITACAO)	AS COD_HABILITACAO_EXT, 
    TO_CHAR(TURMA.CAMPUS_ID)                                                             AS COD_CAMPUS_EXT,
    TO_CHAR(NVL(TURMA.PERIODO_ID,6500000000001))                                         AS COD_TURNO_EXT,
    TO_CHAR(CURSO.ID)||TO_CHAR(CURRXDISC.DISC_ID)||((PLETIVO.SEMANAS*nvl(CHSEMANALTEORIA,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALPRATICA,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALLAB,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALEXERC,0))) AS COD_DISCIPLINA_EXT,
    CURR.CODIGO||PLETIVO.SEMANAS                                                         AS COD_GRD_CURRICULAR_EXT,
    'T'                                                                                  AS COD_TPO_CARGA_HOR_EXT,
    NULL                                                                                 AS DAT_HORARIO,
    SUBSTR(HORARIO_GNRETSEMANA(HORAAULA.HORARIO_ID),-1)                                  AS DIA_SEMANA,
    HORARIO_GSHORAINICIO(HORAAULA.HORARIO_ID)                                            AS HOR_INICIO,
    NULL                                                                                 AS HOR_FIM,
    NULL                                                                                 AS DAT_INICIO_DURACAO,
    NULL                                                                                 AS DAT_FIM_DURACAO,
    NULL                                                                                 AS NUM_CAPACIDADE,
    ALOCAPROF_GSRETSALA( PLETIVO.ID , TURMAOFE.TURMA_ID , TOXCD.CURRXDISC_ID , HORAAULA.DIVTURMA_ID , HORAAULA.ID ) AS DSC_SALA,
    ALOCAPROF_GSRETSALA( PLETIVO.ID , TURMAOFE.TURMA_ID , TOXCD.CURRXDISC_ID , HORAAULA.DIVTURMA_ID , HORAAULA.ID ) AS NUM_SALA,
    NULL AS COD_CURSO_VAG_EXT,
    NULL AS COD_HABILITACAO_VAG_EXT,
    NULL AS COD_CAMPUS_VAG_EXT,
    NULL AS NUM_PERIODO_VAG,
    NULL AS IND_CALOURO,
    NULL AS IND_OUTRAS_CAPTACOES,
    NULL AS IND_PROUNI,
    NULL AS NUM_VAGAS,
    DECODE(HORAAULA.DIVTURMA_ID,NULL,NULL,TO_CHAR(TURMAOFE.ID)||TO_CHAR(CURSO.ID)||TO_CHAR(CURRXDISC.DISC_ID)||((PLETIVO.SEMANAS*nvl(CHSEMANALTEORIA,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALPRATICA,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALLAB,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALEXERC,0)))) AS COD_TURMA_ASSOC_EXT
  FROM
    MODALIDADE,
    HORAAULA,
    RECCURSO,
    CURSO,
    CURR,
    DURACXCI,
    TURMA,
    CURRXDISC,
    CURROFE,
    TURMAOFE,
    PLETIVO,
    TOXCD
  WHERE
    ( HORAAULA.AULATI_ID=13300000000001 OR HORAAULA.AULATI_ID IS NULL )
  AND
    HORAAULA.WPESSOA_PROF2_ID IS NOT NULL
  AND
    RECCURSO.MODALIDADE_ID=MODALIDADE.ID(+)
  AND
    ( PLETIVO.FINAL BETWEEN HORAAULA.DTINICIO AND HORAAULA.DTTERMINO OR HORAAULA.ID IS NULL )  
  AND
    HORAAULA.TOXCD_ID (+)= TOXCD.ID
  AND
    CURSONIVEL_ID NOT IN (6200000000002,6200000000008)
  AND
    RECCURSO.VIGENTE='on'
  AND
    RECCURSO.CAMPUS_ID=TURMA.CAMPUS_ID
  AND
    RECCURSO.CURSO_ID=CURSO.ID
  AND
    TOXCD.TURMAOFE_ID=TURMAOFE.ID
  AND
    TOXCD.CURRXDISC_ID=CURRXDISC.ID
  AND
    CURR.CURSO_MIG_ID=CURSO.ID
  AND
    CURROFE.CURR_ID=CURR.ID
  AND
    TURMA.DURACXCI_ID=DURACXCI.ID
  AND
    TURMAOFE.TURMA_ID=TURMA.ID
  AND
    TURMAOFE.CURROFE_ID=CURROFE.ID
  AND
    CURROFE.PLETIVO_ID=PLETIVO.ID
  AND 
    NVL(CHSEMANALTEORIA,0) > 0
  AND
    NVL(CHTOTAL,0) = 0
  UNION ALL
  SELECT
    TO_CHAR(TURMAOFE.ID)||TO_CHAR(CURSO.ID)||TO_CHAR(CURRXDISC.DISC_ID)||((PLETIVO.SEMANAS*nvl(CHSEMANALTEORIA,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALPRATICA,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALLAB,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALEXERC,0)))||'P'||DIVTURMA_ID AS COD_TURMA_EXT,
    TURMA.CODIGO                                                                         AS NOM_TURMA,
    DURACXCI.SEQUENCIA                                                                   AS NUM_PERIODO,
    'N'                                                                                  AS IND_ESPECIAL,
    'S'                                                                                  AS IND_HORARIO,
    'N'                                                                                  AS IND_EAD,
    NVL(TO_CHAR(HORAAULA.WPESSOA_PROF2_ID),'a definir')                                  AS COD_PROFESSOR_EXT,
    'N'                                                                                  AS IND_PROFESSOR_PRINCIPAL,
    TO_CHAR(PLETIVO.ID)||TO_CHAR(CURSO.CURSONIVEL_ID)                                    AS COD_PERIODO_LETIVO_EXT,
    TO_CHAR(CURSO.ID)                                                                    AS COD_CURSO_EXT,
    DECODE(RECCURSO.HABILITACAO,NULL,DECODE(CURSO.CODIGO,'4003','Sequencial','4017','Sequencial','9999','Bacharelado',MODALIDADE.NOME),CURSO.ID||' '||RECCURSO.HABILITACAO)	AS COD_HABILITACAO_EXT, 
    TO_CHAR(TURMA.CAMPUS_ID)                                                             AS COD_CAMPUS_EXT,
    TO_CHAR(NVL(TURMA.PERIODO_ID,6500000000001))                                         AS COD_TURNO_EXT,
    TO_CHAR(CURSO.ID)||TO_CHAR(CURRXDISC.DISC_ID)||((PLETIVO.SEMANAS*nvl(CHSEMANALTEORIA,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALPRATICA,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALLAB,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALEXERC,0))) AS COD_DISCIPLINA_EXT,
    CURR.CODIGO||PLETIVO.SEMANAS                                                         AS COD_GRD_CURRICULAR_EXT,
    'P'                                                                                  AS COD_TPO_CARGA_HOR_EXT,
    NULL                                                                                 AS DAT_HORARIO,
    SUBSTR(HORARIO_GNRETSEMANA(HORAAULA.HORARIO_ID),-1)                                  AS DIA_SEMANA,
    HORARIO_GSHORAINICIO(HORAAULA.HORARIO_ID)                                            AS HOR_INICIO,
    NULL                                                                                 AS HOR_FIM,
    NULL                                                                                 AS DAT_INICIO_DURACAO,
    NULL                                                                                 AS DAT_FIM_DURACAO,
    NULL                                                                                 AS NUM_CAPACIDADE,
    ALOCAPROF_GSRETSALA( PLETIVO.ID , TURMAOFE.TURMA_ID , TOXCD.CURRXDISC_ID , HORAAULA.DIVTURMA_ID , HORAAULA.ID ) AS DSC_SALA,
    ALOCAPROF_GSRETSALA( PLETIVO.ID , TURMAOFE.TURMA_ID , TOXCD.CURRXDISC_ID , HORAAULA.DIVTURMA_ID , HORAAULA.ID ) AS NUM_SALA,
    NULL AS COD_CURSO_VAG_EXT,
    NULL AS COD_HABILITACAO_VAG_EXT,
    NULL AS COD_CAMPUS_VAG_EXT,
    NULL AS NUM_PERIODO_VAG,
    NULL AS IND_CALOURO,
    NULL AS IND_OUTRAS_CAPTACOES,
    NULL AS IND_PROUNI,
    NULL AS NUM_VAGAS,
    DECODE(HORAAULA.DIVTURMA_ID,NULL,NULL,TO_CHAR(TURMAOFE.ID)||TO_CHAR(CURSO.ID)||TO_CHAR(CURRXDISC.DISC_ID)||((PLETIVO.SEMANAS*nvl(CHSEMANALTEORIA,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALPRATICA,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALLAB,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALEXERC,0)))) AS COD_TURMA_ASSOC_EXT
  FROM
    MODALIDADE,
    HORAAULA,
    RECCURSO,
    CURSO,
    CURR,
    DURACXCI,
    TURMA,
    CURRXDISC,
    CURROFE,
    TURMAOFE,
    PLETIVO,
    TOXCD
  WHERE
    ( HORAAULA.AULATI_ID=13300000000002 OR HORAAULA.AULATI_ID IS NULL )
  AND
    HORAAULA.WPESSOA_PROF2_ID IS NOT NULL
  AND
    RECCURSO.MODALIDADE_ID=MODALIDADE.ID(+)
  AND
    ( PLETIVO.FINAL BETWEEN HORAAULA.DTINICIO AND HORAAULA.DTTERMINO OR HORAAULA.ID IS NULL )  
  AND
    HORAAULA.TOXCD_ID (+)= TOXCD.ID
  AND
    CURSONIVEL_ID NOT IN (6200000000002,6200000000008)
  AND
    RECCURSO.VIGENTE='on'
  AND
    RECCURSO.CAMPUS_ID=TURMA.CAMPUS_ID
  AND
    RECCURSO.CURSO_ID=CURSO.ID
  AND
    TOXCD.TURMAOFE_ID=TURMAOFE.ID
  AND
    TOXCD.CURRXDISC_ID=CURRXDISC.ID
  AND
    CURR.CURSO_MIG_ID=CURSO.ID
  AND
    CURROFE.CURR_ID=CURR.ID
  AND
    TURMA.DURACXCI_ID=DURACXCI.ID
  AND
    TURMAOFE.TURMA_ID=TURMA.ID
  AND
    TURMAOFE.CURROFE_ID=CURROFE.ID
  AND
    CURROFE.PLETIVO_ID=PLETIVO.ID
  AND 
    NVL(CHSEMANALPRATICA,0) > 0
  AND
    NVL(CHTOTAL,0) = 0	
  UNION ALL
  SELECT
    TO_CHAR(TURMAOFE.ID)||TO_CHAR(CURSO.ID)||TO_CHAR(CURRXDISC.DISC_ID)||((PLETIVO.SEMANAS*nvl(CHSEMANALTEORIA,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALPRATICA,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALLAB,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALEXERC,0)))||'L'||DIVTURMA_ID AS COD_TURMA_EXT,
    TURMA.CODIGO                                                                         AS NOM_TURMA,
    DURACXCI.SEQUENCIA                                                                   AS NUM_PERIODO,
    'N'                                                                                  AS IND_ESPECIAL,
    'S'                                                                                  AS IND_HORARIO,
    'N'                                                                                  AS IND_EAD,
    NVL(TO_CHAR(HORAAULA.WPESSOA_PROF2_ID),'a definir')                                  AS COD_PROFESSOR_EXT,
    'N'                                                                                  AS IND_PROFESSOR_PRINCIPAL,
    TO_CHAR(PLETIVO.ID)||TO_CHAR(CURSO.CURSONIVEL_ID)                                    AS COD_PERIODO_LETIVO_EXT,
    TO_CHAR(CURSO.ID)                                                                    AS COD_CURSO_EXT,
    DECODE(RECCURSO.HABILITACAO,NULL,DECODE(CURSO.CODIGO,'4003','Sequencial','4017','Sequencial','9999','Bacharelado',MODALIDADE.NOME),CURSO.ID||' '||RECCURSO.HABILITACAO)	AS COD_HABILITACAO_EXT, 
    TO_CHAR(TURMA.CAMPUS_ID)                                                             AS COD_CAMPUS_EXT,
    TO_CHAR(NVL(TURMA.PERIODO_ID,6500000000001))                                         AS COD_TURNO_EXT,
    TO_CHAR(CURSO.ID)||TO_CHAR(CURRXDISC.DISC_ID)||((PLETIVO.SEMANAS*nvl(CHSEMANALTEORIA,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALPRATICA,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALLAB,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALEXERC,0))) AS COD_DISCIPLINA_EXT,
    CURR.CODIGO||PLETIVO.SEMANAS                                                         AS COD_GRD_CURRICULAR_EXT,
    'L'                                                                                  AS COD_TPO_CARGA_HOR_EXT,
    NULL                                                                                 AS DAT_HORARIO,
    SUBSTR(HORARIO_GNRETSEMANA(HORAAULA.HORARIO_ID),-1)                                  AS DIA_SEMANA,
    HORARIO_GSHORAINICIO(HORAAULA.HORARIO_ID)                                            AS HOR_INICIO,
    NULL                                                                                 AS HOR_FIM,
    NULL                                                                                 AS DAT_INICIO_DURACAO,
    NULL                                                                                 AS DAT_FIM_DURACAO,
    NULL                                                                                 AS NUM_CAPACIDADE,
    ALOCAPROF_GSRETSALA( PLETIVO.ID , TURMAOFE.TURMA_ID , TOXCD.CURRXDISC_ID , HORAAULA.DIVTURMA_ID , HORAAULA.ID ) AS DSC_SALA,
    ALOCAPROF_GSRETSALA( PLETIVO.ID , TURMAOFE.TURMA_ID , TOXCD.CURRXDISC_ID , HORAAULA.DIVTURMA_ID , HORAAULA.ID ) AS NUM_SALA,
    NULL AS COD_CURSO_VAG_EXT,
    NULL AS COD_HABILITACAO_VAG_EXT,
    NULL AS COD_CAMPUS_VAG_EXT,
    NULL AS NUM_PERIODO_VAG,
    NULL AS IND_CALOURO,
    NULL AS IND_OUTRAS_CAPTACOES,
    NULL AS IND_PROUNI,
    NULL AS NUM_VAGAS,
    DECODE(HORAAULA.DIVTURMA_ID,NULL,NULL,TO_CHAR(TURMAOFE.ID)||TO_CHAR(CURSO.ID)||TO_CHAR(CURRXDISC.DISC_ID)||((PLETIVO.SEMANAS*nvl(CHSEMANALTEORIA,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALPRATICA,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALLAB,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALEXERC,0)))) AS COD_TURMA_ASSOC_EXT
  FROM
    MODALIDADE,
    HORAAULA,
    RECCURSO,
    CURSO,
    CURR,
    DURACXCI,
    TURMA,
    CURRXDISC,
    CURROFE,
    TURMAOFE,
    PLETIVO,
    TOXCD
  WHERE
    HORAAULA.WPESSOA_PROF2_ID IS NOT NULL
  AND
    RECCURSO.MODALIDADE_ID=MODALIDADE.ID(+)
  AND
    ( PLETIVO.FINAL BETWEEN HORAAULA.DTINICIO AND HORAAULA.DTTERMINO OR HORAAULA.ID IS NULL )  
  AND
    HORAAULA.TOXCD_ID (+)= TOXCD.ID
  AND
    CURSONIVEL_ID NOT IN (6200000000002,6200000000008)
  AND
    RECCURSO.VIGENTE='on'
  AND
    RECCURSO.CAMPUS_ID=TURMA.CAMPUS_ID
  AND
    RECCURSO.CURSO_ID=CURSO.ID
  AND
    TOXCD.TURMAOFE_ID=TURMAOFE.ID
  AND
    TOXCD.CURRXDISC_ID=CURRXDISC.ID
  AND
    CURR.CURSO_MIG_ID=CURSO.ID
  AND
    CURROFE.CURR_ID=CURR.ID
  AND
    TURMA.DURACXCI_ID=DURACXCI.ID
  AND
    TURMAOFE.TURMA_ID=TURMA.ID
  AND
    TURMAOFE.CURROFE_ID=CURROFE.ID
  AND
    CURROFE.PLETIVO_ID=PLETIVO.ID
  AND 
    NVL(CHSEMANALLAB,0) > 0
  AND
    NVL(CHTOTAL,0) = 0	
  UNION ALL
  SELECT
    TO_CHAR(TURMAOFE.ID)||TO_CHAR(CURSO.ID)||TO_CHAR(CURRXDISC.DISC_ID)||((PLETIVO.SEMANAS*nvl(CHSEMANALTEORIA,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALPRATICA,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALLAB,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALEXERC,0)))||'E'||DIVTURMA_ID AS COD_TURMA_EXT,
    TURMA.CODIGO                                                                         AS NOM_TURMA,
    DURACXCI.SEQUENCIA                                                                   AS NUM_PERIODO,
    'N'                                                                                  AS IND_ESPECIAL,
    'S'                                                                                  AS IND_HORARIO,
    'N'                                                                                  AS IND_EAD,
    NVL(TO_CHAR(HORAAULA.WPESSOA_PROF2_ID),'a definir')                                  AS COD_PROFESSOR_EXT,
    'N'                                                                                  AS IND_PROFESSOR_PRINCIPAL,
    TO_CHAR(PLETIVO.ID)||TO_CHAR(CURSO.CURSONIVEL_ID)                                    AS COD_PERIODO_LETIVO_EXT,
    TO_CHAR(CURSO.ID)                                                                    AS COD_CURSO_EXT,
    DECODE(RECCURSO.HABILITACAO,NULL,DECODE(CURSO.CODIGO,'4003','Sequencial','4017','Sequencial','9999','Bacharelado',MODALIDADE.NOME),CURSO.ID||' '||RECCURSO.HABILITACAO)	AS COD_HABILITACAO_EXT, 
    TO_CHAR(TURMA.CAMPUS_ID)                                                             AS COD_CAMPUS_EXT,
    TO_CHAR(NVL(TURMA.PERIODO_ID,6500000000001))                                         AS COD_TURNO_EXT,
    TO_CHAR(CURSO.ID)||TO_CHAR(CURRXDISC.DISC_ID)||((PLETIVO.SEMANAS*nvl(CHSEMANALTEORIA,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALPRATICA,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALLAB,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALEXERC,0))) AS COD_DISCIPLINA_EXT,
    CURR.CODIGO||PLETIVO.SEMANAS                                                         AS COD_GRD_CURRICULAR_EXT,
    'E'                                                                                  AS COD_TPO_CARGA_HOR_EXT,
    NULL                                                                                 AS DAT_HORARIO,
    SUBSTR(HORARIO_GNRETSEMANA(HORAAULA.HORARIO_ID),-1)                                  AS DIA_SEMANA,
    HORARIO_GSHORAINICIO(HORAAULA.HORARIO_ID)                                            AS HOR_INICIO,
    NULL                                                                                 AS HOR_FIM,
    NULL                                                                                 AS DAT_INICIO_DURACAO,
    NULL                                                                                 AS DAT_FIM_DURACAO,
    NULL                                                                                 AS NUM_CAPACIDADE,
    ALOCAPROF_GSRETSALA( PLETIVO.ID , TURMAOFE.TURMA_ID , TOXCD.CURRXDISC_ID , HORAAULA.DIVTURMA_ID , HORAAULA.ID ) AS DSC_SALA,
    ALOCAPROF_GSRETSALA( PLETIVO.ID , TURMAOFE.TURMA_ID , TOXCD.CURRXDISC_ID , HORAAULA.DIVTURMA_ID , HORAAULA.ID ) AS NUM_SALA,
    NULL AS COD_CURSO_VAG_EXT,
    NULL AS COD_HABILITACAO_VAG_EXT,
    NULL AS COD_CAMPUS_VAG_EXT,
    NULL AS NUM_PERIODO_VAG,
    NULL AS IND_CALOURO,
    NULL AS IND_OUTRAS_CAPTACOES,
    NULL AS IND_PROUNI,
    NULL AS NUM_VAGAS,
    DECODE(HORAAULA.DIVTURMA_ID,NULL,NULL,TO_CHAR(TURMAOFE.ID)||TO_CHAR(CURSO.ID)||TO_CHAR(CURRXDISC.DISC_ID)||((PLETIVO.SEMANAS*nvl(CHSEMANALTEORIA,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALPRATICA,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALLAB,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALEXERC,0)))) AS COD_TURMA_ASSOC_EXT
  FROM
    MODALIDADE,
    HORAAULA,
    RECCURSO,
    CURSO,
    CURR,
    DURACXCI,
    TURMA,
    CURRXDISC,
    CURROFE,
    TURMAOFE,
    PLETIVO,
    TOXCD
  WHERE
    HORAAULA.WPESSOA_PROF2_ID IS NOT NULL
  AND
    RECCURSO.MODALIDADE_ID=MODALIDADE.ID(+)
  AND
    ( PLETIVO.FINAL BETWEEN HORAAULA.DTINICIO AND HORAAULA.DTTERMINO OR HORAAULA.ID IS NULL )  
  AND
    HORAAULA.TOXCD_ID (+)= TOXCD.ID
  AND
    CURSONIVEL_ID NOT IN (6200000000002,6200000000008)
  AND
    RECCURSO.VIGENTE='on'
  AND
    RECCURSO.CAMPUS_ID=TURMA.CAMPUS_ID
  AND
    RECCURSO.CURSO_ID=CURSO.ID
  AND
    TOXCD.TURMAOFE_ID=TURMAOFE.ID
  AND
    TOXCD.CURRXDISC_ID=CURRXDISC.ID
  AND
    CURR.CURSO_MIG_ID=CURSO.ID
  AND
    CURROFE.CURR_ID=CURR.ID
  AND
    TURMA.DURACXCI_ID=DURACXCI.ID
  AND
    TURMAOFE.TURMA_ID=TURMA.ID
  AND
    TURMAOFE.CURROFE_ID=CURROFE.ID
  AND
    CURROFE.PLETIVO_ID=PLETIVO.ID
  AND 
    NVL(CHSEMANALEXERC,0) > 0
  AND
    NVL(CHTOTAL,0) = 0		
)  
UNION ALL /* professor 3*/
(
  SELECT
    TO_CHAR(TURMAOFE.ID)||TO_CHAR(CURSO.ID)||TO_CHAR(CURRXDISC.DISC_ID)||((PLETIVO.SEMANAS*nvl(CHSEMANALTEORIA,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALPRATICA,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALLAB,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALEXERC,0)))||'T'||DIVTURMA_ID AS COD_TURMA_EXT,
    TURMA.CODIGO                                                                         AS NOM_TURMA,
    DURACXCI.SEQUENCIA                                                                   AS NUM_PERIODO,
    'N'                                                                                  AS IND_ESPECIAL,
    'S'                                                                                  AS IND_HORARIO,
    'N'                                                                                  AS IND_EAD,
    NVL(TO_CHAR(HORAAULA.WPESSOA_PROF3_ID),'a definir')                                  AS COD_PROFESSOR_EXT,
    'N'                                                                                  AS IND_PROFESSOR_PRINCIPAL,
    TO_CHAR(PLETIVO.ID)||TO_CHAR(CURSO.CURSONIVEL_ID)                                    AS COD_PERIODO_LETIVO_EXT,
    TO_CHAR(CURSO.ID)                                                                    AS COD_CURSO_EXT,
    DECODE(RECCURSO.HABILITACAO,NULL,DECODE(CURSO.CODIGO,'4003','Sequencial','4017','Sequencial','9999','Bacharelado',MODALIDADE.NOME),CURSO.ID||' '||RECCURSO.HABILITACAO)	AS COD_HABILITACAO_EXT, 
    TO_CHAR(TURMA.CAMPUS_ID)                                                             AS COD_CAMPUS_EXT,
    TO_CHAR(NVL(TURMA.PERIODO_ID,6500000000001))                                         AS COD_TURNO_EXT,
    TO_CHAR(CURSO.ID)||TO_CHAR(CURRXDISC.DISC_ID)||((PLETIVO.SEMANAS*nvl(CHSEMANALTEORIA,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALPRATICA,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALLAB,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALEXERC,0))) AS COD_DISCIPLINA_EXT,
    CURR.CODIGO||PLETIVO.SEMANAS                                                         AS COD_GRD_CURRICULAR_EXT,
    'T'                                                                                  AS COD_TPO_CARGA_HOR_EXT,
    NULL                                                                                 AS DAT_HORARIO,
    SUBSTR(HORARIO_GNRETSEMANA(HORAAULA.HORARIO_ID),-1)                                  AS DIA_SEMANA,
    HORARIO_GSHORAINICIO(HORAAULA.HORARIO_ID)                                            AS HOR_INICIO,
    NULL                                                                                 AS HOR_FIM,
    NULL                                                                                 AS DAT_INICIO_DURACAO,
    NULL                                                                                 AS DAT_FIM_DURACAO,
    NULL                                                                                 AS NUM_CAPACIDADE,
    ALOCAPROF_GSRETSALA( PLETIVO.ID , TURMAOFE.TURMA_ID , TOXCD.CURRXDISC_ID , HORAAULA.DIVTURMA_ID , HORAAULA.ID ) AS DSC_SALA,
    ALOCAPROF_GSRETSALA( PLETIVO.ID , TURMAOFE.TURMA_ID , TOXCD.CURRXDISC_ID , HORAAULA.DIVTURMA_ID , HORAAULA.ID ) AS NUM_SALA,
    NULL AS COD_CURSO_VAG_EXT,
    NULL AS COD_HABILITACAO_VAG_EXT,
    NULL AS COD_CAMPUS_VAG_EXT,
    NULL AS NUM_PERIODO_VAG,
    NULL AS IND_CALOURO,
    NULL AS IND_OUTRAS_CAPTACOES,
    NULL AS IND_PROUNI,
    NULL AS NUM_VAGAS,
    DECODE(HORAAULA.DIVTURMA_ID,NULL,NULL,TO_CHAR(TURMAOFE.ID)||TO_CHAR(CURSO.ID)||TO_CHAR(CURRXDISC.DISC_ID)||((PLETIVO.SEMANAS*nvl(CHSEMANALTEORIA,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALPRATICA,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALLAB,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALEXERC,0)))) AS COD_TURMA_ASSOC_EXT
  FROM
    MODALIDADE,
    HORAAULA,
    RECCURSO,
    CURSO,
    CURR,
    DURACXCI,
    TURMA,
    CURRXDISC,
    CURROFE,
    TURMAOFE,
    PLETIVO,
    TOXCD
  WHERE
    HORAAULA.WPESSOA_PROF3_ID IS NOT NULL
  AND
    RECCURSO.MODALIDADE_ID=MODALIDADE.ID(+)
  AND
    ( PLETIVO.FINAL BETWEEN HORAAULA.DTINICIO AND HORAAULA.DTTERMINO OR HORAAULA.ID IS NULL )  
  AND
    HORAAULA.TOXCD_ID (+)= TOXCD.ID
  AND
    CURSONIVEL_ID NOT IN (6200000000002,6200000000008)
  AND
    RECCURSO.VIGENTE='on'
  AND
    RECCURSO.CAMPUS_ID=TURMA.CAMPUS_ID
  AND
    RECCURSO.CURSO_ID=CURSO.ID
  AND
    TOXCD.TURMAOFE_ID=TURMAOFE.ID
  AND
    TOXCD.CURRXDISC_ID=CURRXDISC.ID
  AND
    CURR.CURSO_MIG_ID=CURSO.ID
  AND
    CURROFE.CURR_ID=CURR.ID
  AND
    TURMA.DURACXCI_ID=DURACXCI.ID
  AND
    TURMAOFE.TURMA_ID=TURMA.ID
  AND
    TURMAOFE.CURROFE_ID=CURROFE.ID
  AND
    CURROFE.PLETIVO_ID=PLETIVO.ID
  AND 
    NVL(CHSEMANALTEORIA,0) > 0
  AND
    NVL(CHTOTAL,0) = 0
  UNION ALL
  SELECT
    TO_CHAR(TURMAOFE.ID)||TO_CHAR(CURSO.ID)||TO_CHAR(CURRXDISC.DISC_ID)||((PLETIVO.SEMANAS*nvl(CHSEMANALTEORIA,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALPRATICA,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALLAB,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALEXERC,0)))||'P'||DIVTURMA_ID AS COD_TURMA_EXT,
    TURMA.CODIGO                                                                         AS NOM_TURMA,
    DURACXCI.SEQUENCIA                                                                   AS NUM_PERIODO,
    'N'                                                                                  AS IND_ESPECIAL,
    'S'                                                                                  AS IND_HORARIO,
    'N'                                                                                  AS IND_EAD,
    NVL(TO_CHAR(HORAAULA.WPESSOA_PROF3_ID),'a definir')                                  AS COD_PROFESSOR_EXT,
    'N'                                                                                  AS IND_PROFESSOR_PRINCIPAL,
    TO_CHAR(PLETIVO.ID)||TO_CHAR(CURSO.CURSONIVEL_ID)                                    AS COD_PERIODO_LETIVO_EXT,
    TO_CHAR(CURSO.ID)                                                                    AS COD_CURSO_EXT,
    DECODE(RECCURSO.HABILITACAO,NULL,DECODE(CURSO.CODIGO,'4003','Sequencial','4017','Sequencial','9999','Bacharelado',MODALIDADE.NOME),CURSO.ID||' '||RECCURSO.HABILITACAO)	AS COD_HABILITACAO_EXT, 
    TO_CHAR(TURMA.CAMPUS_ID)                                                             AS COD_CAMPUS_EXT,
    TO_CHAR(NVL(TURMA.PERIODO_ID,6500000000001))                                         AS COD_TURNO_EXT,
    TO_CHAR(CURSO.ID)||TO_CHAR(CURRXDISC.DISC_ID)||((PLETIVO.SEMANAS*nvl(CHSEMANALTEORIA,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALPRATICA,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALLAB,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALEXERC,0))) AS COD_DISCIPLINA_EXT,
    CURR.CODIGO||PLETIVO.SEMANAS                                                         AS COD_GRD_CURRICULAR_EXT,
    'P'                                                                                  AS COD_TPO_CARGA_HOR_EXT,
    NULL                                                                                 AS DAT_HORARIO,
    SUBSTR(HORARIO_GNRETSEMANA(HORAAULA.HORARIO_ID),-1)                                  AS DIA_SEMANA,
    HORARIO_GSHORAINICIO(HORAAULA.HORARIO_ID)                                            AS HOR_INICIO,
    NULL                                                                                 AS HOR_FIM,
    NULL                                                                                 AS DAT_INICIO_DURACAO,
    NULL                                                                                 AS DAT_FIM_DURACAO,
    NULL                                                                                 AS NUM_CAPACIDADE,
    ALOCAPROF_GSRETSALA( PLETIVO.ID , TURMAOFE.TURMA_ID , TOXCD.CURRXDISC_ID , HORAAULA.DIVTURMA_ID , HORAAULA.ID ) AS DSC_SALA,
    ALOCAPROF_GSRETSALA( PLETIVO.ID , TURMAOFE.TURMA_ID , TOXCD.CURRXDISC_ID , HORAAULA.DIVTURMA_ID , HORAAULA.ID ) AS NUM_SALA,
    NULL AS COD_CURSO_VAG_EXT,
    NULL AS COD_HABILITACAO_VAG_EXT,
    NULL AS COD_CAMPUS_VAG_EXT,
    NULL AS NUM_PERIODO_VAG,
    NULL AS IND_CALOURO,
    NULL AS IND_OUTRAS_CAPTACOES,
    NULL AS IND_PROUNI,
    NULL AS NUM_VAGAS,
    DECODE(HORAAULA.DIVTURMA_ID,NULL,NULL,TO_CHAR(TURMAOFE.ID)||TO_CHAR(CURSO.ID)||TO_CHAR(CURRXDISC.DISC_ID)||((PLETIVO.SEMANAS*nvl(CHSEMANALTEORIA,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALPRATICA,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALLAB,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALEXERC,0)))) AS COD_TURMA_ASSOC_EXT
  FROM
    MODALIDADE,
    HORAAULA,
    RECCURSO,
    CURSO,
    CURR,
    DURACXCI,
    TURMA,
    CURRXDISC,
    CURROFE,
    TURMAOFE,
    PLETIVO,
    TOXCD
  WHERE
    HORAAULA.WPESSOA_PROF3_ID IS NOT NULL
  AND
    RECCURSO.MODALIDADE_ID=MODALIDADE.ID(+)
  AND
    ( PLETIVO.FINAL BETWEEN HORAAULA.DTINICIO AND HORAAULA.DTTERMINO OR HORAAULA.ID IS NULL )  
  AND
    HORAAULA.TOXCD_ID (+)= TOXCD.ID
  AND
    CURSONIVEL_ID NOT IN (6200000000002,6200000000008)
  AND
    RECCURSO.VIGENTE='on'
  AND
    RECCURSO.CAMPUS_ID=TURMA.CAMPUS_ID
  AND
    RECCURSO.CURSO_ID=CURSO.ID
  AND
    TOXCD.TURMAOFE_ID=TURMAOFE.ID
  AND
    TOXCD.CURRXDISC_ID=CURRXDISC.ID
  AND
    CURR.CURSO_MIG_ID=CURSO.ID
  AND
    CURROFE.CURR_ID=CURR.ID
  AND
    TURMA.DURACXCI_ID=DURACXCI.ID
  AND
    TURMAOFE.TURMA_ID=TURMA.ID
  AND
    TURMAOFE.CURROFE_ID=CURROFE.ID
  AND
    CURROFE.PLETIVO_ID=PLETIVO.ID
  AND 
    NVL(CHSEMANALPRATICA,0) > 0
  AND
    NVL(CHTOTAL,0) = 0	
  UNION ALL
  SELECT
    TO_CHAR(TURMAOFE.ID)||TO_CHAR(CURSO.ID)||TO_CHAR(CURRXDISC.DISC_ID)||((PLETIVO.SEMANAS*nvl(CHSEMANALTEORIA,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALPRATICA,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALLAB,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALEXERC,0)))||'L'||DIVTURMA_ID AS COD_TURMA_EXT,
    TURMA.CODIGO                                                                         AS NOM_TURMA,
    DURACXCI.SEQUENCIA                                                                   AS NUM_PERIODO,
    'N'                                                                                  AS IND_ESPECIAL,
    'S'                                                                                  AS IND_HORARIO,
    'N'                                                                                  AS IND_EAD,
    NVL(TO_CHAR(HORAAULA.WPESSOA_PROF3_ID),'a definir')                                  AS COD_PROFESSOR_EXT,
    'N'                                                                                  AS IND_PROFESSOR_PRINCIPAL,
    TO_CHAR(PLETIVO.ID)||TO_CHAR(CURSO.CURSONIVEL_ID)                                    AS COD_PERIODO_LETIVO_EXT,
    TO_CHAR(CURSO.ID)                                                                    AS COD_CURSO_EXT,
    DECODE(RECCURSO.HABILITACAO,NULL,DECODE(CURSO.CODIGO,'4003','Sequencial','4017','Sequencial','9999','Bacharelado',MODALIDADE.NOME),CURSO.ID||' '||RECCURSO.HABILITACAO)	AS COD_HABILITACAO_EXT, 
    TO_CHAR(TURMA.CAMPUS_ID)                                                             AS COD_CAMPUS_EXT,
    TO_CHAR(NVL(TURMA.PERIODO_ID,6500000000001))                                         AS COD_TURNO_EXT,
    TO_CHAR(CURSO.ID)||TO_CHAR(CURRXDISC.DISC_ID)||((PLETIVO.SEMANAS*nvl(CHSEMANALTEORIA,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALPRATICA,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALLAB,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALEXERC,0))) AS COD_DISCIPLINA_EXT,
    CURR.CODIGO||PLETIVO.SEMANAS                                                         AS COD_GRD_CURRICULAR_EXT,
    'L'                                                                                  AS COD_TPO_CARGA_HOR_EXT,
    NULL                                                                                 AS DAT_HORARIO,
    SUBSTR(HORARIO_GNRETSEMANA(HORAAULA.HORARIO_ID),-1)                                  AS DIA_SEMANA,
    HORARIO_GSHORAINICIO(HORAAULA.HORARIO_ID)                                            AS HOR_INICIO,
    NULL                                                                                 AS HOR_FIM,
    NULL                                                                                 AS DAT_INICIO_DURACAO,
    NULL                                                                                 AS DAT_FIM_DURACAO,
    NULL                                                                                 AS NUM_CAPACIDADE,
    ALOCAPROF_GSRETSALA( PLETIVO.ID , TURMAOFE.TURMA_ID , TOXCD.CURRXDISC_ID , HORAAULA.DIVTURMA_ID , HORAAULA.ID ) AS DSC_SALA,
    ALOCAPROF_GSRETSALA( PLETIVO.ID , TURMAOFE.TURMA_ID , TOXCD.CURRXDISC_ID , HORAAULA.DIVTURMA_ID , HORAAULA.ID ) AS NUM_SALA,
    NULL AS COD_CURSO_VAG_EXT,
    NULL AS COD_HABILITACAO_VAG_EXT,
    NULL AS COD_CAMPUS_VAG_EXT,
    NULL AS NUM_PERIODO_VAG,
    NULL AS IND_CALOURO,
    NULL AS IND_OUTRAS_CAPTACOES,
    NULL AS IND_PROUNI,
    NULL AS NUM_VAGAS,
    DECODE(HORAAULA.DIVTURMA_ID,NULL,NULL,TO_CHAR(TURMAOFE.ID)||TO_CHAR(CURSO.ID)||TO_CHAR(CURRXDISC.DISC_ID)||((PLETIVO.SEMANAS*nvl(CHSEMANALTEORIA,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALPRATICA,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALLAB,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALEXERC,0)))) AS COD_TURMA_ASSOC_EXT
  FROM
    MODALIDADE,
    HORAAULA,
    RECCURSO,
    CURSO,
    CURR,
    DURACXCI,
    TURMA,
    CURRXDISC,
    CURROFE,
    TURMAOFE,
    PLETIVO,
    TOXCD
  WHERE
    HORAAULA.WPESSOA_PROF3_ID IS NOT NULL
  AND
    RECCURSO.MODALIDADE_ID=MODALIDADE.ID(+)
  AND
    ( PLETIVO.FINAL BETWEEN HORAAULA.DTINICIO AND HORAAULA.DTTERMINO OR HORAAULA.ID IS NULL )  
  AND
    HORAAULA.TOXCD_ID (+)= TOXCD.ID
  AND
    CURSONIVEL_ID NOT IN (6200000000002,6200000000008)
  AND
    RECCURSO.VIGENTE='on'
  AND
    RECCURSO.CAMPUS_ID=TURMA.CAMPUS_ID
  AND
    RECCURSO.CURSO_ID=CURSO.ID
  AND
    TOXCD.TURMAOFE_ID=TURMAOFE.ID
  AND
    TOXCD.CURRXDISC_ID=CURRXDISC.ID
  AND
    CURR.CURSO_MIG_ID=CURSO.ID
  AND
    CURROFE.CURR_ID=CURR.ID
  AND
    TURMA.DURACXCI_ID=DURACXCI.ID
  AND
    TURMAOFE.TURMA_ID=TURMA.ID
  AND
    TURMAOFE.CURROFE_ID=CURROFE.ID
  AND
    CURROFE.PLETIVO_ID=PLETIVO.ID
  AND 
    NVL(CHSEMANALLAB,0) > 0
  AND
    NVL(CHTOTAL,0) = 0	
  UNION ALL
  SELECT
    TO_CHAR(TURMAOFE.ID)||TO_CHAR(CURSO.ID)||TO_CHAR(CURRXDISC.DISC_ID)||((PLETIVO.SEMANAS*nvl(CHSEMANALTEORIA,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALPRATICA,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALLAB,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALEXERC,0)))||'E'||DIVTURMA_ID AS COD_TURMA_EXT,
    TURMA.CODIGO                                                                         AS NOM_TURMA,
    DURACXCI.SEQUENCIA                                                                   AS NUM_PERIODO,
    'N'                                                                                  AS IND_ESPECIAL,
    'S'                                                                                  AS IND_HORARIO,
    'N'                                                                                  AS IND_EAD,
    NVL(TO_CHAR(HORAAULA.WPESSOA_PROF3_ID),'a definir')                                  AS COD_PROFESSOR_EXT,
    'N'                                                                                  AS IND_PROFESSOR_PRINCIPAL,
    TO_CHAR(PLETIVO.ID)||TO_CHAR(CURSO.CURSONIVEL_ID)                                    AS COD_PERIODO_LETIVO_EXT,
    TO_CHAR(CURSO.ID)                                                                    AS COD_CURSO_EXT,
    DECODE(RECCURSO.HABILITACAO,NULL,DECODE(CURSO.CODIGO,'4003','Sequencial','4017','Sequencial','9999','Bacharelado',MODALIDADE.NOME),CURSO.ID||' '||RECCURSO.HABILITACAO)	AS COD_HABILITACAO_EXT, 
    TO_CHAR(TURMA.CAMPUS_ID)                                                             AS COD_CAMPUS_EXT,
    TO_CHAR(NVL(TURMA.PERIODO_ID,6500000000001))                                         AS COD_TURNO_EXT,
    TO_CHAR(CURSO.ID)||TO_CHAR(CURRXDISC.DISC_ID)||((PLETIVO.SEMANAS*nvl(CHSEMANALTEORIA,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALPRATICA,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALLAB,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALEXERC,0))) AS COD_DISCIPLINA_EXT,
    CURR.CODIGO||PLETIVO.SEMANAS                                                         AS COD_GRD_CURRICULAR_EXT,
    'E'                                                                                  AS COD_TPO_CARGA_HOR_EXT,
    NULL                                                                                 AS DAT_HORARIO,
    SUBSTR(HORARIO_GNRETSEMANA(HORAAULA.HORARIO_ID),-1)                                  AS DIA_SEMANA,
    HORARIO_GSHORAINICIO(HORAAULA.HORARIO_ID)                                            AS HOR_INICIO,
    NULL                                                                                 AS HOR_FIM,
    NULL                                                                                 AS DAT_INICIO_DURACAO,
    NULL                                                                                 AS DAT_FIM_DURACAO,
    NULL                                                                                 AS NUM_CAPACIDADE,
    ALOCAPROF_GSRETSALA( PLETIVO.ID , TURMAOFE.TURMA_ID , TOXCD.CURRXDISC_ID , HORAAULA.DIVTURMA_ID , HORAAULA.ID ) AS DSC_SALA,
    ALOCAPROF_GSRETSALA( PLETIVO.ID , TURMAOFE.TURMA_ID , TOXCD.CURRXDISC_ID , HORAAULA.DIVTURMA_ID , HORAAULA.ID ) AS NUM_SALA,
    NULL AS COD_CURSO_VAG_EXT,
    NULL AS COD_HABILITACAO_VAG_EXT,
    NULL AS COD_CAMPUS_VAG_EXT,
    NULL AS NUM_PERIODO_VAG,
    NULL AS IND_CALOURO,
    NULL AS IND_OUTRAS_CAPTACOES,
    NULL AS IND_PROUNI,
    NULL AS NUM_VAGAS,
    DECODE(HORAAULA.DIVTURMA_ID,NULL,NULL,TO_CHAR(TURMAOFE.ID)||TO_CHAR(CURSO.ID)||TO_CHAR(CURRXDISC.DISC_ID)||((PLETIVO.SEMANAS*nvl(CHSEMANALTEORIA,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALPRATICA,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALLAB,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALEXERC,0)))) AS COD_TURMA_ASSOC_EXT
  FROM
    MODALIDADE,
    HORAAULA,
    RECCURSO,
    CURSO,
    CURR,
    DURACXCI,
    TURMA,
    CURRXDISC,
    CURROFE,
    TURMAOFE,
    PLETIVO,
    TOXCD
  WHERE
    HORAAULA.WPESSOA_PROF3_ID IS NOT NULL
  AND
    RECCURSO.MODALIDADE_ID=MODALIDADE.ID(+)
  AND
    ( PLETIVO.FINAL BETWEEN HORAAULA.DTINICIO AND HORAAULA.DTTERMINO OR HORAAULA.ID IS NULL )  
  AND
    HORAAULA.TOXCD_ID (+)= TOXCD.ID
  AND
    CURSONIVEL_ID NOT IN (6200000000002,6200000000008)
  AND
    RECCURSO.VIGENTE='on'
  AND
    RECCURSO.CAMPUS_ID=TURMA.CAMPUS_ID
  AND
    RECCURSO.CURSO_ID=CURSO.ID
  AND
    TOXCD.TURMAOFE_ID=TURMAOFE.ID
  AND
    TOXCD.CURRXDISC_ID=CURRXDISC.ID
  AND
    CURR.CURSO_MIG_ID=CURSO.ID
  AND
    CURROFE.CURR_ID=CURR.ID
  AND
    TURMA.DURACXCI_ID=DURACXCI.ID
  AND
    TURMAOFE.TURMA_ID=TURMA.ID
  AND
    TURMAOFE.CURROFE_ID=CURROFE.ID
  AND
    CURROFE.PLETIVO_ID=PLETIVO.ID
  AND 
    NVL(CHSEMANALEXERC,0) > 0
  AND
    NVL(CHTOTAL,0) = 0		
)  
UNION ALL /* professor 4*/
(
  SELECT
    TO_CHAR(TURMAOFE.ID)||TO_CHAR(CURSO.ID)||TO_CHAR(CURRXDISC.DISC_ID)||((PLETIVO.SEMANAS*nvl(CHSEMANALTEORIA,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALPRATICA,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALLAB,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALEXERC,0)))||'T'||DIVTURMA_ID AS COD_TURMA_EXT,
    TURMA.CODIGO                                                                         AS NOM_TURMA,
    DURACXCI.SEQUENCIA                                                                   AS NUM_PERIODO,
    'N'                                                                                  AS IND_ESPECIAL,
    'S'                                                                                  AS IND_HORARIO,
    'N'                                                                                  AS IND_EAD,
    NVL(TO_CHAR(HORAAULA.WPESSOA_PROF4_ID),'a definir')                                  AS COD_PROFESSOR_EXT,
    'N'                                                                                  AS IND_PROFESSOR_PRINCIPAL,
    TO_CHAR(PLETIVO.ID)||TO_CHAR(CURSO.CURSONIVEL_ID)                                    AS COD_PERIODO_LETIVO_EXT,
    TO_CHAR(CURSO.ID)                                                                    AS COD_CURSO_EXT,
    DECODE(RECCURSO.HABILITACAO,NULL,DECODE(CURSO.CODIGO,'4003','Sequencial','4017','Sequencial','9999','Bacharelado',MODALIDADE.NOME),CURSO.ID||' '||RECCURSO.HABILITACAO)	AS COD_HABILITACAO_EXT, 
    TO_CHAR(TURMA.CAMPUS_ID)                                                             AS COD_CAMPUS_EXT,
    TO_CHAR(NVL(TURMA.PERIODO_ID,6500000000001))                                         AS COD_TURNO_EXT,
    TO_CHAR(CURSO.ID)||TO_CHAR(CURRXDISC.DISC_ID)||((PLETIVO.SEMANAS*nvl(CHSEMANALTEORIA,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALPRATICA,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALLAB,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALEXERC,0))) AS COD_DISCIPLINA_EXT,
    CURR.CODIGO||PLETIVO.SEMANAS                                                         AS COD_GRD_CURRICULAR_EXT,
    'T'                                                                                  AS COD_TPO_CARGA_HOR_EXT,
    NULL                                                                                 AS DAT_HORARIO,
    SUBSTR(HORARIO_GNRETSEMANA(HORAAULA.HORARIO_ID),-1)                                  AS DIA_SEMANA,
    HORARIO_GSHORAINICIO(HORAAULA.HORARIO_ID)                                            AS HOR_INICIO,
    NULL                                                                                 AS HOR_FIM,
    NULL                                                                                 AS DAT_INICIO_DURACAO,
    NULL                                                                                 AS DAT_FIM_DURACAO,
    NULL                                                                                 AS NUM_CAPACIDADE,
    ALOCAPROF_GSRETSALA( PLETIVO.ID , TURMAOFE.TURMA_ID , TOXCD.CURRXDISC_ID , HORAAULA.DIVTURMA_ID , HORAAULA.ID ) AS DSC_SALA,
    ALOCAPROF_GSRETSALA( PLETIVO.ID , TURMAOFE.TURMA_ID , TOXCD.CURRXDISC_ID , HORAAULA.DIVTURMA_ID , HORAAULA.ID ) AS NUM_SALA,
    NULL AS COD_CURSO_VAG_EXT,
    NULL AS COD_HABILITACAO_VAG_EXT,
    NULL AS COD_CAMPUS_VAG_EXT,
    NULL AS NUM_PERIODO_VAG,
    NULL AS IND_CALOURO,
    NULL AS IND_OUTRAS_CAPTACOES,
    NULL AS IND_PROUNI,
    NULL AS NUM_VAGAS,
    DECODE(HORAAULA.DIVTURMA_ID,NULL,NULL,TO_CHAR(TURMAOFE.ID)||TO_CHAR(CURSO.ID)||TO_CHAR(CURRXDISC.DISC_ID)||((PLETIVO.SEMANAS*nvl(CHSEMANALTEORIA,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALPRATICA,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALLAB,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALEXERC,0)))) AS COD_TURMA_ASSOC_EXT
  FROM
    MODALIDADE,
    HORAAULA,
    RECCURSO,
    CURSO,
    CURR,
    DURACXCI,
    TURMA,
    CURRXDISC,
    CURROFE,
    TURMAOFE,
    PLETIVO,
    TOXCD
  WHERE
    HORAAULA.WPESSOA_PROF4_ID IS NOT NULL
  AND
    RECCURSO.MODALIDADE_ID=MODALIDADE.ID(+)
  AND
    ( PLETIVO.FINAL BETWEEN HORAAULA.DTINICIO AND HORAAULA.DTTERMINO OR HORAAULA.ID IS NULL )  
  AND
    HORAAULA.TOXCD_ID (+)= TOXCD.ID
  AND
    CURSONIVEL_ID NOT IN (6200000000002,6200000000008)
  AND
    RECCURSO.VIGENTE='on'
  AND
    RECCURSO.CAMPUS_ID=TURMA.CAMPUS_ID
  AND
    RECCURSO.CURSO_ID=CURSO.ID
  AND
    TOXCD.TURMAOFE_ID=TURMAOFE.ID
  AND
    TOXCD.CURRXDISC_ID=CURRXDISC.ID
  AND
    CURR.CURSO_MIG_ID=CURSO.ID
  AND
    CURROFE.CURR_ID=CURR.ID
  AND
    TURMA.DURACXCI_ID=DURACXCI.ID
  AND
    TURMAOFE.TURMA_ID=TURMA.ID
  AND
    TURMAOFE.CURROFE_ID=CURROFE.ID
  AND
    CURROFE.PLETIVO_ID=PLETIVO.ID
  AND 
    NVL(CHSEMANALTEORIA,0) > 0
  AND
    NVL(CHTOTAL,0) = 0
  UNION ALL
  SELECT
    TO_CHAR(TURMAOFE.ID)||TO_CHAR(CURSO.ID)||TO_CHAR(CURRXDISC.DISC_ID)||((PLETIVO.SEMANAS*nvl(CHSEMANALTEORIA,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALPRATICA,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALLAB,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALEXERC,0)))||'P'||DIVTURMA_ID AS COD_TURMA_EXT,
    TURMA.CODIGO                                                                         AS NOM_TURMA,
    DURACXCI.SEQUENCIA                                                                   AS NUM_PERIODO,
    'N'                                                                                  AS IND_ESPECIAL,
    'S'                                                                                  AS IND_HORARIO,
    'N'                                                                                  AS IND_EAD,
    NVL(TO_CHAR(HORAAULA.WPESSOA_PROF4_ID),'a definir')                                  AS COD_PROFESSOR_EXT,
    'N'                                                                                  AS IND_PROFESSOR_PRINCIPAL,
    TO_CHAR(PLETIVO.ID)||TO_CHAR(CURSO.CURSONIVEL_ID)                                    AS COD_PERIODO_LETIVO_EXT,
    TO_CHAR(CURSO.ID)                                                                    AS COD_CURSO_EXT,
    DECODE(RECCURSO.HABILITACAO,NULL,DECODE(CURSO.CODIGO,'4003','Sequencial','4017','Sequencial','9999','Bacharelado',MODALIDADE.NOME),CURSO.ID||' '||RECCURSO.HABILITACAO)	AS COD_HABILITACAO_EXT, 
    TO_CHAR(TURMA.CAMPUS_ID)                                                             AS COD_CAMPUS_EXT,
    TO_CHAR(NVL(TURMA.PERIODO_ID,6500000000001))                                         AS COD_TURNO_EXT,
    TO_CHAR(CURSO.ID)||TO_CHAR(CURRXDISC.DISC_ID)||((PLETIVO.SEMANAS*nvl(CHSEMANALTEORIA,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALPRATICA,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALLAB,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALEXERC,0))) AS COD_DISCIPLINA_EXT,
    CURR.CODIGO||PLETIVO.SEMANAS                                                         AS COD_GRD_CURRICULAR_EXT,
    'P'                                                                                  AS COD_TPO_CARGA_HOR_EXT,
    NULL                                                                                 AS DAT_HORARIO,
    SUBSTR(HORARIO_GNRETSEMANA(HORAAULA.HORARIO_ID),-1)                                  AS DIA_SEMANA,
    HORARIO_GSHORAINICIO(HORAAULA.HORARIO_ID)                                            AS HOR_INICIO,
    NULL                                                                                 AS HOR_FIM,
    NULL                                                                                 AS DAT_INICIO_DURACAO,
    NULL                                                                                 AS DAT_FIM_DURACAO,
    NULL                                                                                 AS NUM_CAPACIDADE,
    ALOCAPROF_GSRETSALA( PLETIVO.ID , TURMAOFE.TURMA_ID , TOXCD.CURRXDISC_ID , HORAAULA.DIVTURMA_ID , HORAAULA.ID ) AS DSC_SALA,
    ALOCAPROF_GSRETSALA( PLETIVO.ID , TURMAOFE.TURMA_ID , TOXCD.CURRXDISC_ID , HORAAULA.DIVTURMA_ID , HORAAULA.ID ) AS NUM_SALA,
    NULL AS COD_CURSO_VAG_EXT,
    NULL AS COD_HABILITACAO_VAG_EXT,
    NULL AS COD_CAMPUS_VAG_EXT,
    NULL AS NUM_PERIODO_VAG,
    NULL AS IND_CALOURO,
    NULL AS IND_OUTRAS_CAPTACOES,
    NULL AS IND_PROUNI,
    NULL AS NUM_VAGAS,
    DECODE(HORAAULA.DIVTURMA_ID,NULL,NULL,TO_CHAR(TURMAOFE.ID)||TO_CHAR(CURSO.ID)||TO_CHAR(CURRXDISC.DISC_ID)||((PLETIVO.SEMANAS*nvl(CHSEMANALTEORIA,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALPRATICA,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALLAB,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALEXERC,0)))) AS COD_TURMA_ASSOC_EXT
  FROM
    MODALIDADE,
    HORAAULA,
    RECCURSO,
    CURSO,
    CURR,
    DURACXCI,
    TURMA,
    CURRXDISC,
    CURROFE,
    TURMAOFE,
    PLETIVO,
    TOXCD
  WHERE
    HORAAULA.WPESSOA_PROF4_ID IS NOT NULL
  AND
    RECCURSO.MODALIDADE_ID=MODALIDADE.ID(+)
  AND
    ( PLETIVO.FINAL BETWEEN HORAAULA.DTINICIO AND HORAAULA.DTTERMINO OR HORAAULA.ID IS NULL )  
  AND
    HORAAULA.TOXCD_ID (+)= TOXCD.ID
  AND
    CURSONIVEL_ID NOT IN (6200000000002,6200000000008)
  AND
    RECCURSO.VIGENTE='on'
  AND
    RECCURSO.CAMPUS_ID=TURMA.CAMPUS_ID
  AND
    RECCURSO.CURSO_ID=CURSO.ID
  AND
    TOXCD.TURMAOFE_ID=TURMAOFE.ID
  AND
    TOXCD.CURRXDISC_ID=CURRXDISC.ID
  AND
    CURR.CURSO_MIG_ID=CURSO.ID
  AND
    CURROFE.CURR_ID=CURR.ID
  AND
    TURMA.DURACXCI_ID=DURACXCI.ID
  AND
    TURMAOFE.TURMA_ID=TURMA.ID
  AND
    TURMAOFE.CURROFE_ID=CURROFE.ID
  AND
    CURROFE.PLETIVO_ID=PLETIVO.ID
  AND 
    NVL(CHSEMANALPRATICA,0) > 0
  AND
    NVL(CHTOTAL,0) = 0	
  UNION ALL
  SELECT
    TO_CHAR(TURMAOFE.ID)||TO_CHAR(CURSO.ID)||TO_CHAR(CURRXDISC.DISC_ID)||((PLETIVO.SEMANAS*nvl(CHSEMANALTEORIA,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALPRATICA,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALLAB,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALEXERC,0)))||'L'||DIVTURMA_ID AS COD_TURMA_EXT,
    TURMA.CODIGO                                                                         AS NOM_TURMA,
    DURACXCI.SEQUENCIA                                                                   AS NUM_PERIODO,
    'N'                                                                                  AS IND_ESPECIAL,
    'S'                                                                                  AS IND_HORARIO,
    'N'                                                                                  AS IND_EAD,
    NVL(TO_CHAR(HORAAULA.WPESSOA_PROF4_ID),'a definir')                                  AS COD_PROFESSOR_EXT,
    'N'                                                                                  AS IND_PROFESSOR_PRINCIPAL,
    TO_CHAR(PLETIVO.ID)||TO_CHAR(CURSO.CURSONIVEL_ID)                                    AS COD_PERIODO_LETIVO_EXT,
    TO_CHAR(CURSO.ID)                                                                    AS COD_CURSO_EXT,
    DECODE(RECCURSO.HABILITACAO,NULL,DECODE(CURSO.CODIGO,'4003','Sequencial','4017','Sequencial','9999','Bacharelado',MODALIDADE.NOME),CURSO.ID||' '||RECCURSO.HABILITACAO)	AS COD_HABILITACAO_EXT, 
    TO_CHAR(TURMA.CAMPUS_ID)                                                             AS COD_CAMPUS_EXT,
    TO_CHAR(NVL(TURMA.PERIODO_ID,6500000000001))                                         AS COD_TURNO_EXT,
    TO_CHAR(CURSO.ID)||TO_CHAR(CURRXDISC.DISC_ID)||((PLETIVO.SEMANAS*nvl(CHSEMANALTEORIA,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALPRATICA,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALLAB,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALEXERC,0))) AS COD_DISCIPLINA_EXT,
    CURR.CODIGO||PLETIVO.SEMANAS                                                         AS COD_GRD_CURRICULAR_EXT,
    'L'                                                                                  AS COD_TPO_CARGA_HOR_EXT,
    NULL                                                                                 AS DAT_HORARIO,
    SUBSTR(HORARIO_GNRETSEMANA(HORAAULA.HORARIO_ID),-1)                                  AS DIA_SEMANA,
    HORARIO_GSHORAINICIO(HORAAULA.HORARIO_ID)                                            AS HOR_INICIO,
    NULL                                                                                 AS HOR_FIM,
    NULL                                                                                 AS DAT_INICIO_DURACAO,
    NULL                                                                                 AS DAT_FIM_DURACAO,
    NULL                                                                                 AS NUM_CAPACIDADE,
    ALOCAPROF_GSRETSALA( PLETIVO.ID , TURMAOFE.TURMA_ID , TOXCD.CURRXDISC_ID , HORAAULA.DIVTURMA_ID , HORAAULA.ID ) AS DSC_SALA,
    ALOCAPROF_GSRETSALA( PLETIVO.ID , TURMAOFE.TURMA_ID , TOXCD.CURRXDISC_ID , HORAAULA.DIVTURMA_ID , HORAAULA.ID ) AS NUM_SALA,
    NULL AS COD_CURSO_VAG_EXT,
    NULL AS COD_HABILITACAO_VAG_EXT,
    NULL AS COD_CAMPUS_VAG_EXT,
    NULL AS NUM_PERIODO_VAG,
    NULL AS IND_CALOURO,
    NULL AS IND_OUTRAS_CAPTACOES,
    NULL AS IND_PROUNI,
    NULL AS NUM_VAGAS,
    DECODE(HORAAULA.DIVTURMA_ID,NULL,NULL,TO_CHAR(TURMAOFE.ID)||TO_CHAR(CURSO.ID)||TO_CHAR(CURRXDISC.DISC_ID)||((PLETIVO.SEMANAS*nvl(CHSEMANALTEORIA,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALPRATICA,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALLAB,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALEXERC,0)))) AS COD_TURMA_ASSOC_EXT
  FROM
    MODALIDADE,
    HORAAULA,
    RECCURSO,
    CURSO,
    CURR,
    DURACXCI,
    TURMA,
    CURRXDISC,
    CURROFE,
    TURMAOFE,
    PLETIVO,
    TOXCD
  WHERE
    HORAAULA.WPESSOA_PROF4_ID IS NOT NULL
  AND
    RECCURSO.MODALIDADE_ID=MODALIDADE.ID(+)
  AND
    ( PLETIVO.FINAL BETWEEN HORAAULA.DTINICIO AND HORAAULA.DTTERMINO OR HORAAULA.ID IS NULL )  
  AND
    HORAAULA.TOXCD_ID (+)= TOXCD.ID
  AND
    CURSONIVEL_ID NOT IN (6200000000002,6200000000008)
  AND
    RECCURSO.VIGENTE='on'
  AND
    RECCURSO.CAMPUS_ID=TURMA.CAMPUS_ID
  AND
    RECCURSO.CURSO_ID=CURSO.ID
  AND
    TOXCD.TURMAOFE_ID=TURMAOFE.ID
  AND
    TOXCD.CURRXDISC_ID=CURRXDISC.ID
  AND
    CURR.CURSO_MIG_ID=CURSO.ID
  AND
    CURROFE.CURR_ID=CURR.ID
  AND
    TURMA.DURACXCI_ID=DURACXCI.ID
  AND
    TURMAOFE.TURMA_ID=TURMA.ID
  AND
    TURMAOFE.CURROFE_ID=CURROFE.ID
  AND
    CURROFE.PLETIVO_ID=PLETIVO.ID
  AND 
    NVL(CHSEMANALLAB,0) > 0
  AND
    NVL(CHTOTAL,0) = 0	
  UNION ALL
  SELECT
    TO_CHAR(TURMAOFE.ID)||TO_CHAR(CURSO.ID)||TO_CHAR(CURRXDISC.DISC_ID)||((PLETIVO.SEMANAS*nvl(CHSEMANALTEORIA,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALPRATICA,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALLAB,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALEXERC,0)))||'E'||DIVTURMA_ID AS COD_TURMA_EXT,
    TURMA.CODIGO                                                                         AS NOM_TURMA,
    DURACXCI.SEQUENCIA                                                                   AS NUM_PERIODO,
    'N'                                                                                  AS IND_ESPECIAL,
    'S'                                                                                  AS IND_HORARIO,
    'N'                                                                                  AS IND_EAD,
    NVL(TO_CHAR(HORAAULA.WPESSOA_PROF4_ID),'a definir')                                  AS COD_PROFESSOR_EXT,
    'N'                                                                                  AS IND_PROFESSOR_PRINCIPAL,
    TO_CHAR(PLETIVO.ID)||TO_CHAR(CURSO.CURSONIVEL_ID)                                    AS COD_PERIODO_LETIVO_EXT,
    TO_CHAR(CURSO.ID)                                                                    AS COD_CURSO_EXT,
    DECODE(RECCURSO.HABILITACAO,NULL,DECODE(CURSO.CODIGO,'4003','Sequencial','4017','Sequencial','9999','Bacharelado',MODALIDADE.NOME),CURSO.ID||' '||RECCURSO.HABILITACAO)	AS COD_HABILITACAO_EXT, 
    TO_CHAR(TURMA.CAMPUS_ID)                                                             AS COD_CAMPUS_EXT,
    TO_CHAR(NVL(TURMA.PERIODO_ID,6500000000001))                                         AS COD_TURNO_EXT,
    TO_CHAR(CURSO.ID)||TO_CHAR(CURRXDISC.DISC_ID)||((PLETIVO.SEMANAS*nvl(CHSEMANALTEORIA,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALPRATICA,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALLAB,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALEXERC,0))) AS COD_DISCIPLINA_EXT,
    CURR.CODIGO||PLETIVO.SEMANAS                                                         AS COD_GRD_CURRICULAR_EXT,
    'E'                                                                                  AS COD_TPO_CARGA_HOR_EXT,
    NULL                                                                                 AS DAT_HORARIO,
    SUBSTR(HORARIO_GNRETSEMANA(HORAAULA.HORARIO_ID),-1)                                  AS DIA_SEMANA,
    HORARIO_GSHORAINICIO(HORAAULA.HORARIO_ID)                                            AS HOR_INICIO,
    NULL                                                                                 AS HOR_FIM,
    NULL                                                                                 AS DAT_INICIO_DURACAO,
    NULL                                                                                 AS DAT_FIM_DURACAO,
    NULL                                                                                 AS NUM_CAPACIDADE,
    ALOCAPROF_GSRETSALA( PLETIVO.ID , TURMAOFE.TURMA_ID , TOXCD.CURRXDISC_ID , HORAAULA.DIVTURMA_ID , HORAAULA.ID ) AS DSC_SALA,
    ALOCAPROF_GSRETSALA( PLETIVO.ID , TURMAOFE.TURMA_ID , TOXCD.CURRXDISC_ID , HORAAULA.DIVTURMA_ID , HORAAULA.ID ) AS NUM_SALA,
    NULL AS COD_CURSO_VAG_EXT,
    NULL AS COD_HABILITACAO_VAG_EXT,
    NULL AS COD_CAMPUS_VAG_EXT,
    NULL AS NUM_PERIODO_VAG,
    NULL AS IND_CALOURO,
    NULL AS IND_OUTRAS_CAPTACOES,
    NULL AS IND_PROUNI,
    NULL AS NUM_VAGAS,
    DECODE(HORAAULA.DIVTURMA_ID,NULL,NULL,TO_CHAR(TURMAOFE.ID)||TO_CHAR(CURSO.ID)||TO_CHAR(CURRXDISC.DISC_ID)||((PLETIVO.SEMANAS*nvl(CHSEMANALTEORIA,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALPRATICA,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALLAB,0))||(PLETIVO.SEMANAS*nvl(CHSEMANALEXERC,0)))) AS COD_TURMA_ASSOC_EXT
  FROM
    MODALIDADE,
    HORAAULA,
    RECCURSO,
    CURSO,
    CURR,
    DURACXCI,
    TURMA,
    CURRXDISC,
    CURROFE,
    TURMAOFE,
    PLETIVO,
    TOXCD
  WHERE
    HORAAULA.WPESSOA_PROF4_ID IS NOT NULL
  AND
    RECCURSO.MODALIDADE_ID=MODALIDADE.ID(+)
  AND
    ( PLETIVO.FINAL BETWEEN HORAAULA.DTINICIO AND HORAAULA.DTTERMINO OR HORAAULA.ID IS NULL )  
  AND
    HORAAULA.TOXCD_ID (+)= TOXCD.ID
  AND
    CURSONIVEL_ID NOT IN (6200000000002,6200000000008)
  AND
    RECCURSO.VIGENTE='on'
  AND
    RECCURSO.CAMPUS_ID=TURMA.CAMPUS_ID
  AND
    RECCURSO.CURSO_ID=CURSO.ID
  AND
    TOXCD.TURMAOFE_ID=TURMAOFE.ID
  AND
    TOXCD.CURRXDISC_ID=CURRXDISC.ID
  AND
    CURR.CURSO_MIG_ID=CURSO.ID
  AND
    CURROFE.CURR_ID=CURR.ID
  AND
    TURMA.DURACXCI_ID=DURACXCI.ID
  AND
    TURMAOFE.TURMA_ID=TURMA.ID
  AND
    TURMAOFE.CURROFE_ID=CURROFE.ID
  AND
    CURROFE.PLETIVO_ID=PLETIVO.ID
  AND 
    NVL(CHSEMANALEXERC,0) > 0
  AND
    NVL(CHTOTAL,0) = 0		
)  
UNION ALL
(
  SELECT /* professor 1 turma especial*/
    TO_CHAR(TURMAOFE.ID)||TO_CHAR(CURSO.ID)||TO_CHAR(CURRXDISC.DISC_ID)||((PLETIVO.SEMANAS*nvl(CURRXDISC.CHSEMANALTEORIA,0))||(PLETIVO.SEMANAS*nvl(CURRXDISC.CHSEMANALPRATICA,0))||(PLETIVO.SEMANAS*nvl(CURRXDISC.CHSEMANALLAB,0))||(PLETIVO.SEMANAS*nvl(CURRXDISC.CHSEMANALEXERC,0)))||'T'||DIVTURMA_ID AS COD_TURMA_EXT,
    TURMA.CODIGO                                                                         AS NOM_TURMA,
    1                                                                                    AS NUM_PERIODO, 
    'S'                                                                                  AS IND_ESPECIAL,
    'S'                                                                                  AS IND_HORARIO,
    'N'                                                                                  AS IND_EAD,
    NVL(TO_CHAR(HORAAULA.WPESSOA_PROF1_ID),'a definir')                                  AS COD_PROFESSOR_EXT,
    'S'                                                                                  AS IND_PROFESSOR_PRINCIPAL,
    TO_CHAR(PLETIVO.ID)||TO_CHAR(CURSO.CURSONIVEL_ID)                                    AS COD_PERIODO_LETIVO_EXT,
    TO_CHAR(TURMA.CURSO_ID)                                                              AS COD_CURSO_EXT,
    '5700000000069 Bacharelado'                                                          AS COD_HABILITACAO_EXT, 
    TO_CHAR(TURMA.CAMPUS_ID)                                                             AS COD_CAMPUS_EXT,
    '6500000000002'                                                                      AS COD_TURNO_EXT, 
    TO_CHAR(CURSO.ID)||TO_CHAR(CURRXDISC.DISC_ID)||((PLETIVO.SEMANAS*nvl(CURRXDISC.CHSEMANALTEORIA,0))||(PLETIVO.SEMANAS*nvl(CURRXDISC.CHSEMANALPRATICA,0))||(PLETIVO.SEMANAS*nvl(CURRXDISC.CHSEMANALLAB,0))||(PLETIVO.SEMANAS*nvl(CURRXDISC.CHSEMANALEXERC,0))) AS COD_DISCIPLINA_EXT,
    CURR.CODIGO||PLETIVO.SEMANAS                                                         AS COD_GRD_CURRICULAR_EXT,
    'T'                                                                                  AS COD_TPO_CARGA_HOR_EXT,
    NULL                                                                                 AS DAT_HORARIO,
    SUBSTR(HORARIO_GNRETSEMANA(HORAAULA.HORARIO_ID),-1)                                  AS DIA_SEMANA,
    HORARIO_GSHORAINICIO(HORAAULA.HORARIO_ID)                                            AS HOR_INICIO,
    NULL                                                                                 AS HOR_FIM,
    NULL                                                                                 AS DAT_INICIO_DURACAO,
    NULL                                                                                 AS DAT_FIM_DURACAO,
    NULL                                                                                 AS NUM_CAPACIDADE,
    ALOCAPROF_GSRETSALA( PLETIVO.ID , TURMAOFE.TURMA_ID , TOXCD.CURRXDISC_ID , HORAAULA.DIVTURMA_ID , HORAAULA.ID ) AS DSC_SALA,
    ALOCAPROF_GSRETSALA( PLETIVO.ID , TURMAOFE.TURMA_ID , TOXCD.CURRXDISC_ID , HORAAULA.DIVTURMA_ID , HORAAULA.ID ) AS NUM_SALA,
    NULL AS COD_CURSO_VAG_EXT,
    NULL AS COD_HABILITACAO_VAG_EXT,
    NULL AS COD_CAMPUS_VAG_EXT,
    NULL AS NUM_PERIODO_VAG,
    NULL AS IND_CALOURO,
    NULL AS IND_OUTRAS_CAPTACOES,
    NULL AS IND_PROUNI,
    NULL AS NUM_VAGAS,
    DECODE(HORAAULA.DIVTURMA_ID,NULL,NULL,TO_CHAR(TURMAOFE.ID)||TO_CHAR(CURSO.ID)||TO_CHAR(CURRXDISC.DISC_ID)||((PLETIVO.SEMANAS*nvl(CURRXDISC.CHSEMANALTEORIA,0))||(PLETIVO.SEMANAS*nvl(CURRXDISC.CHSEMANALPRATICA,0))||(PLETIVO.SEMANAS*nvl(CURRXDISC.CHSEMANALLAB,0))||(PLETIVO.SEMANAS*nvl(CURRXDISC.CHSEMANALEXERC,0)))) AS COD_TURMA_ASSOC_EXT
  FROM
    HORAAULA,
    CURSO,
    TURMA,
    DEXCD,
    CURRXDISC,
    CURR,
    DISCESP,
    TURMAOFE,
    PLETIVO,
    TOXCD
  WHERE
    ( HORAAULA.AULATI_ID=13300000000001 OR HORAAULA.AULATI_ID IS NULL )
  AND
    ( PLETIVO.FINAL BETWEEN HORAAULA.DTINICIO AND HORAAULA.DTTERMINO OR HORAAULA.ID IS NULL )  
  AND
    HORAAULA.TOXCD_ID (+)= TOXCD.ID
  AND
    TOXCD.TURMAOFE_ID=TURMAOFE.ID
  AND
    TURMA.CURSO_ID=CURSO.ID
  AND
    TURMAOFE.TURMA_ID=TURMA.ID
  AND
    CURRXDISC.CURR_ID=CURR.ID
  AND
    DEXCD.CURRXDISC_ID=CURRXDISC.ID
  AND
    DEXCD.DISCESP_ID=DISCESP.ID
  AND
    TURMAOFE.DISCESP_ID=DISCESP.ID
  AND
    DISCESP.PLETIVO_ID=PLETIVO.ID
  AND 
    NVL(DISCESP.CHSEMANALTEORIA,0) > 0
  UNION ALL
  SELECT
    TO_CHAR(TURMAOFE.ID)||TO_CHAR(CURSO.ID)||TO_CHAR(CURRXDISC.DISC_ID)||((PLETIVO.SEMANAS*nvl(CURRXDISC.CHSEMANALTEORIA,0))||(PLETIVO.SEMANAS*nvl(CURRXDISC.CHSEMANALPRATICA,0))||(PLETIVO.SEMANAS*nvl(CURRXDISC.CHSEMANALLAB,0))||(PLETIVO.SEMANAS*nvl(CURRXDISC.CHSEMANALEXERC,0)))||'P'||DIVTURMA_ID AS COD_TURMA_EXT,
    TURMA.CODIGO                                                                         AS NOM_TURMA,
    1                                                                                    AS NUM_PERIODO, 
    'S'                                                                                  AS IND_ESPECIAL,
    'S'                                                                                  AS IND_HORARIO,
    'N'                                                                                  AS IND_EAD,
    NVL(TO_CHAR(HORAAULA.WPESSOA_PROF1_ID),'a definir')                                  AS COD_PROFESSOR_EXT,
    'S'                                                                                  AS IND_PROFESSOR_PRINCIPAL,
    TO_CHAR(PLETIVO.ID)||TO_CHAR(CURSO.CURSONIVEL_ID)                                    AS COD_PERIODO_LETIVO_EXT,
    TO_CHAR(TURMA.CURSO_ID)                                                              AS COD_CURSO_EXT,
    '5700000000069 Bacharelado'                                                          AS COD_HABILITACAO_EXT, 
    TO_CHAR(TURMA.CAMPUS_ID)                                                             AS COD_CAMPUS_EXT,
    '6500000000002'                                                                      AS COD_TURNO_EXT, 
    TO_CHAR(CURSO.ID)||TO_CHAR(CURRXDISC.DISC_ID)||((PLETIVO.SEMANAS*nvl(CURRXDISC.CHSEMANALTEORIA,0))||(PLETIVO.SEMANAS*nvl(CURRXDISC.CHSEMANALPRATICA,0))||(PLETIVO.SEMANAS*nvl(CURRXDISC.CHSEMANALLAB,0))||(PLETIVO.SEMANAS*nvl(CURRXDISC.CHSEMANALEXERC,0))) AS COD_DISCIPLINA_EXT,
    CURR.CODIGO||PLETIVO.SEMANAS                                                         AS COD_GRD_CURRICULAR_EXT,
    'P'                                                                                  AS COD_TPO_CARGA_HOR_EXT,
    NULL                                                                                 AS DAT_HORARIO,
    SUBSTR(HORARIO_GNRETSEMANA(HORAAULA.HORARIO_ID),-1)                                  AS DIA_SEMANA,
    HORARIO_GSHORAINICIO(HORAAULA.HORARIO_ID)                                            AS HOR_INICIO,
    NULL                                                                                 AS HOR_FIM,
    NULL                                                                                 AS DAT_INICIO_DURACAO,
    NULL                                                                                 AS DAT_FIM_DURACAO,
    NULL                                                                                 AS NUM_CAPACIDADE,
    ALOCAPROF_GSRETSALA( PLETIVO.ID , TURMAOFE.TURMA_ID , TOXCD.CURRXDISC_ID , HORAAULA.DIVTURMA_ID , HORAAULA.ID ) AS DSC_SALA,
    ALOCAPROF_GSRETSALA( PLETIVO.ID , TURMAOFE.TURMA_ID , TOXCD.CURRXDISC_ID , HORAAULA.DIVTURMA_ID , HORAAULA.ID ) AS NUM_SALA,
    NULL AS COD_CURSO_VAG_EXT,
    NULL AS COD_HABILITACAO_VAG_EXT,
    NULL AS COD_CAMPUS_VAG_EXT,
    NULL AS NUM_PERIODO_VAG,
    NULL AS IND_CALOURO,
    NULL AS IND_OUTRAS_CAPTACOES,
    NULL AS IND_PROUNI,
    NULL AS NUM_VAGAS,
    DECODE(HORAAULA.DIVTURMA_ID,NULL,NULL,TO_CHAR(TURMAOFE.ID)||TO_CHAR(CURSO.ID)||TO_CHAR(CURRXDISC.DISC_ID)||((PLETIVO.SEMANAS*nvl(CURRXDISC.CHSEMANALTEORIA,0))||(PLETIVO.SEMANAS*nvl(CURRXDISC.CHSEMANALPRATICA,0))||(PLETIVO.SEMANAS*nvl(CURRXDISC.CHSEMANALLAB,0))||(PLETIVO.SEMANAS*nvl(CURRXDISC.CHSEMANALEXERC,0)))) AS COD_TURMA_ASSOC_EXT
  FROM
    HORAAULA,
    CURSO,
    TURMA,
    DEXCD,
    CURRXDISC,
    CURR,
    DISCESP,
    TURMAOFE,
    PLETIVO,
    TOXCD
  WHERE
    ( HORAAULA.AULATI_ID=13300000000002 OR HORAAULA.AULATI_ID IS NULL )
  AND
    ( PLETIVO.FINAL BETWEEN HORAAULA.DTINICIO AND HORAAULA.DTTERMINO OR HORAAULA.ID IS NULL )  
  AND
    HORAAULA.TOXCD_ID (+)= TOXCD.ID
  AND
    TOXCD.TURMAOFE_ID=TURMAOFE.ID
  AND
    TURMA.CURSO_ID=CURSO.ID
  AND
    TURMAOFE.TURMA_ID=TURMA.ID
  AND
    CURRXDISC.CURR_ID=CURR.ID
  AND
    DEXCD.CURRXDISC_ID=CURRXDISC.ID
  AND
    DEXCD.DISCESP_ID=DISCESP.ID
  AND
    TURMAOFE.DISCESP_ID=DISCESP.ID
  AND
    DISCESP.PLETIVO_ID=PLETIVO.ID
  AND 
    NVL(DISCESP.CHSEMANALPRATICA,0) > 0
)