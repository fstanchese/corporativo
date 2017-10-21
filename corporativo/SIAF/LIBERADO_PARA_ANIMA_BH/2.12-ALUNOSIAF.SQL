SELECT 
  ALUNOCURSO.TIPOQUERY,
  WPESSOA.CODIGO AS RA,
  WPESSOA.NOME AS NOMEALUNO,  
  CURSO.NOME AS NOMECURSO,
  ALUNOCURSO.WPESSOA_ID||ALUNOCURSO.CURSO_ID||ALUNOCURSO.COD_HABILITACAO_EXT||ALUNOCURSO.PERIODO_ID||ALUNOCURSO.CAMPUS_ID                                                  AS COD_ALUNO_EXT,
  MATRIC_GSALUNOSIAF( ALUNOCURSO.WPESSOA_ID , ALUNOCURSO.CURSO_ID , ALUNOCURSO.PERIODO_ID , ALUNOCURSO.CAMPUS_ID , NULL , 'SERIE' , 'U' )                                  AS NUM_PERIODO,
  MATRIC_GSALUNOSIAF( ALUNOCURSO.WPESSOA_ID , ALUNOCURSO.CURSO_ID , ALUNOCURSO.PERIODO_ID , ALUNOCURSO.CAMPUS_ID , NULL , 'ANO_ENTRADA' , 'P' )                            AS ANO_ENTRADA,
  MATRIC_GSALUNOSIAF( ALUNOCURSO.WPESSOA_ID , ALUNOCURSO.CURSO_ID , ALUNOCURSO.PERIODO_ID , ALUNOCURSO.CAMPUS_ID , NULL , 'SEMESTRE_ENTRADA' , 'P' )                       AS SEMESTRE_ENTRADA,
  ALUNOCURSO.STATE_ID                                                                                                                                                      AS COD_STA_ALUNO_EXT,
  STATE_GSRECOGNIZE(ALUNOCURSO.STATE_ID)                                                                                                                                   AS DSC_STA_ALUNO,
  ALUNOCURSO.CURSO_ID                                                                                                                                                      AS COD_CURSO_EXT,
  ALUNOCURSO.COD_HABILITACAO_EXT                                                                                                                                           AS COD_HABILITACAO_EXT,
  ALUNOCURSO.CAMPUS_ID                                                                                                                                                     AS COD_CAMPUS_EXT,
  ALUNOCURSO.COD_GRD_CURRICULAR_EXT                                                                                                                                        AS COD_GRD_CURRICULAR_EXT,
  ALUNOCURSO.PERIODO_ID                                                                                                                                                    AS COD_TURNO_EXT,
  MATRIC_GSALUNOSIAF( ALUNOCURSO.WPESSOA_ID , ALUNOCURSO.CURSO_ID , ALUNOCURSO.PERIODO_ID , ALUNOCURSO.CAMPUS_ID , NULL , 'FORMA_INGRESSO'  )                              AS COD_TIPO_ENTRADA_EXT,
  MATRIC_GSALUNOSIAF( ALUNOCURSO.WPESSOA_ID , ALUNOCURSO.CURSO_ID , ALUNOCURSO.PERIODO_ID , ALUNOCURSO.CAMPUS_ID , NULL , 'FORMA_INGRESSO'  )                              AS DSC_TPO_ENTRADA,
  ALUNOCURSO.DATA_SAIDA                                                                                                                                                    AS DAT_SAIDA,
  DECODE(ALUNOCURSO.STATE_ID,3000000002012,'S',DECODE(ALUNOCURSO.DATA_SAIDA,NULL,'S','N'))                                                                                 AS IND_ALUNO_ATUAL,
  DECODE(WPESSOA.CIVIL_ID,15000000000001,1,15000000000002,2,15000000000003,3,15000000000004,4,15000000000005,5,15000000000006,NULL)                                        AS COD_ESTADO_CIVIL_EXT,
  WPESSOA.CIDADE_NATURAL_ID                                                                                                                                                AS COD_CIDADE_EXT,
  ESTADO.ID                                                                                                                                                                AS COD_ESTADO_EXT,
  'BRA'                                                                                                                                                                    AS COD_PAIS_EXT,  
  WPESSOA.TELENUM                                                                                                                                                          AS NUM_TIT_ELEITOR,
  WPESSOA.TELESECAO                                                                                                                                                        AS NUM_SECAO_TE,  
  WPESSOA.TELEZONA                                                                                                                                                         AS NUM_ZONA_TE,
  WPESSOA.CPF                                                                                                                                                              AS NUM_CPF,
  WPESSOA.MILITARNUM                                                                                                                                                       AS NUM_CERT_MILITAR,
  WPESSOA.RGRNE                                                                                                                                                            AS NUM_IDENTIDADE,
  WPESSOA.RGRNEDT                                                                                                                                                          AS DAT_EMISSAO,
  WPESSOA.RGRNEEMISSOR                                                                                                                                                     AS NOM_ORGEXP_CI,
  WPESSOA.DTNASCTO                                                                                                                                                         AS DAT_NASCIMENTO,
  DECODE(ALUNOCURSO.STATE_ID,3000000002012,ALUNOCURSO.DATA_SAIDA,NULL)                                                                                                     AS DAT_COLACAO,
  DECODE(WPESSOA.SEXO_ID,500000000001,'F',500000000002,'M')                                                                                                                AS IND_SEXO,
  ENADE.ANOENADE                                                                                                                                                           AS ANO_ENADE,
  ENADE.DATAENADE                                                                                                                                                          AS DAT_PROVA_ENADE,
  ENADE.TIPOENADE                                                                                                                                                          AS COD_TPO_ALUNO_ENADE,
  ENADE.SITUACAOENADE                                                                                                                                                      AS COD_STA_ALUNO_ENADE,
  WPESSOA.EMAIL1                                                                                                                                                           AS EML_ALINO_1,
  WPESSOA.EMAIL2                                                                                                                                                           AS EML_ALINO_2,
  WPESSOA.FONECEL                                                                                                                                                          AS TEL_CELULAR,
  BAIRRO.CIDADE_ID                                                                                                                                                         AS COD_CIDADE_RES_EXT,
  CIDADE.ESTADO_ID                                                                                                                                                         AS COD_ESTADO_RES_EXT,
  'BRA'                                                                                                                                                                    AS COD_PAIS_RES_EXT,
  LOGRAD.NOME                                                                                                                                                              AS NOM_LOGRADOURO,
  WPESSOA.ENDERNUM                                                                                                                                                         AS NOM_COMPLEMENTO,
  BAIRRO.NOME                                                                                                                                                              AS NOM_BAIRRO,
  LOGRAD.CEP                                                                                                                                                               AS CEP_ENDERECO,
  WPESSOA.FONERES                                                                                                                                                          AS TEL_ENDERECO,
  NULL                                                                                                                                                                     AS COD_CIDADE_TE_EXT,
  NULL                                                                                                                                                                     AS COD_ESTADO_TE_EXT,
  NULL                                                                                                                                                                     AS COD_PAIS_TE_EXT,
  NULL                                                                                                                                                                     AS NOM_ORGEXP_CM,
  NULL                                                                                                                                                                     AS DSC_SITUACAO_CM,
  NULL                                                                                                                                                                     AS DAT_EMISSAO_CM,
  NULL                                                                                                                                                                     AS COD_TPO_DOCUMENTO_EXT,
  NULL                                                                                                                                                                     AS DSC_TPO_DOCUMENTO,
  NULL                                                                                                                                                                     AS DAT_PRAZO_ENTREGA,
  NULL                                                                                                                                                                     AS IND_ENTREGA_DOC,
  NULL                                                                                                                                                                     AS IND_ESTRANGEIRO,
  NULL                                                                                                                                                                     AS NUM_DOCUMENTO,
  NULL                                                                                                                                                                     AS DAT_VALIDADE,
  NULL                                                                                                                                                                     AS DAT_ENTRADA_PAIS,
  NULL                                                                                                                                                                     AS DAT_EXPEDICAO,
  NULL                                                                                                                                                                     AS COD_PARENTE_EXT,
  NULL                                                                                                                                                                     AS COD_GRAU_PARENTESCO,
  NULL                                                                                                                                                                     AS NOM_PARENTE,
  NULL                                                                                                                                                                     AS COD_EST_CIVIL_PARENT_EXT,
  NULL                                                                                                                                                                     AS COD_TPO_DEFICIENCIA,
  NULL                                                                                                                                                                     AS IND_CANHOTO,
  NULL                                                                                                                                                                     AS COD_TPO_SANGUINEO_EXT,
  NULL                                                                                                                                                                     AS DSC_OBSERVACAO, 
  NULL                                                                                                                                                                     AS COD_TPO_TITULACAO,
  NULL                                                                                                                                                                     AS DAT_TPO_TITULACAO,
  NULL                                                                                                                                                                     AS COD_TPO_TITULACAO,
  NULL                                                                                                                                                                     AS DAT_TITULACAO,
  NULL                                                                                                                                                                     AS COD_INSTIT_EXTERNA_EXT,
  NULL                                                                                                                                                                     AS COD_CIDADE_COB_EXT,
  NULL                                                                                                                                                                     AS COD_ESTADO_COB_EXT,
  NULL                                                                                                                                                                     AS COD_PAIS_COB_EXT,
  NULL                                                                                                                                                                     AS NOM_LOGRADOURO_COB,
  NULL                                                                                                                                                                     AS NOM_COMPLEMENTO_COB,
  NULL                                                                                                                                                                     AS NOM_BAIRRO_COB,
  NULL                                                                                                                                                                     AS CEP_ENDERECO_COB,
  NULL                                                                                                                                                                     AS TEL_ENDERECO_COB
