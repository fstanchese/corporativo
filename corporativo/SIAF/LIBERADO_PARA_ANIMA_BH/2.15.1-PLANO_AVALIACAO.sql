  SELECT  DISTINCT NVL(PLE2.ID,
                    PLE.ID) || CUR.CURSONIVEL_ID || NVL(NTI.NOME,
                                                        '') || CASE
                    WHEN nvl(CDC.SEMPROVA,'off') = 'on'
                         AND CDC.NOTATI_ID IS NULL THEN
                     'S'
                    ELSE
                     'N'
                END AS COD_PLANO_AVALIACAO_EXT,
                CASE
                    WHEN CDC.NOTATI_ID IS NOT NULL
                         AND nvl(CDC.SEMPROVA,'off') = 'off' THEN
                     'S'
                    ELSE
                     'N'
                END AS IND_AVALIACAO,
                CASE
                    WHEN nvl(CDC.SEMPROVA,'off')= 'on'
                         AND CDC.NOTATI_ID IS NULL THEN
                     'S'
                    ELSE
                     'N'
                END AS IND_CONCEITO,
                'S' AS IND_FREQUENCIA,
                NVL(PLE2.ID,
                    PLE.ID) || CUR.CURSONIVEL_ID AS COD_PERIODO_LETIVO_EXT,
                CASE
                    WHEN NVL(NTI.ID,
                             '12300000000003') <> '12300000000001' THEN
                     CUR.ID
                END AS COD_CURSO_EXT,
                CASE
                    WHEN NVL(NTI.ID,
                             '12300000000003') <> '12300000000001' THEN
                     DIS.COD_DISCIPLINA_EXT
                END AS COD_DISCIPLINA_EXT,
                NULL AS COD_TPO_CARGA_HOR_EXT,
                NULL AS COD_TURMA_EXT,
                0 AS NUM_MIN_PONTOS,
                10 AS NUM_MAX_PONTOS,
                25 AS MIN_PERC_FALTA,
                STA.ID AS COD_CONCEITO_EXT,
                STA.NOME AS DSC_CONCEITO,
                NVL(STA.NICK,
                    STA.NOME) AS SGL_CONCEITO,
                NULL AS IND_APROVACAO,
                NULL AS IDT_CONCEITO,
                CAN.ATRIBUTO COD_TPO_AVALIACAO_EXT,
                CAN.ATRIBUTO DSC_TPO_AVALIACAO,
                CAN.ATRIBUTO SGL_TPO_AVALIACAO,
                10 AS VAL_AVALIACAO,
                CASE
                    WHEN CAN.LABEL NOT LIKE '%Subs%'
                         AND CAN.LABEL LIKE '%1%' THEN
                     4 / 10
                    WHEN CAN.LABEL NOT LIKE '%Subs%'
                         AND CAN.LABEL LIKE '%2%' THEN
                     6 / 10
                END NUM_PESO_AVALIACAO,
                CASE
                    WHEN CAN.LABEL LIKE '%Subs%'
                         AND CAN.LABEL <> 'Subs' THEN
                     'N' || TO_CHAR(TO_NUMBER(REPLACE(NOTA.AVALIACAO,
                                                      'N',
                                                      '')) - 1)
                    WHEN CAN.LABEL = 'Subs' THEN
                     NOTA_SUBST.AVALIACAO
                END AS COD_TPO_AVALIACAO_SUBST_EXT                          
 FROM GRADALU GRA
  JOIN TURMAOFE TOF
    ON TOF.ID = GRA.TURMAOFE_ID
  JOIN CURRXDISC CDC
    ON CDC.ID = GRA.CURRXDISC_ID
  LEFT JOIN NOTATI NTI
    ON NTI.ID = CDC.NOTATI_ID
  JOIN CURR
    ON CURR.ID = CDC.CURR_ID
  JOIN CURSO CUR
    ON CUR.ID = CURR.CURSO_MIG_ID
  JOIN STATE STA
    ON STA.ID = GRA.STATE_ID    
  LEFT JOIN CURROFE COF
    ON COF.ID = TOF.CURROFE_ID
  LEFT JOIN DISCESP DIS
    ON DIS.ID = TOF.DISCESP_ID
  LEFT JOIN PLETIVO PLE
    ON PLE.ID = COF.PLETIVO_ID
  LEFT JOIN PLETIVO PLE2
    ON PLE2.ID = DIS.PLETIVO_ID
  LEFT JOIN TOXCD TCD 
    ON TCD.TURMAOFE_ID = GRA.ID AND TCD.CURRXDISC_ID = GRA.CURRXDISC_ID
  LEFT JOIN HORAAULA HRA
    ON HRA.TOXCD_ID = TCD.ID
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
                                                     N15))) NOTA_SUBST
    ON GRA.ID = NOTA_SUBST.GRADALU_ID
  JOIN CRIAVALNOTA CAN2
    ON CAN2.CRIAVAL_ID = NOTA_SUBST.CRIAVAL_ID
       AND CAN2.ATRIBUTO = NOTA_SUBST.AVALIACAO
 WHERE CASE
           WHEN NTI.ID = '12300000000004'
                AND NOTA.AVALIACAO = 'N5' THEN
            'S'
           WHEN NTI.ID = '12300000000001'
                AND CAN.LABEL NOT LIKE '%Méd%'
                AND CAN2.LABEL NOT LIKE '%Subs%' THEN
            'S'
           ELSE
            'N'
       END = 'S'
       AND CDC.NOTATI_ID IS NOT NULL
       AND nvl(CDC.SEMPROVA,'off') = 'off' 
       AND GRA.ID = 8800001231033
