SELECT DISTINCT 
  EQU.ID COD_EQUIVALENCIA_EXT,
  NULL COD_CURSO_EXT,
  NULL COD_GRD_CURRICULAR_EXT,
  TDI.COD_DISCIPLINA_EXT COD_DISCIPLINA_EXT,
  NULL COD_CURSO_EQUIV_EXT,
  NULL COD_GRD_CURRICULAR_EQUIV_EXT,
  TDI2.COD_DISCIPLINA_EXT COD_DISCIPLINA_EQUIV_EXT,
  NULL DAT_INICIO_EQUIV,
  NULL DAT_FINAL_EQUIV
FROM
   CXDEQUI EQU
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
                 0) > 0) TDI ON EQU.CURRXDISC_ID = TDI.CURRXDISC_ID
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
                 0) > 0) TDI2 ON EQU.CURRXDISC_EQUI_ID = TDI2.CURRXDISC_ID           
           JOIN CURRXDISC CDC ON CDC.ID = EQU.CURRXDISC_ID
