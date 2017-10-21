SELECT 
MAT.WPESSOA_ID || NVL(CURR2.CURSO_MIG_ID,
                                      CURR.CURSO_MIG_ID) || CASE
                    WHEN NVL(CUR2.CURSONIVEL_ID,
                             CUR.CURSONIVEL_ID) = 6200000000002 THEN
                     NVL(CUR2.ID,
                         CUR.ID) || ' ' || 'Especialização'
                    WHEN NVL(CUR2.CURSONIVEL_ID,
                             CUR.CURSONIVEL_ID) = 6200000000008
                         AND NVL(CUR2.NOME,
                                 CUR.NOME) NOT LIKE '%Doutorado%' THEN
                     NVL(CUR2.ID,
                         CUR.ID) || ' ' || 'Mestrado'
                    WHEN NVL(CUR2.CURSONIVEL_ID,
                             CUR.CURSONIVEL_ID) = 6200000000008
                         AND NVL(CUR2.NOME,
                                 CUR.NOME) LIKE '%Doutorado%' THEN
                     NVL(CUR2.ID,
                         CUR.ID) || ' ' || 'Doutorado'
                    WHEN NVL(CUR2.CURSONIVEL_ID,
                             CUR.CURSONIVEL_ID) = 6200000000015 THEN
                     NVL(CUR2.ID,
                         CUR.ID) || ' ' || 'Tecnico'
                    WHEN NVL(CUR2.CURSONIVEL_ID,
                             CUR.CURSONIVEL_ID) = 6200000000010 THEN
                     NVL(CUR2.ID,
                         CUR.ID) || ' ' || 'Sequencial'
                    WHEN NVL(CUR2.CURSONIVEL_ID,
                             CUR.CURSONIVEL_ID) = 6200000000004 THEN
                     NVL(CUR2.ID,
                         CUR.ID) || ' ' || 'Extensão'
                    WHEN NVL(RCU2.HABILITACAO,
                             RCU.HABILITACAO) IS NOT NULL
                         AND NVL(CUR2.CURSONIVEL_ID,
                                 CUR.CURSONIVEL_ID) NOT IN (6200000000002,
                                                                6200000000008) THEN
                     NVL(CUR2.ID,
                         CUR.ID) || ' ' || NVL(RCU2.HABILITACAO,
                                               RCU.HABILITACAO)
                    WHEN NVL(RCU2.HABILITACAO,
                             RCU.HABILITACAO) IS NULL
                         AND NVL(CUR2.CURSONIVEL_ID,
                                 CUR.CURSONIVEL_ID) NOT IN (6200000000002,
                                                                6200000000008)
                         AND DECODE(NVL(CUR2.CODIGO,
                                        CUR.CODIGO),
                                    '4003',
                                    'Sequencial',
                                    '9999',
                                    'Bacharelado',
                                    '4017',
                                    'Tecnólogo',
                                    NVL(MOD2.NOME,
                                        MOD.NOME)) IS NOT NULL THEN
                     NVL(CUR2.ID,
                         CUR.ID) || ' ' || DECODE(NVL(CUR2.CODIGO,
                                                      CUR.CODIGO),
                                                  '4003',
                                                  'Sequencial',
                                                  '9999',
                                                  'Bacharelado',
                                                  '4017',
                                                  'Tecnólogo',
                                                  NVL(MOD2.NOME,
                                                      MOD.NOME))
                
                    ELSE
                     NVL(CUR2.ID,
                         CUR.ID) || ' ' || 'Bacharelado'
                END || NVL(COF2.PERIODO_ID,
                           COF.PERIODO_ID) || NVL(COF2.CAMPUS_ID,
                                                  COF.CAMPUS_ID) COD_ALUNO_EXT,
                TO_CHAR(TOF.ID) || DIS.COD_DISCIPLINA_EXT || NVL(DIVTURMA_ID,
                                                                 '') AS COD_TURMA_EXT,  
      NVL(PLE2.ID,
                    PLE.ID) || CUR.CURSONIVEL_ID || NVL(NTI.NOME,
                                                        '') || CASE
                    WHEN nvl(CDC.SEMPROVA,'off') = 'on'
                         AND CDC.NOTATI_ID IS NULL THEN
                     'S'
                    ELSE
                     'N'
                END AS COD_PLANO_AVALIACAO_EXT,
    CASE WHEN CASE
                    WHEN nvl(CDC.SEMPROVA,'off')= 'on'
                         AND CDC.NOTATI_ID IS NULL THEN
                     'S'
                    ELSE
                     'N'
                END = 'S' THEN 'AU' ELSE CAN.ATRIBUTO END COD_TPO_AVALIACAO_EXT,
    '' COD_CATEG_AVALIACAO_EXT,
    TRUNC(SYSDATE) DAT_AVALIACAO,
    10 VAL_AVALIACAO,
    replace(TRIM(NOTA.nota),',','.') NOTA,
    CASE WHEN CASE
                    WHEN nvl(CDC.SEMPROVA,'off')= 'on'
                         AND CDC.NOTATI_ID IS NULL THEN
                     'S'
                    ELSE
                     'N'
                END  = 'S' THEN 
        CASE WHEN replace(TRIM(NOTA.nota),',','.') <6 THEN 'A' ELSE 'R' END  
    END DSC_CONCEITO           
 FROM GRADALU GRA
  JOIN TURMAOFE TOF
    ON TOF.ID = GRA.TURMAOFE_ID
  JOIN CURRXDISC CDC
    ON CDC.ID = GRA.CURRXDISC_ID
  LEFT JOIN NOTATI NTI
    ON NTI.ID = CDC.NOTATI_ID    
  JOIN MATRIC MAT
    ON MAT.ID = GRA.MATRIC_ID
  JOIN MATRICTI TIP
    ON TIP.ID = MAT.MATRICTI_ID
  JOIN TURMAOFE TOF2
    ON TOF2.ID = MAT.TURMAOFE_ID
  JOIN STATE STA
    ON GRA.STATE_ID = STA.ID
  JOIN (SELECT GRA.WPESSOA_ID,
               GRA.TURMAOFE_ID,
               GRA.CURRXDISC_ID,
               MIN(HRA.ID) HORAAULA_ID
          FROM GRADALU GRA
          JOIN TURMAOFE TOF
            ON TOF.ID = GRA.TURMAOFE_ID
          JOIN TOXCD TCD
            ON TCD.TURMAOFE_ID = TOF.ID
               AND TCD.CURRXDISC_ID = GRA.CURRXDISC_ID
          JOIN CURRXDISC CDC
            ON CDC.ID = GRA.CURRXDISC_ID
          LEFT JOIN HORAAULA HRA
            ON HRA.TOXCD_ID = TCD.ID
        WHERE NVL(HRA.AULATI_ID,0) = NVL((
              SELECT MIN(HRA2.AULATI_ID)
              FROM HORAAULA HRA2
              WHERE HRA2.TOXCD_ID = TCD.ID
        ),0)
         GROUP BY GRA.WPESSOA_ID,
                  GRA.TURMAOFE_ID,
                  GRA.CURRXDISC_ID) TAB
    ON TAB.WPESSOA_ID = GRA.WPESSOA_ID
       AND TAB.TURMAOFE_ID = GRA.TURMAOFE_ID
       AND GRA.CURRXDISC_ID = TAB.CURRXDISC_ID
  LEFT JOIN CURROFE COF
    ON COF.ID = TOF.CURROFE_ID
  LEFT JOIN DISCESP DIS
    ON DIS.ID = TOF.DISCESP_ID
  LEFT JOIN PLETIVO PLE
    ON PLE.ID = COF.PLETIVO_ID
  LEFT JOIN PLETIVO PLE2
    ON PLE2.ID = DIS.PLETIVO_ID
  LEFT JOIN CURR
    ON CURR.ID = COF.CURR_ID
  LEFT JOIN CURSO CUR
    ON CUR.ID = CURR.CURSO_MIG_ID
  LEFT JOIN RECCURSO RCU
    ON RCU.CURSO_ID = CUR.ID
       AND RCU.ID = COF.RECCURSO_ID
  LEFT JOIN MODALIDADE MOD
    ON MOD.ID = RCU.MODALIDADE_ID
  LEFT JOIN MATRIC MAT2
    ON MAT2.ID = MAT.MATRIC_PAI_ID
  LEFT JOIN TURMAOFE TOF3
    ON TOF3.ID = MAT2.TURMAOFE_ID
  LEFT JOIN CURROFE COF2
    ON COF2.ID = TOF3.CURROFE_ID
  LEFT JOIN CURR CURR2
    ON CURR2.ID = COF2.CURR_ID
  LEFT JOIN CURSO CUR2
    ON CUR2.ID = CURR2.CURSO_MIG_ID
  LEFT JOIN RECCURSO RCU2
    ON RCU2.CURSO_ID = CUR2.ID
       AND RCU2.ID = COF.RECCURSO_ID
  LEFT JOIN MODALIDADE MOD2
    ON MOD2.ID = RCU2.MODALIDADE_ID
  JOIN TOXCD TCD
    ON TCD.TURMAOFE_ID = TOF.ID
       AND TCD.CURRXDISC_ID = GRA.CURRXDISC_ID
  JOIN CURRXDISC CDC
    ON CDC.ID = GRA.CURRXDISC_ID
  LEFT JOIN HORAAULA HRA
    ON HRA.TOXCD_ID = TCD.ID
       AND NVL(TAB.HORAAULA_ID,
               0) = NVL(HRA.ID,
                            0)
  JOIN (
      SELECT DISTINCT TO_CHAR(CUR.ID) || TO_CHAR(DIS.ID) || ((PLE.SEMANAS * NVL(CHSEMANALTEORIA,
                                                                                0)) || (PLE.SEMANAS * NVL(CHSEMANALPRATICA,
                                                                                                          0)) || (PLE.SEMANAS * NVL(CHSEMANALLAB,
                                                                                                                                    0)) || (PLE.SEMANAS * NVL(CHSEMANALEXERC,
                                                                                                                                                              0))) AS COD_DISCIPLINA_EXT,
                      DIS.NOME AS NOM_DISCIPLINA,
                      'T' AS COD_TPO_CARGA_HOR_EXT,
                      CCD.ID CURRXDISC_ID,
                      PLE.SEMANAS,
                      TO_CHAR(DIS.ID) DISCIPLINA
        FROM CURRXDISC CCD
        JOIN CURR CURR
          ON CCD.CURR_ID = CURR.ID
        JOIN (SELECT DISTINCT CDC.ID CURRXDISC_ID,
                              NVL(PLE2.ID,
                                  PLE.ID) PLETIVO_ID,
                              CASE
                                  WHEN NVL(PLE2.SEMANAS,
                                           PLE.SEMANAS) IS NULL
                                       AND NVL(CIC2.NOME,
                                               CIC.NOME) = 'Semestral' THEN
                                   20
                                  ELSE
                                   NVL(PLE2.SEMANAS,
                                       PLE.SEMANAS)
                              END SEMANAS
                FROM GRADALU GRA
                JOIN TURMAOFE TOF
                  ON GRA.TURMAOFE_ID = TOF.ID
                JOIN CURRXDISC CDC
                  ON CDC.ID = GRA.CURRXDISC_ID
                LEFT JOIN CURROFE COF
                  ON TOF.CURROFE_ID = COF.ID
                LEFT JOIN DISCESP DIS
                  ON DIS.ID = TOF.DISCESP_ID
                LEFT JOIN PLETIVO PLE
                  ON PLE.ID = COF.PLETIVO_ID
                LEFT JOIN CICLO CIC
                  ON CIC.ID = PLE.CICLO_ID
                LEFT JOIN PLETIVO PLE2
                  ON PLE2.ID = DIS.PLETIVO_ID
                LEFT JOIN CICLO CIC2
                  ON CIC2.ID = PLE2.CICLO_ID) PLE
          ON CCD.ID = PLE.CURRXDISC_ID
        JOIN DISC DIS
          ON DIS.ID = CCD.DISC_ID
        JOIN CURSO CUR
          ON CUR.ID = CURR.CURSO_MIG_ID
        LEFT JOIN DISCCAT DIC
          ON DIC.ID = CCD.DISCCAT_ID  
       WHERE  NVL(CHSEMANALTEORIA,
                 0) > 0
             AND NVL(CHTOTAL,
                     0) = 0
          
      UNION ALL
      SELECT DISTINCT TO_CHAR(CUR.ID) || TO_CHAR(DIS.ID) || ((PLE.SEMANAS * NVL(CHSEMANALTEORIA,
                                                                                0)) || (PLE.SEMANAS * NVL(CHSEMANALPRATICA,
                                                                                                          0)) || (PLE.SEMANAS * NVL(CHSEMANALLAB,
                                                                                                                                    0)) || (PLE.SEMANAS * NVL(CHSEMANALEXERC,
                                                                                                                                                              0))) AS COD_DISCIPLINA_EXT,
                      DIS.NOME AS NOM_DISCIPLINA,
                      'P' AS COD_TPO_CARGA_HOR_EXT,
                      CCD.ID CURRXDISC_ID,
                      PLE.SEMANAS,
                      TO_CHAR(DIS.ID) DISCIPLINA
        FROM CURRXDISC CCD
        JOIN CURR CURR
          ON CCD.CURR_ID = CURR.ID
        JOIN (SELECT DISTINCT CDC.ID CURRXDISC_ID,
                              NVL(PLE2.ID,
                                  PLE.ID) PLETIVO_ID,
                              CASE
                                  WHEN NVL(PLE2.SEMANAS,
                                           PLE.SEMANAS) IS NULL
                                       AND NVL(CIC2.NOME,
                                               CIC.NOME) = 'Semestral' THEN
                                   20
                                  ELSE
                                   NVL(PLE2.SEMANAS,
                                       PLE.SEMANAS)
                              END SEMANAS
                FROM GRADALU GRA
                JOIN TURMAOFE TOF
                  ON GRA.TURMAOFE_ID = TOF.ID
                JOIN CURRXDISC CDC
                  ON CDC.ID = GRA.CURRXDISC_ID
                LEFT JOIN CURROFE COF
                  ON TOF.CURROFE_ID = COF.ID
                LEFT JOIN DISCESP DIS
                  ON DIS.ID = TOF.DISCESP_ID
                LEFT JOIN PLETIVO PLE
                  ON PLE.ID = COF.PLETIVO_ID
                LEFT JOIN CICLO CIC
                  ON CIC.ID = PLE.CICLO_ID
                LEFT JOIN PLETIVO PLE2
                  ON PLE2.ID = DIS.PLETIVO_ID
                LEFT JOIN CICLO CIC2
                  ON CIC2.ID = PLE2.CICLO_ID) PLE
          ON CCD.ID = PLE.CURRXDISC_ID
        JOIN DISC DIS
          ON DIS.ID = CCD.DISC_ID
        JOIN CURSO CUR
          ON CUR.ID = CURR.CURSO_MIG_ID
        LEFT JOIN DISCCAT DIC
          ON DIC.ID = CCD.DISCCAT_ID
       WHERE NVL(CHSEMANALPRATICA,
                 0) > 0
             AND NVL(CHTOTAL,
                     0) = 0
      UNION ALL
      SELECT DISTINCT TO_CHAR(CUR.ID) || TO_CHAR(DIS.ID) || ((PLE.SEMANAS * NVL(CHSEMANALTEORIA,
                                                                                0)) || (PLE.SEMANAS * NVL(CHSEMANALPRATICA,
                                                                                                          0)) || (PLE.SEMANAS * NVL(CHSEMANALLAB,
                                                                                                                                    0)) || (PLE.SEMANAS * NVL(CHSEMANALEXERC,
                                                                                                                                                              0))) AS COD_DISCIPLINA_EXT,
                      DIS.NOME AS NOM_DISCIPLINA,
                      'L' AS COD_TPO_CARGA_HOR_EXT,
                      CCD.ID CURRXDISC_ID,
                      PLE.SEMANAS,
                      TO_CHAR(DIS.ID) DISCIPLINA
        FROM CURRXDISC CCD
        JOIN CURR CURR
          ON CCD.CURR_ID = CURR.ID
        JOIN (SELECT DISTINCT CDC.ID CURRXDISC_ID,
                              NVL(PLE2.ID,
                                  PLE.ID) PLETIVO_ID,
                              CASE
                                  WHEN NVL(PLE2.SEMANAS,
                                           PLE.SEMANAS) IS NULL
                                       AND NVL(CIC2.NOME,
                                               CIC.NOME) = 'Semestral' THEN
                                   20
                                  ELSE
                                   NVL(PLE2.SEMANAS,
                                       PLE.SEMANAS)
                              END SEMANAS
                FROM GRADALU GRA
                JOIN TURMAOFE TOF
                  ON GRA.TURMAOFE_ID = TOF.ID
                JOIN CURRXDISC CDC
                  ON CDC.ID = GRA.CURRXDISC_ID
                LEFT JOIN CURROFE COF
                  ON TOF.CURROFE_ID = COF.ID
                LEFT JOIN DISCESP DIS
                  ON DIS.ID = TOF.DISCESP_ID
                LEFT JOIN PLETIVO PLE
                  ON PLE.ID = COF.PLETIVO_ID
                LEFT JOIN CICLO CIC
                  ON CIC.ID = PLE.CICLO_ID
                LEFT JOIN PLETIVO PLE2
                  ON PLE2.ID = DIS.PLETIVO_ID
                LEFT JOIN CICLO CIC2
                  ON CIC2.ID = PLE2.CICLO_ID) PLE
          ON CCD.ID = PLE.CURRXDISC_ID
        JOIN DISC DIS
          ON DIS.ID = CCD.DISC_ID
        JOIN CURSO CUR
          ON CUR.ID = CURR.CURSO_MIG_ID
        LEFT JOIN DISCCAT DIC
          ON DIC.ID = CCD.DISCCAT_ID
       WHERE NVL(CHSEMANALLAB,
                 0) > 0
             AND NVL(CHTOTAL,
                     0) = 0
      UNION ALL
      SELECT DISTINCT TO_CHAR(CUR.ID) || TO_CHAR(DIS.ID) || ((PLE.SEMANAS * NVL(CHSEMANALTEORIA,
                                                                                0)) || (PLE.SEMANAS * NVL(CHSEMANALPRATICA,
                                                                                                          0)) || (PLE.SEMANAS * NVL(CHSEMANALLAB,
                                                                                                                                    0)) || (PLE.SEMANAS * NVL(CHSEMANALEXERC,
                                                                                                                                                              0))) AS COD_DISCIPLINA_EXT,
                      DIS.NOME AS NOM_DISCIPLINA,
                      'E' AS COD_TPO_CARGA_HOR_EXT,
                      CCD.ID CURRXDISC_ID,
                      PLE.SEMANAS,
                      TO_CHAR(DIS.ID) DISCIPLINA
        FROM CURRXDISC CCD
        JOIN CURR CURR
          ON CCD.CURR_ID = CURR.ID
        JOIN (SELECT DISTINCT CDC.ID CURRXDISC_ID,
                              NVL(PLE2.ID,
                                  PLE.ID) PLETIVO_ID,
                              CASE
                                  WHEN NVL(PLE2.SEMANAS,
                                           PLE.SEMANAS) IS NULL
                                       AND NVL(CIC2.NOME,
                                               CIC.NOME) = 'Semestral' THEN
                                   20
                                  ELSE
                                   NVL(PLE2.SEMANAS,
                                       PLE.SEMANAS)
                              END SEMANAS
                FROM GRADALU GRA
                JOIN TURMAOFE TOF
                  ON GRA.TURMAOFE_ID = TOF.ID
                JOIN CURRXDISC CDC
                  ON CDC.ID = GRA.CURRXDISC_ID
                LEFT JOIN CURROFE COF
                  ON TOF.CURROFE_ID = COF.ID
                LEFT JOIN DISCESP DIS
                  ON DIS.ID = TOF.DISCESP_ID
                LEFT JOIN PLETIVO PLE
                  ON PLE.ID = COF.PLETIVO_ID
                LEFT JOIN CICLO CIC
                  ON CIC.ID = PLE.CICLO_ID
                LEFT JOIN PLETIVO PLE2
                  ON PLE2.ID = DIS.PLETIVO_ID
                LEFT JOIN CICLO CIC2
                  ON CIC2.ID = PLE2.CICLO_ID) PLE
          ON CCD.ID = PLE.CURRXDISC_ID
        JOIN DISC DIS
          ON DIS.ID = CCD.DISC_ID
        JOIN CURSO CUR
          ON CUR.ID = CURR.CURSO_MIG_ID
        LEFT JOIN DISCCAT DIC
          ON DIC.ID = CCD.DISCCAT_ID
       WHERE NVL(CHSEMANALEXERC,
                 0) > 0
             AND NVL(CHTOTAL,
                     0) = 0
      UNION ALL
      SELECT TO_CHAR(CUR.ID) || TO_CHAR(DIS.ID) || ((PLE.SEMANAS * NVL(CHSEMANALTEORIA,
                                                                       0)) || (PLE.SEMANAS * NVL(CHSEMANALPRATICA,
                                                                                                 0)) || (PLE.SEMANAS * NVL(CHSEMANALLAB,
                                                                                                                           0)) || (PLE.SEMANAS * NVL(CHSEMANALEXERC,
                                                                                                                                                     0))) AS COD_DISCIPLINA_EXT,
             DIS.NOME AS NOM_DISCIPLINA,
             CASE
                 WHEN DIC.NOME = 'Atividade Prática de Estágio' THEN
                  DIC.NOME
                 WHEN DIC.NOME = 'Atividades Complementares' THEN
                  DIC.NOME
                 WHEN DIC.NOME = 'Atividades Práticas e Complementares' THEN
                  DIC.NOME
                 WHEN DIC.NOME = 'Atividades Teórico-práticas' THEN
                  'Teórico/Prática'
                 WHEN DIC.NOME = 'Básica' THEN
                  'Estágio Supervisionado'
                 WHEN DIC.NOME = 'Docência' THEN
                  'Estágio Supervisionado'
                 WHEN DIC.NOME = 'Estudos Integradores' THEN
                  DIC.NOME
                 WHEN DIC.NOME = 'Estágio Supervisionado' THEN
                  'Estágio Supervisionado'
                 WHEN DIC.NOME = 'Estágio Supervisionado / Trabalho de Conclusão de Curso' THEN
                  'Estágio Supervisionado'
                 WHEN DIC.NOME = 'Estágio Supervisionado e Atividade Prática de Estágio' THEN
                  'Estágio Supervisionado'
                 WHEN DIC.NOME = 'Estágio Supervisionado e Capacitação em Serviço' THEN
                  'Estágio Supervisionado'
                 WHEN DIC.NOME = 'Estágio Supervisionado em Administração Escolar' THEN
                  'Estágio Supervisionado'
                 WHEN DIC.NOME = 'Estágio Supervisionado em Ciências Farmacêuticas' THEN
                  'Estágio Supervisionado'
                 WHEN DIC.NOME = 'Estágio Supervisionado no Ensino Fundamental' THEN
                  'Estágio Supervisionado'
                 WHEN DIC.NOME = 'Estágio Supervisionado no Ensino Médio' THEN
                  'Estágio Supervisionado'
                 WHEN DIC.NOME = 'Estágio Supervisionado nos Ensinos Fundamental e Médio' THEN
                  'Estágio Supervisionado'
                 WHEN DIC.NOME = 'Estágio Supervisionado Obrigatório' THEN
                  'Estágio Supervisionado'
                 WHEN DIC.NOME = 'Estágio Supervisionado/Monografia' THEN
                  'Estágio Supervisionado'
                 WHEN DIC.NOME = 'Monografia' THEN
                  DIC.NOME
                 WHEN DIC.NOME = 'Orientação Acadêmica' THEN
                  DIC.NOME
                 WHEN DIC.NOME = 'Projeto de Fim de Curso' THEN
                  DIC.NOME
                 WHEN DIC.NOME = 'Prática de Ensino sob a forma de Estágio Supervisionado' THEN
                  'Estágio Supervisionado'
                 WHEN DIC.NOME = 'Prática Educacional' THEN
                  DIC.NOME
                 WHEN DIC.NOME = 'Prática Fisioterapêutica Supervisionada' THEN
                  DIC.NOME
                 WHEN DIC.NOME = 'Trabalho' THEN
                  'Estágio Supervisionado'
                 ELSE
                  'Atividades Complementares'
             END AS COD_TPO_CARGA_HOR_EXT,
             CCD.ID CURRXDISC_ID,
             PLE.SEMANAS,
             TO_CHAR(DIS.ID) DISCIPLINA
        FROM CURRXDISC CCD
        JOIN CURR CURR
          ON CCD.CURR_ID = CURR.ID
        JOIN (SELECT DISTINCT CDC.ID CURRXDISC_ID,
                              NVL(PLE2.ID,
                                  PLE.ID) PLETIVO_ID,
                              CASE
                                  WHEN NVL(PLE2.SEMANAS,
                                           PLE.SEMANAS) IS NULL
                                       AND NVL(CIC2.NOME,
                                               CIC.NOME) = 'Semestral' THEN
                                   20
                                  ELSE
                                   NVL(PLE2.SEMANAS,
                                       PLE.SEMANAS)
                              END SEMANAS
                FROM GRADALU GRA
                JOIN TURMAOFE TOF
                  ON GRA.TURMAOFE_ID = TOF.ID
                JOIN CURRXDISC CDC
                  ON CDC.ID = GRA.CURRXDISC_ID
                LEFT JOIN CURROFE COF
                  ON TOF.CURROFE_ID = COF.ID
                LEFT JOIN DISCESP DIS
                  ON DIS.ID = TOF.DISCESP_ID
                LEFT JOIN PLETIVO PLE
                  ON PLE.ID = COF.PLETIVO_ID
                LEFT JOIN CICLO CIC
                  ON CIC.ID = PLE.CICLO_ID
                LEFT JOIN PLETIVO PLE2
                  ON PLE2.ID = DIS.PLETIVO_ID
                LEFT JOIN CICLO CIC2
                  ON CIC2.ID = PLE2.CICLO_ID) PLE
          ON CCD.ID = PLE.CURRXDISC_ID
        JOIN DISC DIS
          ON DIS.ID = CCD.DISC_ID
        JOIN CURSO CUR
          ON CUR.ID = CURR.CURSO_MIG_ID
        LEFT JOIN DISCCAT DIC
          ON DIC.ID = CCD.DISCCAT_ID
       WHERE NVL(CHTOTAL,
                 0) > 0) DIS
    ON DIS.CURRXDISC_ID = GRA.CURRXDISC_ID
       AND DIS.COD_TPO_CARGA_HOR_EXT = (CASE
           WHEN HRA.AULATI_ID = 13300000000001 THEN
            'T'
           WHEN HRA.AULATI_ID = 13300000000002 THEN
            'P'
           WHEN HRA.AULATI_ID = 13300000000003 THEN
            'L'
           ELSE
            DIS.COD_TPO_CARGA_HOR_EXT
       END) 
       AND DIS.SEMANAS = NVL(PLE2.SEMANAS,
                             PLE.SEMANAS)                                 
  JOIN (SELECT ID GRADALU_ID,
               AVALIACAO,
               NOTA,
               CRIAVAL_ID
          FROM GRADALU UNPIVOT(NOTA FOR AVALIACAO IN(N1,
                                                     N2,
                                                     N3,
                                                     N4,
                                                     N5,
                                                     N6,
                                                     N7,
                                                     N8,
                                                     N9,
                                                     N10,
                                                     N11,
                                                     N12,
                                                     N13,
                                                     N14,
                                                     N15))) NOTA
    ON GRA.ID = NOTA.GRADALU_ID
  JOIN CRIAVALNOTA CAN
    ON CAN.CRIAVAL_ID = NOTA.CRIAVAL_ID
       AND CAN.ATRIBUTO = NOTA.AVALIACAO
 WHERE  GRA.ID = 8800001231033
