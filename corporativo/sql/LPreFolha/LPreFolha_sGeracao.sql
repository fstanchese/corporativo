oParameters ( p_TOXCD_Id p_DivTurma_Id p_AulaTi_Id )
oInternalParameters ( p_TurmaOfe_Id p_TurmaTi_Id )

oDoc ( LPreFolha )

oC (
  v_n002_iLinhas  := 1;
  v_n002_Folha    := 1;
  v_b_Cheio       := false;
  select TOXCD_gnRetTurmaOfe(p_TOXCD_Id)      into p_TurmaOfe_Id from dual;  
  select TurmaOfe_gnRetTurmaTi(p_TurmaOfe_Id) into p_TurmaTi_Id  from dual;
)

LPreFolha_qAluno.loop (
  oC (
    if ( v_n002_iLinhas = 1 )  then v_n015_GradAlu_01_Id  := LPreFolha_qAluno.GradAlu_Id; v_b_Cheio := false; end if;
    if ( v_n002_iLinhas = 2 )  then v_n015_GradAlu_02_Id  := LPreFolha_qAluno.GradAlu_Id; v_b_Cheio := false; end if;
    if ( v_n002_iLinhas = 3 )  then v_n015_GradAlu_03_Id  := LPreFolha_qAluno.GradAlu_Id; v_b_Cheio := false; end if;
    if ( v_n002_iLinhas = 4 )  then v_n015_GradAlu_04_Id  := LPreFolha_qAluno.GradAlu_Id; v_b_Cheio := false; end if;
    if ( v_n002_iLinhas = 5 )  then v_n015_GradAlu_05_Id  := LPreFolha_qAluno.GradAlu_Id; v_b_Cheio := false; end if;
    if ( v_n002_iLinhas = 6 )  then v_n015_GradAlu_06_Id  := LPreFolha_qAluno.GradAlu_Id; v_b_Cheio := false; end if;
    if ( v_n002_iLinhas = 7 )  then v_n015_GradAlu_07_Id  := LPreFolha_qAluno.GradAlu_Id; v_b_Cheio := false; end if;
    if ( v_n002_iLinhas = 8 )  then v_n015_GradAlu_08_Id  := LPreFolha_qAluno.GradAlu_Id; v_b_Cheio := false; end if;
    if ( v_n002_iLinhas = 9 )  then v_n015_GradAlu_09_Id  := LPreFolha_qAluno.GradAlu_Id; v_b_Cheio := false; end if;
    if ( v_n002_iLinhas = 10 ) then v_n015_GradAlu_10_Id  := LPreFolha_qAluno.GradAlu_Id; v_b_Cheio := false; end if;
    if ( v_n002_iLinhas = 11 ) then v_n015_GradAlu_11_Id  := LPreFolha_qAluno.GradAlu_Id; v_b_Cheio := false; end if;
    if ( v_n002_iLinhas = 12 ) then v_n015_GradAlu_12_Id  := LPreFolha_qAluno.GradAlu_Id; v_b_Cheio := false; end if;
    if ( v_n002_iLinhas = 13 ) then v_n015_GradAlu_13_Id  := LPreFolha_qAluno.GradAlu_Id; v_b_Cheio := false; end if;
    if ( v_n002_iLinhas = 14 ) then v_n015_GradAlu_14_Id  := LPreFolha_qAluno.GradAlu_Id; v_b_Cheio := false; end if;
    if ( v_n002_iLinhas = 15 ) then v_n015_GradAlu_15_Id  := LPreFolha_qAluno.GradAlu_Id; v_b_Cheio := false; end if;
    if ( v_n002_iLinhas = 16 ) then v_n015_GradAlu_16_Id  := LPreFolha_qAluno.GradAlu_Id; v_b_Cheio := false; end if;
    if ( v_n002_iLinhas = 17 ) then v_n015_GradAlu_17_Id  := LPreFolha_qAluno.GradAlu_Id; v_b_Cheio := false; end if;
    if ( v_n002_iLinhas = 18 ) then v_n015_GradAlu_18_Id  := LPreFolha_qAluno.GradAlu_Id; v_b_Cheio := false; end if;
    if ( v_n002_iLinhas = 19 ) then v_n015_GradAlu_19_Id  := LPreFolha_qAluno.GradAlu_Id; v_b_Cheio := false; end if;
    if ( v_n002_iLinhas = 20 ) then v_n015_GradAlu_20_Id  := LPreFolha_qAluno.GradAlu_Id; v_b_Cheio := false; end if;
    if ( v_n002_iLinhas = 21 ) then v_n015_GradAlu_21_Id  := LPreFolha_qAluno.GradAlu_Id; v_b_Cheio := false; end if;
    if ( v_n002_iLinhas = 22 ) then v_n015_GradAlu_22_Id  := LPreFolha_qAluno.GradAlu_Id; v_b_Cheio := false; end if;
    if ( v_n002_iLinhas = 23 ) then v_n015_GradAlu_23_Id  := LPreFolha_qAluno.GradAlu_Id; v_b_Cheio := false; end if;
    if ( v_n002_iLinhas = 24 ) then v_n015_GradAlu_24_Id  := LPreFolha_qAluno.GradAlu_Id; v_b_Cheio := false; end if;
    if ( v_n002_iLinhas = 25 ) then v_n015_GradAlu_25_Id  := LPreFolha_qAluno.GradAlu_Id; v_b_Cheio := false; end if;
    if ( v_n002_iLinhas = 26 ) then v_n015_GradAlu_26_Id  := LPreFolha_qAluno.GradAlu_Id; v_b_Cheio := false; end if;
    if ( v_n002_iLinhas = 27 ) then v_n015_GradAlu_27_Id  := LPreFolha_qAluno.GradAlu_Id; v_b_Cheio := false; end if;
    if ( v_n002_iLinhas = 28 ) then v_n015_GradAlu_28_Id  := LPreFolha_qAluno.GradAlu_Id; v_b_Cheio := true; end if;

    if ( v_n002_iLinhas = 28 ) then
      v_n002_iLinhas := 1;

      Insert Into LPreFolha (                              --;
        LPre_Id ,                                          --;
        Folha ,                                            --;
        GradAlu_01_Id ,                                    --;
        GradAlu_02_Id ,                                    --;
        GradAlu_03_Id ,                                    --;
        GradAlu_04_Id ,                                    --;
        GradAlu_05_Id ,                                    --;
        GradAlu_06_Id ,                                    --;
        GradAlu_07_Id ,                                    --;
        GradAlu_08_Id ,                                    --;
        GradAlu_09_Id ,                                    --;
        GradAlu_10_Id ,                                    --;
        GradAlu_11_Id ,                                    --;
        GradAlu_12_Id ,                                    --;
        GradAlu_13_Id ,                                    --;
        GradAlu_14_Id ,                                    --;
        GradAlu_15_Id ,                                    --;
        GradAlu_16_Id ,                                    --;
        GradAlu_17_Id ,                                    --;
        GradAlu_18_Id ,                                    --;
        GradAlu_19_Id ,                                    --;
        GradAlu_20_Id ,                                    --;
        GradAlu_21_Id ,                                    --;
        GradAlu_22_Id ,                                    --;
        GradAlu_23_Id ,                                    --;
        GradAlu_24_Id ,                                    --;
        GradAlu_25_Id ,                                    --;
        GradAlu_26_Id ,                                    --;
        GradAlu_27_Id ,                                    --;
        GradAlu_28_Id ,                                    --;
        State_Id                                           --;
        ) values (                                         --;
        LPre_Id.CurrVal ,                                  --;
        v_n002_Folha ,                                     --;
        v_n015_GradAlu_01_Id ,                             --;
        v_n015_GradAlu_02_Id ,                             --;
        v_n015_GradAlu_03_Id ,                             --;
        v_n015_GradAlu_04_Id ,                             --;
        v_n015_GradAlu_05_Id ,                             --;
        v_n015_GradAlu_06_Id ,                             --;
        v_n015_GradAlu_07_Id ,                             --;
        v_n015_GradAlu_08_Id ,                             --;
        v_n015_GradAlu_09_Id ,                             --;
        v_n015_GradAlu_10_Id ,                             --;
        v_n015_GradAlu_11_Id ,                             --;
        v_n015_GradAlu_12_Id ,                             --;
        v_n015_GradAlu_13_Id ,                             --;
        v_n015_GradAlu_14_Id ,                             --;
        v_n015_GradAlu_15_Id ,                             --;
        v_n015_GradAlu_16_Id ,                             --;
        v_n015_GradAlu_17_Id ,                             --;
        v_n015_GradAlu_18_Id ,                             --;
        v_n015_GradAlu_19_Id ,                             --;
        v_n015_GradAlu_20_Id ,                             --;
        v_n015_GradAlu_21_Id ,                             --;
        v_n015_GradAlu_22_Id ,                             --;
        v_n015_GradAlu_23_Id ,                             --;
        v_n015_GradAlu_24_Id ,                             --;
        v_n015_GradAlu_25_Id ,                             --;
        v_n015_GradAlu_26_Id ,                             --;
        v_n015_GradAlu_27_Id ,                             --;
        v_n015_GradAlu_28_Id ,                             --;
        3000000009001                                      --;
      );
      
      v_n002_Folha := v_n002_Folha + 1;

      v_n015_GradAlu_01_Id := null;    
      v_n015_GradAlu_02_Id := null;    
      v_n015_GradAlu_03_Id := null;    
      v_n015_GradAlu_04_Id := null;    
      v_n015_GradAlu_05_Id := null;    
      v_n015_GradAlu_06_Id := null;    
      v_n015_GradAlu_07_Id := null;    
      v_n015_GradAlu_08_Id := null;    
      v_n015_GradAlu_09_Id := null;    
      v_n015_GradAlu_10_Id := null;    
      v_n015_GradAlu_11_Id := null;    
      v_n015_GradAlu_12_Id := null;    
      v_n015_GradAlu_13_Id := null;    
      v_n015_GradAlu_14_Id := null;    
      v_n015_GradAlu_15_Id := null;    
      v_n015_GradAlu_16_Id := null;    
      v_n015_GradAlu_17_Id := null;    
      v_n015_GradAlu_18_Id := null;    
      v_n015_GradAlu_19_Id := null;    
      v_n015_GradAlu_20_Id := null;    
      v_n015_GradAlu_21_Id := null;    
      v_n015_GradAlu_22_Id := null;    
      v_n015_GradAlu_23_Id := null;    
      v_n015_GradAlu_24_Id := null;    
      v_n015_GradAlu_25_Id := null;    
      v_n015_GradAlu_26_Id := null;    
      v_n015_GradAlu_27_Id := null;    
      v_n015_GradAlu_28_Id := null;    
    else
      v_n002_iLinhas := v_n002_iLinhas + 1;
    end if;
  )
)

