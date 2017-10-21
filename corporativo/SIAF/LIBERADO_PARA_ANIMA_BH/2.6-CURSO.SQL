SELECT 
  TO_CHAR(CURSO.ID)                                                      AS COD_CURSO_EXT,
  RECCURSO.NOMEDIPLANVERSO                                               AS NOM_CURSO,
  CURSO.CODIGO                                                           AS SGL_CURSO,
  CURSO.ID||' '||RECCURSO.HABILITACAO                                    AS COD_HABILITACAO_EXT,
  RECCURSO.HABILITACAO                                                   AS DSC_HABILITACAO,
  1                                                                      AS COD_TPO_HABILITACAO,
  SUBSTR(MODALIDADE.NOME,1,1)                                            AS TIPO_HABILITACAO, 
  NULL                                                                   AS COD_CURSO_INEP,
  NULL                                                                   AS OBS_CURSO,
  NOMEATESTADO                                                           AS NOM_CURSO_CERTIFICADO,
  NULL                                                                   AS IND_DIS_ISOLADA,
  NULL                                                                   AS IND_EAD,
  6                                                                      AS TMP_MAXIMO,
  4                                                                      AS TMP_MINIMO,
  '1'                                                                    AS COD_TPO_CURSO,
  FACUL.ID                                                               AS COD_DEPARTAMENTO_EXT,
  FACUL.NOMECOMPLETO                                                     AS NOM_DEPARTAMENTO,
  CASE 
  WHEN FACUL.ID = 9600000000001 THEN 'FTCE'                                
  WHEN FACUL.ID = 9600000000002 THEN 'FCHS'
  WHEN FACUL.ID = 9600000000003 THEN 'FCBS'
  WHEN FACUL.ID = 9600000000004 THEN 'LACCE'
  WHEN FACUL.ID = 9600000000005 THEN 'FD' 
  END                                                                    AS SGL_DEPARTAMENTO,
  NULL                                                                   AS COD_AREA_CONHECIMENTO_EXT,
  NULL                                                                   AS NOM_AREA_CONHECIMENTO,
  NULL                                                                   AS COD_HABILITACAO_INEP,
  TO_CHAR(RECCURSO.CAMPUS_ID)                                            AS COD_CAMPUS_EXT,
  NULL                                                                   AS COD_CAMPUS_INEP,
  DECODE(SUBSTR(RECCURSO.RECONHECIMENTO,1,1),'D','DECRETO','PORTARIA')   AS COD_TPO_RECONHEC_EXT,
  DECODE(SUBSTR(RECCURSO.RECONHECIMENTO,1,1),'D','DECRETO','PORTARIA')   AS DSC_TPO_RECONHEC,
  RECCURSO.DTDOU                                                         AS DAT_INICIAL_RECONHEC,
  RECCURSO.DTFINALREC                                                    AS DAT_FINAL_RECONH,
  RECCURSO.NUMRECONHE                                                    AS NUM_RECONHECIMENTO
FROM
  RECCURSO,
  CURSO,
  MODALIDADE,
  FACUL
WHERE 
  RECCURSO.HABILITACAO IS NOT NULL
AND
  RECCURSO.MODALIDADE_ID=MODALIDADE.ID(+)
AND
  CURSO.ID=RECCURSO.CURSO_ID
AND
  FACUL.ID(+) = CURSO.FACUL_ID  