FROM
(
SELECT 
  '1' AS TIPOQUERY,
  CURSO.ID||' '||DECODE(CURSO.CODIGO,'4003','Sequencial','4017','Sequencial',MODALIDADE.NOME) AS COD_HABILITACAO_EXT,
  GRADEALUNO.WPESSOA_ID                    AS WPESSOA_ID,
  GRADEALUNO.CURSO_ID                      AS CURSO_ID,
  GRADEALUNO.PERIODO_ID                    AS PERIODO_ID,
  GRADEALUNO.CAMPUS_ID                     AS CAMPUS_ID,
  GRADEALUNO.STATE_ID                      AS STATE_ID,
  GRADEALUNO.PLETIVO_ID                    AS PLETIVO_ID,
  GRADEALUNO.COD_GRD_CURRICULAR_EXT        AS COD_GRD_CURRICULAR_EXT,
  GRADEALUNO.POSICAO                       AS POSICAO,
  GRADEALUNO.MATRIC_ID                     AS MATRIC_ID,
  GRADEALUNO.CURR_ID                       AS CURR_ID,
  RECCURSO.MODALIDADE_ID                   AS MODALIDADE_ID,
  DECODE(GRADEALUNO.DTSTATE,NULL,MATRIC_GSRETDATASAIDA( GRADEALUNO.MATRIC_ID , GRADEALUNO.CURR_ID , RECCURSO.MODALIDADE_ID ),GRADEALUNO.DTSTATE) AS DATA_SAIDA
FROM
  (
    SELECT  
      RANK() OVER (PARTITION BY MATRIC.WPESSOA_ID,CURR.CURSO_MIG_ID ORDER BY PLETIVO_ID DESC ) AS POSICAO,  
      MATRIC.WPESSOA_ID            AS WPESSOA_ID,     
      CURR.CURSO_MIG_ID            AS CURSO_ID, 
      CURROFE.PERIODO_ID           AS PERIODO_ID,
      CURROFE.CAMPUS_ID            AS CAMPUS_ID,
      MATRICXMOD.STATE_ID          AS STATE_ID,
      CURROFE.PLETIVO_ID           AS PLETIVO_ID,
      MATRIC.ID                    AS MATRIC_ID,
      CURR.ID                      AS CURR_ID,
      CURR.CODIGO||PLETIVO.SEMANAS AS COD_GRD_CURRICULAR_EXT,
      MATRICXMOD.DTSTATE           AS DTSTATE,
      CURRXMOD.CURR_ID             AS CURR_BA_ID
    FROM
      PLETIVO,
      MODALIDADE,
      (
        SELECT 
          MATRICXMOD.MATRIC_ID                                            AS MATRIC_ID,
          DECODE(MATRICTRANSF.ID,NULL,MATRICXMOD.STATE_ID,3000000002006)  AS STATE_ID,
          MODALIDADE_ID                                                   AS MODALIDADE_ID,
          TO_CHAR(DECODE(MATRICTRANSF.ID,NULL,MATRIC.DTSTATE,MATRICTRANSF.DATA),'DD/MM/YYYY') AS DTSTATE    
        FROM
          MATRICXMOD,
          MATRICTRANSF,
          MATRIC
        WHERE
          MATRICXMOD.MATRIC_ID=MATRIC.ID
        AND
          MATRICTRANSF.MATRIC_ID (+)= MATRIC.ID
      ) MATRICXMOD,
      MATRIC,
      TURMAOFE,
      TURMA,
      CURROFE,
      (
        SELECT
          SUBSTR(CURR.CODIGO,1,8)||'BA' AS CURR_CODIGO,
          CURRXMOD.CURR_ID
        FROM
          CURRXMOD,
          CURR
        WHERE
          CURR.ID=CURRXMOD.CURR_ID
        AND
          MODALIDADE_ID=195300000000001
      ) CURRXMOD,
      CURR,
      RECCURSO,
      CURSO,
      WPESSOA
    WHERE 
      NOT EXISTS ( SELECT CURR.CODIGO FROM MATRIC,TURMAOFE,CURROFE,CURR WHERE CURROFE.CURR_ID=CURR.ID AND TURMAOFE.CURROFE_ID=CURROFE.ID AND MATRIC.TURMAOFE_ID=TURMAOFE.ID AND MATRIC.WPESSOA_ID=WPESSOA.ID AND CURR.CODIGO=CURRXMOD.CURR_CODIGO GROUP BY CURR.CODIGO )
    AND
      MATRIC.WPESSOA_ID=WPESSOA.ID
    AND
      CURROFE.PLETIVO_ID=PLETIVO.ID
    AND
      RECCURSO.CURSO_ID=CURSO.ID
    AND
      MATRICXMOD.MODALIDADE_ID=MODALIDADE.ID
    AND
      MATRICXMOD.STATE_ID > 3000000002000
    AND
      RECCURSO.VIGENTE='on'
    AND
      CURR.CURSO_MIG_ID=RECCURSO.CURSO_ID
    AND
      CURR.CODIGO=CURRXMOD.CURR_CODIGO
    AND
      CURRXMOD.CURR_ID=CURROFE.CURR_ID
    AND
      TURMAOFE.TURMA_ID=TURMA.ID
    AND
      TURMAOFE.CURROFE_ID=CURROFE.ID
    AND
      MATRIC.TURMAOFE_ID=TURMAOFE.ID
    AND
      MATRIC.ID=MATRICXMOD.MATRIC_ID
    AND
      MATRICXMOD.MODALIDADE_ID=195300000000001    
  ) GRADEALUNO,
  RECCURSO,
  CURSO,
  MODALIDADE
WHERE
  NOT EXISTS ( select matric.id from  curr, matric,currofe,turmaofe where curr.curr_pai_id=gradealuno.curr_ba_id and currofe.curr_id=curr.id and turmaofe.currofe_id=currofe.id and matric.turmaofe_id=turmaofe.id and matric.wpessoa_id=gradealuno.wpessoa_id )
AND
  GRADEALUNO.POSICAO=1
AND 
  RECCURSO.MODALIDADE_ID=MODALIDADE.ID
AND
  GRADEALUNO.CURSO_ID=CURSO.ID
AND
  RECCURSO.CURSO_ID=GRADEALUNO.CURSO_ID
AND
  RECCURSO.HABILITACAO IS NULL
AND
  RECCURSO.VIGENTE = 'on'
AND
  RECCURSO.CAMPUS_ID = GRADEALUNO.CAMPUS_ID  
UNION
SELECT 
  '2' AS TIPOQUERY,
  CURSO.ID||' '||RECCURSO.HABILITACAO      AS COD_HABILITACAO_EXT,
  GRADEALUNO.WPESSOA_ID                    AS WPESSOA_ID,
  GRADEALUNO.CURSO_ID                      AS CURSO_ID,
  GRADEALUNO.PERIODO_ID                    AS PERIODO_ID,
  GRADEALUNO.CAMPUS_ID                     AS CAMPUS_ID,
  GRADEALUNO.STATE_ID                      AS STATE_ID,
  GRADEALUNO.PLETIVO_ID                    AS PLETIVO_ID,
  GRADEALUNO.COD_GRD_CURRICULAR_EXT        AS COD_GRD_CURRICULAR_EXT,
  GRADEALUNO.POSICAO                       AS POSICAO,
  GRADEALUNO.MATRIC_ID                     AS MATRIC_ID,
  GRADEALUNO.CURR_ID                       AS CURR_ID,
  RECCURSO.MODALIDADE_ID                   AS MODALIDADE_ID,
  DECODE(GRADEALUNO.DTSTATE,NULL,MATRIC_GSRETDATASAIDA( GRADEALUNO.MATRIC_ID , GRADEALUNO.CURR_ID , RECCURSO.MODALIDADE_ID ),GRADEALUNO.DTSTATE) AS DATA_SAIDA
FROM
  (
    SELECT  
      RANK() OVER (PARTITION BY MATRIC.WPESSOA_ID,CURR.CURSO_MIG_ID ORDER BY PLETIVO_ID DESC ) AS POSICAO,  
      MATRIC.WPESSOA_ID            AS WPESSOA_ID,     
      CURR.CURSO_MIG_ID            AS CURSO_ID, 
      CURROFE.PERIODO_ID           AS PERIODO_ID,
      CURROFE.CAMPUS_ID            AS CAMPUS_ID,
      MATRICXMOD.STATE_ID          AS STATE_ID,
      CURROFE.PLETIVO_ID           AS PLETIVO_ID,
      MATRIC.ID                    AS MATRIC_ID,
      CURR.ID                      AS CURR_ID,
      CURR.CODIGO||PLETIVO.SEMANAS AS COD_GRD_CURRICULAR_EXT,
      MATRICXMOD.DTSTATE           AS DTSTATE
    FROM
      PLETIVO,
      MODALIDADE,
      (
        SELECT 
          MATRICXMOD.MATRIC_ID                                            AS MATRIC_ID,
          DECODE(MATRICTRANSF.ID,NULL,MATRICXMOD.STATE_ID,3000000002006)  AS STATE_ID,
          MODALIDADE_ID                                                   AS MODALIDADE_ID,
          TO_CHAR(DECODE(MATRICTRANSF.ID,NULL,MATRIC.DTSTATE,MATRICTRANSF.DATA),'DD/MM/YYYY') AS DTSTATE    
        FROM
          MATRICXMOD,
          MATRICTRANSF,
          MATRIC
        WHERE
          MATRICXMOD.MATRIC_ID=MATRIC.ID
        AND
          MATRICTRANSF.MATRIC_ID (+)= MATRIC.ID
      ) MATRICXMOD,
      MATRIC,
      TURMAOFE,
      TURMA,
      CURROFE,
      (
        SELECT
          SUBSTR(CURR.CODIGO,1,8)||'BA' AS CURR_CODIGO,
          CURRXMOD.CURR_ID
        FROM
          CURRXMOD,
          CURR
        WHERE
          CURR.ID=CURRXMOD.CURR_ID
        AND
          MODALIDADE_ID=195300000000001
      ) CURRXMOD,
      CURR,
      RECCURSO,
      CURSO,
      WPESSOA
    WHERE 
      MATRIC.WPESSOA_ID=WPESSOA.ID
    AND
      CURROFE.PLETIVO_ID=PLETIVO.ID
    AND
      RECCURSO.CURSO_ID=CURSO.ID
    AND
      MATRICXMOD.MODALIDADE_ID=MODALIDADE.ID
    AND
      MATRICXMOD.STATE_ID > 3000000002000
    AND
      RECCURSO.VIGENTE='on'
    AND
      CURR.CURSO_MIG_ID=RECCURSO.CURSO_ID
    AND
      CURR.CODIGO=CURRXMOD.CURR_CODIGO
    AND
      CURRXMOD.CURR_ID=CURROFE.CURR_ID
    AND
      TURMAOFE.TURMA_ID=TURMA.ID
    AND
      TURMAOFE.CURROFE_ID=CURROFE.ID
    AND
      MATRIC.TURMAOFE_ID=TURMAOFE.ID
    AND
      MATRIC.ID=MATRICXMOD.MATRIC_ID
    AND
      MATRICXMOD.MODALIDADE_ID=195300000000001    
  ) GRADEALUNO,
  RECCURSO,
  CURSO,
  MODALIDADE
WHERE
  GRADEALUNO.POSICAO=1
AND 
  RECCURSO.MODALIDADE_ID=MODALIDADE.ID
AND
  GRADEALUNO.CURSO_ID=CURSO.ID
AND
  RECCURSO.CURSO_ID=GRADEALUNO.CURSO_ID
AND
  RECCURSO.HABILITACAO IS NOT NULL
AND
  RECCURSO.VIGENTE = 'on'
AND
  RECCURSO.CAMPUS_ID = GRADEALUNO.CAMPUS_ID  
UNION
SELECT 
  '3' AS TIPOQUERY,
  CURSO.ID||' '||RECCURSO.HABILITACAO  AS COD_HABILITACAO_EXT,
  GRADEALUNO.WPESSOA_ID                    AS WPESSOA_ID,
  GRADEALUNO.CURSO_ID                      AS CURSO_ID,
  GRADEALUNO.PERIODO_ID                    AS PERIODO_ID,
  GRADEALUNO.CAMPUS_ID                     AS CAMPUS_ID,
  GRADEALUNO.STATE_ID                      AS STATE_ID,
  GRADEALUNO.PLETIVO_ID                    AS PLETIVO_ID,
  GRADEALUNO.COD_GRD_CURRICULAR_EXT        AS COD_GRD_CURRICULAR_EXT,
  GRADEALUNO.POSICAO                       AS POSICAO,
  GRADEALUNO.MATRIC_ID                     AS MATRIC_ID,
  GRADEALUNO.CURR_ID                       AS CURR_ID,
  RECCURSO.MODALIDADE_ID                   AS MODALIDADE_ID,
  DECODE(GRADEALUNO.DTSTATE,NULL,MATRIC_GSRETDATASAIDA( GRADEALUNO.MATRIC_ID , GRADEALUNO.CURR_ID , RECCURSO.MODALIDADE_ID ),GRADEALUNO.DTSTATE) AS DATA_SAIDA
FROM
  (
  SELECT
    RANK() OVER (PARTITION BY MATRIC.WPESSOA_ID,CURR.CURSO_MIG_ID ORDER BY PLETIVO_ID DESC ) AS POSICAO,
    MATRIC.WPESSOA_ID            AS WPESSOA_ID,
    CURR.CURSO_MIG_ID            AS CURSO_ID, 
    CURROFE.PERIODO_ID           AS PERIODO_ID,
    CURROFE.CAMPUS_ID            AS CAMPUS_ID,
    MATRIC.STATE_ID              AS STATE_ID,
    CURROFE.PLETIVO_ID           AS PLETIVO_ID,
    MATRIC.ID                    AS MATRIC_ID,
    CURR.ID                      AS CURR_ID,
    CURR.CODIGO||PLETIVO.SEMANAS AS COD_GRD_CURRICULAR_EXT,
    MATRIC.DTSTATE               AS DTSTATE
  FROM
    (
      SELECT 
        MATRIC.ID                                                     AS ID,
        MATRIC.TURMAOFE_ID                                            AS TURMAOFE_ID,
        MATRIC.WPESSOA_ID                                             AS WPESSOA_ID,
        MATRIC.MATRICTI_ID                                            AS MATRICTI_ID,
        DECODE(MATRICTRANSF.ID,NULL,MATRIC.STATE_ID,3000000002006)    AS STATE_ID,
        TO_CHAR(DECODE(MATRICTRANSF.ID,NULL,MATRIC.DTSTATE,MATRICTRANSF.DATA),'DD/MM/YYYY') AS DTSTATE    
      FROM
        MATRICTRANSF,
        MATRIC
      WHERE
        MATRICTRANSF.MATRIC_ID (+)= MATRIC.ID
    ) MATRIC,
    TURMAOFE,
    CURROFE,
    CURR,
    PLETIVO
  WHERE  
    MATRIC.STATE_ID > 3000000002001
  AND
    MATRIC.MATRICTI_ID=8300000000001
  AND
    CURROFE.PLETIVO_ID=PLETIVO.ID
  AND
    CURROFE.CURR_ID=CURR.ID
  AND
    MATRIC.TURMAOFE_ID=TURMAOFE.ID
  AND
    TURMAOFE.CURROFE_ID=CURROFE.ID
  ) GRADEALUNO,
  RECCURSO,
  CURSO
WHERE
  GRADEALUNO.POSICAO=1
AND 
  GRADEALUNO.CURSO_ID=CURSO.ID
AND
  RECCURSO.CURSO_ID=GRADEALUNO.CURSO_ID
AND
  RECCURSO.HABILITACAO IS NOT NULL
AND
  RECCURSO.VIGENTE = 'on'
AND
  RECCURSO.CAMPUS_ID = GRADEALUNO.CAMPUS_ID
UNION
SELECT 
  '4' AS TIPOQUERY,
  CURSO.ID||' '||DECODE(CURSO.ID,5700000003226,'Sequencial',5700000005279,'Sequencial',MODALIDADE.NOME) AS COD_HABILITACAO_EXT, 
  GRADEALUNO.WPESSOA_ID                    AS WPESSOA_ID,
  GRADEALUNO.CURSO_ID                      AS CURSO_ID,
  GRADEALUNO.PERIODO_ID                    AS PERIODO_ID,
  GRADEALUNO.CAMPUS_ID                     AS CAMPUS_ID,
  GRADEALUNO.STATE_ID                      AS STATE_ID,
  GRADEALUNO.PLETIVO_ID                    AS PLETIVO_ID,
  GRADEALUNO.COD_GRD_CURRICULAR_EXT        AS COD_GRD_CURRICULAR_EXT,
  GRADEALUNO.POSICAO                       AS POSICAO,
  GRADEALUNO.MATRIC_ID                     AS MATRIC_ID,
  GRADEALUNO.CURR_ID                       AS CURR_ID,
  RECCURSO.MODALIDADE_ID                   AS MODALIDADE_ID,
  DECODE(GRADEALUNO.DTSTATE,NULL,MATRIC_GSRETDATASAIDA( GRADEALUNO.MATRIC_ID , GRADEALUNO.CURR_ID , RECCURSO.MODALIDADE_ID ),GRADEALUNO.DTSTATE) AS DATA_SAIDA
FROM
  (
  SELECT
    RANK() OVER (PARTITION BY MATRIC.WPESSOA_ID,CURR.CURSO_MIG_ID ORDER BY PLETIVO_ID DESC ) AS POSICAO,
    MATRIC.WPESSOA_ID            AS WPESSOA_ID,
    CURR.CURSO_MIG_ID            AS CURSO_ID, 
    CURROFE.PERIODO_ID           AS PERIODO_ID,
    CURROFE.CAMPUS_ID            AS CAMPUS_ID,
    MATRIC.STATE_ID              AS STATE_ID,
    CURROFE.PLETIVO_ID           AS PLETIVO_ID,
    MATRIC.ID                    AS MATRIC_ID,
    CURR.ID                      AS CURR_ID,
    CURR.CODIGO||PLETIVO.SEMANAS AS COD_GRD_CURRICULAR_EXT,
    MATRIC.DTSTATE               AS DTSTATE
  FROM
    (
      SELECT 
        MATRIC.ID                                                     AS ID,
        MATRIC.TURMAOFE_ID                                            AS TURMAOFE_ID,
        MATRIC.WPESSOA_ID                                             AS WPESSOA_ID,
        MATRIC.MATRICTI_ID                                            AS MATRICTI_ID,
        DECODE(MATRICTRANSF.ID,NULL,MATRIC.STATE_ID,3000000002006)    AS STATE_ID,
        TO_CHAR(DECODE(MATRICTRANSF.ID,NULL,MATRIC.DTSTATE,MATRICTRANSF.DATA),'DD/MM/YYYY') AS DTSTATE    
      FROM
        MATRICTRANSF,
        MATRIC
      WHERE
        MATRICTRANSF.MATRIC_ID (+)= MATRIC.ID
    ) MATRIC,
    TURMAOFE,
    CURROFE,
    CURR,
    PLETIVO
  WHERE	
    MATRIC.STATE_ID > 3000000002001
  AND
    MATRIC.MATRICTI_ID=8300000000001
  AND
    CURROFE.PLETIVO_ID=PLETIVO.ID
  AND
    CURROFE.CURR_ID=CURR.ID
  AND
    MATRIC.TURMAOFE_ID=TURMAOFE.ID
  AND
    TURMAOFE.CURROFE_ID=CURROFE.ID
  ) GRADEALUNO,
  RECCURSO,
  CURSO,
  MODALIDADE
WHERE
  NOT EXISTS ( select matric.id from  curr, matric,currofe,turmaofe where curr.curr_pai_id=gradealuno.curr_id and currofe.curr_id=curr.id and turmaofe.currofe_id=currofe.id and matric.turmaofe_id=turmaofe.id and matric.wpessoa_id=gradealuno.wpessoa_id )
AND
  GRADEALUNO.POSICAO=1
AND 
  RECCURSO.MODALIDADE_ID=MODALIDADE.ID
AND
  GRADEALUNO.CURSO_ID=CURSO.ID
AND
  RECCURSO.CURSO_ID=GRADEALUNO.CURSO_ID
AND
  RECCURSO.HABILITACAO IS NULL
AND
  RECCURSO.VIGENTE = 'on'
AND
  RECCURSO.CAMPUS_ID = GRADEALUNO.CAMPUS_ID 
) ALUNOCURSO,
(
SELECT 
  PROVAO.MODALIDADE_ID               AS MODALIDADE_ID,
  CURR.CURSO_ID                      AS CURSO_ID,
  MATRIC.WPESSOA_ID                  AS WPESSOA_ID,
  MATRIC.TURMAOFE_ID                 AS TURMAOFE_ID,
  TO_CHAR(MEC.DTEXAME,'DD/MM/YYYY')  AS DATAENADE, 
  DECODE(TURMAOFE_GNULTIMOANISTA(MATRIC.TURMAOFE_ID),0,'1','2') AS TIPOENADE,
  DECODE(PROVAO.STATE_ID,3000000019004,'1',3000000019002,'2',3000000019003,'3',3000000019005,'5') AS SITUACAOENADE,
  ANO.ANO AS ANOENADE
FROM 
  PROVAO,
  MATRIC,
  CURROFE,
  TURMAOFE,
  CURR,
  MEC,
  ANO
WHERE
  MEC.ANO_ID=ANO.ID
AND
  PROVAO.MEC_ID=MEC.ID 
AND 
  PROVAO.MATRIC_ID=MATRIC.ID 
AND
  MATRIC.TURMAOFE_ID=TURMAOFE.ID
AND
  TURMAOFE.CURROFE_ID=CURROFE.ID
AND
  CURROFE.CURR_ID=CURR.ID
ORDER BY 3,8
) ENADE,    
  WPESSOA,
  CIVIL,
  CIDADE,
  ESTADO,
  CURSO,
  PERIODO,
  CAMPUS,
  LOGRAD,
  BAIRRO,
  PLETIVO
WHERE
  ALUNOCURSO.WPESSOA_ID=ENADE.WPESSOA_ID(+)
AND
  ALUNOCURSO.CURSO_ID=ENADE.CURSO_ID(+)
AND
  ALUNOCURSO.MODALIDADE_ID=ENADE.MODALIDADE_ID(+)
AND
  ALUNOCURSO.PLETIVO_ID=PLETIVO.ID
AND
  ALUNOCURSO.PERIODO_ID=PERIODO.ID
AND
  ALUNOCURSO.CAMPUS_ID=CAMPUS.ID
AND
  ALUNOCURSO.CURSO_ID = CURSO.ID
AND
  ALUNOCURSO.WPESSOA_ID = WPESSOA.ID
AND
  WPESSOA.CIVIL_ID=CIVIL.ID(+)
AND
  WPESSOA.CIDADE_NATURAL_ID=CIDADE.ID(+)  
AND
  CIDADE.ESTADO_ID=ESTADO.ID(+)   
AND
  WPESSOA.LOGRAD_ID=LOGRAD.ID(+)
AND
  LOGRAD.BAIRRO_ID = BAIRRO.ID(+)   