oC (
  if ( not v_b_Cheio ) then
      Insert Into LPreFolha (                              --;
        LPre_Id ,                                          --;
        Folha ,                                            --;
        GradAlu_01_Id ,                                    --;
        GradAlu_02_Id ,                                    --;
        GradAlu_03_Id ,                                    --;
        GradAlu_04_Id ,                                    --;
        GradAlu_05_Id ,                                    --;
        GradAlu_06_Id ,                                    --;
        GradAlu_07_Id ,                                    --;
        GradAlu_08_Id ,                                    --;
        GradAlu_09_Id ,                                    --;
        GradAlu_10_Id ,                                    --;
        GradAlu_11_Id ,                                    --;
        GradAlu_12_Id ,                                    --;
        GradAlu_13_Id ,                                    --;
        GradAlu_14_Id ,                                    --;
        GradAlu_15_Id ,                                    --;
        GradAlu_16_Id ,                                    --;
        GradAlu_17_Id ,                                    --;
        GradAlu_18_Id ,                                    --;
        GradAlu_19_Id ,                                    --;
        GradAlu_20_Id ,                                    --;
        GradAlu_21_Id ,                                    --;
        GradAlu_22_Id ,                                    --;
        GradAlu_23_Id ,                                    --;
        GradAlu_24_Id ,                                    --;
        GradAlu_25_Id ,                                    --;
        GradAlu_26_Id ,                                    --;
        GradAlu_27_Id ,                                    --;
        GradAlu_28_Id ,                                    --;
        State_Id                                           --;
        ) values (                                         --;
        LPre_Id.CurrVal ,                                  --;
        v_n002_Folha ,                                     --;
        v_n015_GradAlu_01_Id ,                             --;
        v_n015_GradAlu_02_Id ,                             --;
        v_n015_GradAlu_03_Id ,                             --;
        v_n015_GradAlu_04_Id ,                             --;
        v_n015_GradAlu_05_Id ,                             --;
        v_n015_GradAlu_06_Id ,                             --;
        v_n015_GradAlu_07_Id ,                             --;
        v_n015_GradAlu_08_Id ,                             --;
        v_n015_GradAlu_09_Id ,                             --;
        v_n015_GradAlu_10_Id ,                             --;
        v_n015_GradAlu_11_Id ,                             --;
        v_n015_GradAlu_12_Id ,                             --;
        v_n015_GradAlu_13_Id ,                             --;
        v_n015_GradAlu_14_Id ,                             --;
        v_n015_GradAlu_15_Id ,                             --;
        v_n015_GradAlu_16_Id ,                             --;
        v_n015_GradAlu_17_Id ,                             --;
        v_n015_GradAlu_18_Id ,                             --;
        v_n015_GradAlu_19_Id ,                             --;
        v_n015_GradAlu_20_Id ,                             --;
        v_n015_GradAlu_21_Id ,                             --;
        v_n015_GradAlu_22_Id ,                             --;
        v_n015_GradAlu_23_Id ,                             --;
        v_n015_GradAlu_24_Id ,                             --;
        v_n015_GradAlu_25_Id ,                             --;
        v_n015_GradAlu_26_Id ,                             --;
        v_n015_GradAlu_27_Id ,                             --;
        v_n015_GradAlu_28_Id ,                             --;
        3000000009001                                      --;
      );
  end if;
)