UNION  
SELECT
  TO_CHAR(CURSO.ID)                                                      AS COD_CURSO_EXT,
  RECCURSO.NOMEDIPLANVERSO                                               AS NOM_CURSO,
  CURSO.CODIGO                                                           AS SGL_CURSO,
  CURSO.ID||' '||DECODE(CURSO.CODIGO,'4003','Sequencial','9999','Bacharelado','4017','Sequencial',MODALIDADE.NOME) AS COD_HABILITACAO_EXT,
  DECODE(CURSO.CODIGO,'4003','Sequencial','4017','Sequencial','9999','Bacharelado',MODALIDADE.NOME)                AS DSC_HABILITACAO,
  DECODE(MODALIDADE.NOME,'Técnico',2, 'Tecnólogo',2,2)                   AS COD_TPO_HABILITACAO,
  NULL                                                                   AS TIPO_HABILITACAO, 
  NULL                                                                   AS COD_CURSO_INEP,
  NULL                                                                   AS OBS_CURSO,
  NOMEATESTADO                                                           AS NOM_CURSO_CERTIFICADO,
  NULL                                                                   AS IND_DIS_ISOLADA,
  NULL                                                                   AS IND_EAD,
  6                                                                      AS TMP_MAXIMO,
  4                                                                      AS TMP_MINIMO,
  '1'                                                                    AS COD_TPO_CURSO,
  FACUL.ID         AS COD_DEPARTAMENTO_EXT,
  FACUL.NOMECOMPLETO                                 AS NOM_DEPARTAMENTO,
  CASE 
  WHEN FACUL.ID = 9600000000001 THEN 'FTCE'                                
  WHEN FACUL.ID = 9600000000002 THEN 'FCHS'
  WHEN FACUL.ID = 9600000000003 THEN 'FCBS'
  WHEN FACUL.ID = 9600000000004 THEN 'LACCE'
  WHEN FACUL.ID = 9600000000005 THEN 'FD' 
  END                                                                    AS SGL_DEPARTAMENTO,
  NULL                                                                   AS COD_AREA_CONHECIMENTO_EXT,
  NULL                                                                   AS NOM_AREA_CONHECIMENTO,
  NULL                                                                   AS COD_HABILITACAO_INEP,
  TO_CHAR(RECCURSO.CAMPUS_ID)                                            AS COD_CAMPUS_EXT,
  NULL                                                                   AS COD_CAMPUS_INEP,
  DECODE(SUBSTR(RECCURSO.RECONHECIMENTO,1,1),'D','DECRETO','PORTARIA')   AS COD_TPO_RECONHEC_EXT,
  DECODE(SUBSTR(RECCURSO.RECONHECIMENTO,1,1),'D','DECRETO','PORTARIA')                                                AS DSC_TPO_RECONHEC,
  RECCURSO.DTDOU                                                                   AS DAT_INICIAL_RECONHEC,
  RECCURSO.DTFINALREC                                                                   AS DAT_FINAL_RECONH,
  RECCURSO.NUMRECONHE                                                              AS NUM_RECONHECIMENTO
FROM
  RECCURSO,
  CURSO,
  MODALIDADE,
  FACUL
WHERE 
  RECCURSO.HABILITACAO IS NULL
AND
  RECCURSO.MODALIDADE_ID=MODALIDADE.ID(+)
AND
  CURSO.ID=RECCURSO.CURSO_ID
AND
  FACUL.ID(+) = CURSO.FACUL_ID    
UNION
SELECT
  TO_CHAR(CURSO.ID)                               AS COD_CURSO_EXT,
  CURSO.NOME                                      AS NOM_CURSO,
  nvl(CURSO.CODIGO,'Pós' )                        AS SGL_CURSO,
  CURSO.ID || ' ' ||  CASE WHEN CURSO.CURSONIVEL_ID = 6200000000002 THEN   'Especialização'  ELSE 'Mestrado' END AS COD_HABILITACAO_EXT,
  CASE WHEN CURSO.CURSONIVEL_ID = 6200000000002 THEN   'Especialização'  ELSE 'Mestrado'                     END AS DSC_HABILITACAO,
  CASE WHEN CURSO.CURSONIVEL_ID = 6200000000002 THEN   5  ELSE 25                                            END AS COD_TPO_HABILITACAO,
  NULL                                 AS TIPO_HABILITACAO,  
  NULL                                 AS COD_CURSO_INEP,
  NULL                                 AS OBS_CURSO,
  CURSO.NOME                           AS NOM_CURSO_CERTIFICADO,
  NULL                                 AS IND_DIS_ISOLADA,
  NULL                                 AS IND_EAD,
  3                                                                   AS TMP_MAXIMO,
  3                                                                   AS TMP_MINIMO,
  DECODE(CURSONIVEL_ID,6200000000002,'2','3')                         AS COD_TPO_CURSO,
  FACUL.ID                                                            AS COD_DEPARTAMENTO_EXT,
  FACUL.NOMECOMPLETO                                                  AS NOM_DEPARTAMENTO,
CASE 
  WHEN FACUL.ID = 9600000000001 THEN 'FTCE'                                
  WHEN FACUL.ID = 9600000000002 THEN 'FCHS'
  WHEN FACUL.ID = 9600000000003 THEN 'FCBS'
  WHEN FACUL.ID = 9600000000004 THEN 'LACCE'
  WHEN FACUL.ID = 9600000000005 THEN 'FD' 
  END                                  AS SGL_DEPARTAMENTO,
  NULL                                 AS COD_AREA_CONHECIMENTO_EXT,
  NULL                                 AS NOM_AREA_CONHECIMENTO,
  NULL                                 AS COD_HABILITACAO_INEP,
  TO_CHAR(CURROFE.CAMPUS_ID)           AS COD_CAMPUS_EXT,
  NULL                                 AS COD_CAMPUS_INEP,
  NULL                                 AS COD_TPO_RECONHEC_EXT,
  NULL                                 AS DSC_TPO_RECONHEC,
  NULL                                 AS DAT_INICIAL_RECONHEC,
  NULL                                 AS DAT_FINAL_RECONH,
  NULL                                 AS NUM_RECONHECIMENTO
FROM
  CURSO,
  CURR,
  CURROFE,
  FACUL
WHERE
  CURSO.CURSONIVEL_ID IN ( 6200000000002,6200000000008 )
AND  
  CURR.CURSO_ID=CURSO.ID
AND
  CURROFE.CURR_ID=CURR.ID
AND
  FACUL.ID(+) = CURSO.FACUL_ID
UNION
SELECT
  TO_CHAR(CURSOEXT.ID)                 AS COD_CURSO_EXT,
  CURSOEXT.NOME                        AS NOM_CURSO,
  NVL(CURSOEXT.CODIGO,'Ext')           AS SGL_CURSO,
  NULL                                 AS COD_HABILITACAO_EXT,
  NULL                                 AS DSC_HABILITACAO,
  NULL                                 AS COD_TPO_HABILITACAO,
  NULL                                 AS TIPO_HABILITACAO,  
  NULL                                 AS COD_CURSO_INEP,
  NULL                                 AS OBS_CURSO,
  CURSOEXT.NOME                        AS NOM_CURSO_CERTIFICADO,
  NULL                                 AS IND_DIS_ISOLADA,
  NULL                                 AS IND_EAD,
  NULL                                 AS TMP_MAXIMO,
  NULL                                 AS TMP_MINIMO,
  NULL                                 AS COD_TPO_CURSO,
  'DCEx'                               AS COD_DEPARTAMENTO_EXT,
  'Departamento de Cursos Extensão e Informática' AS NOM_DEPARTAMENTO,
  'DCEx'                               AS SGL_DEPARTAMENTO,
  NULL                                 AS COD_AREA_CONHECIMENTO_EXT,
  NULL                                 AS NOM_AREA_CONHECIMENTO,
  NULL                                 AS COD_HABILITACAO_INEP,
  NULL                                 AS COD_CAMPUS_EXT,
  NULL                                 AS COD_CAMPUS_INEP,
  NULL                                 AS COD_TPO_RECONHEC_EXT,
  NULL                                 AS DSC_TPO_RECONHEC,
  NULL                                 AS DAT_INICIAL_RECONHEC,
  NULL                                 AS DAT_FINAL_RECONH,
  NULL                                 AS NUM_RECONHECIMENTO
FROM
  CURSOEXT