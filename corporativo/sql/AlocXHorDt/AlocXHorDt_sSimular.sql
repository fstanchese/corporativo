oParameters ( p_O_Data p_Turma_Id )
oInternalParameters ( p_O_Option p_AlocaProf_Id p_O_Numero p_State_Id p_AlocXHorDt_Id p_AlocXHor_AlocaProf_Id p_AlocXHor_Indice 
p_AlocXHor_Horario_01_Id p_AlocXHor_Horario_02_Id p_AlocXHor_Horario_03_Id p_AlocXHor_Horario_04_Id p_AlocXHor_Horario_05_Id 
p_AlocXHor_Horario_06_Id p_Professor_Id p_AlocXHor_Id )

AlocXHor_qProfessor.fetch

oC ( v_n01_nulo := 0; )
AlocXHorDt_qSimular.loop
(
  oC ( 
    v_n01_nulo               := 0;
    p_AlocXHorDt_Id          := null;
    p_AlocaProf_Id           := null;
    p_AlocXHor_AlocaProf_Id  := null;
    p_O_Numero               := null;
    p_AlocXHor_Indice        := null;
    p_AlocXHor_Horario_01_Id := null;
    p_AlocXHor_Horario_02_Id := null;
    p_AlocXHor_Horario_03_Id := null;
    p_AlocXHor_Horario_04_Id := null;
    p_AlocXHor_Horario_05_Id := null;
    p_AlocXHor_Horario_06_Id := null;
    p_Professor_Id           := null;
    p_O_Option               := null;

    p_AlocXHorDt_Id          := AlocXHorDt_qSimular.Id;
    p_AlocaProf_Id           := AlocXHorDt_qSimular.AlocaProf_Id;
    p_AlocXHor_AlocaProf_Id  := AlocXHorDt_qSimular.AlocaProf_Id;
    p_O_Numero               := AlocXHorDt_qSimular.Indice;
    p_AlocXHor_Indice        := AlocXHorDt_qSimular.Indice;
    p_AlocXHor_Horario_01_Id := AlocXHorDt_qSimular.Horario_01_Id; 
    p_AlocXHor_Horario_02_Id := AlocXHorDt_qSimular.Horario_02_Id; 
    p_AlocXHor_Horario_03_Id := AlocXHorDt_qSimular.Horario_03_Id; 
    p_AlocXHor_Horario_04_Id := AlocXHorDt_qSimular.Horario_04_Id; 
    p_AlocXHor_Horario_05_Id := AlocXHorDt_qSimular.Horario_05_Id; 
    p_AlocXHor_Horario_06_Id := AlocXHorDt_qSimular.Horario_06_Id; 
    p_Professor_Id           := AlocXHorDt_qSimular.Professor_Id; 
  )

  oC ( p_AlocXHor_Id := null; )  
  oC ( open cAlocXHor_qProfessor(p_AlocaProf_Id,p_O_Numero); fetch cAlocXHor_qProfessor into AlocXHor_qProfessor; )
  oIf ( (cAlocXHor_qProfessor%NOTFOUND)
    oC ( p_AlocXHor_Id := null; p_O_Option := 'insert'; )
  oElse
    oC ( p_AlocXHor_AlocaProf_Id := null; p_AlocXHor_Indice := null; )
    oC ( p_AlocXHor_Id  := AlocXHor_qProfessor.Id; p_O_Option := 'update'; )   
  )
  oC ( close cAlocXHor_qProfessor;  )
  
  oC ( AlocXHor_sIUD(p_O_Option,p_AlocXHor_Id,p_AlocaProf_Id,p_O_Numero,p_AlocXHor_Horario_01_Id,p_AlocXHor_Horario_02_Id,p_AlocXHor_Horario_03_Id,p_AlocXHor_Horario_04_Id); )
  oIf ( (p_AlocXHor_Horario_01_Id is null)
    oC ( v_n01_nulo := v_n01_nulo + 1; )
    oC ( update alocxhor set horario_01_id = null where indice=p_O_Numero and alocaprof_id = p_AlocaProf_Id; )
  )  
  oIf ( (p_AlocXHor_Horario_02_Id is null)
    oC ( v_n01_nulo := v_n01_nulo + 1; )
    oC ( update alocxhor set horario_02_id = null where indice=p_O_Numero and alocaprof_id = p_AlocaProf_Id; )
  )  
  oIf ( (p_AlocXHor_Horario_03_Id is null)
    oC ( v_n01_nulo := v_n01_nulo + 1; )
    oC ( update alocxhor set horario_03_id = null where indice=p_O_Numero and alocaprof_id = p_AlocaProf_Id; )
  )  
  oIf ( (p_AlocXHor_Horario_04_Id is null)
    oC ( v_n01_nulo := v_n01_nulo + 1; )
    oC ( update alocxhor set horario_04_id = null where indice=p_O_Numero and alocaprof_id = p_AlocaProf_Id; )
  )  
  oIf ( (p_AlocXHor_Horario_05_Id is null)
    oC ( v_n01_nulo := v_n01_nulo + 1; )
    oC ( update alocxhor set horario_05_id = null where indice=p_O_Numero and alocaprof_id = p_AlocaProf_Id; )
  )  
  oIf ( (p_AlocXHor_Horario_06_Id is null)
    oC ( v_n01_nulo := v_n01_nulo + 1; )
    oC ( update alocxhor set horario_06_id = null where indice=p_O_Numero and alocaprof_id = p_AlocaProf_Id; )
  )  

  AlocaProf_qId.fetch
  oIf ( (p_O_Numero=1 and nvl(AlocaProf_qId.Professor_01_Id , 0) != p_Professor_Id) 
    oC ( update alocaprof set Professor_01_Id = p_Professor_Id where id = p_AlocaProf_Id; )
  )  
  oIf ( (p_O_Numero=2 and nvl(AlocaProf_qId.Professor_02_Id , 0) != p_Professor_Id) 
    oC ( update alocaprof set Professor_02_Id = p_Professor_Id where id = p_AlocaProf_Id; )
  )  
  oIf ( (p_O_Numero=3 and nvl(AlocaProf_qId.Professor_03_Id , 0) != p_Professor_Id) 
    oC ( update alocaprof set Professor_03_Id = p_Professor_Id where id = p_AlocaProf_Id; )
  )  
  oIf ( (p_O_Numero=4 and nvl(AlocaProf_qId.Professor_04_Id , 0) != p_Professor_Id) 
    oC ( update alocaprof set Professor_04_Id = p_Professor_Id where id = p_AlocaProf_Id; )
  )  
  oIf ( (p_O_Numero=5 and nvl(AlocaProf_qId.Professor_05_Id , 0) != p_Professor_Id) 
    oC ( update alocaprof set Professor_05_Id = p_Professor_Id where id = p_AlocaProf_Id; )
  )  
  oIf ( (p_O_Numero=6 and nvl(AlocaProf_qId.Professor_06_Id , 0) != p_Professor_Id) 
    oC ( update alocaprof set Professor_06_Id = p_Professor_Id where id = p_AlocaProf_Id; )
  )  
  AlocXHor_qJunto.loop
  (
    oC ( alocaprof_ssincronizar( AlocXHor_qJunto.ALOCAPROF_JUNTO_ID , AlocXHor_qJunto.ALOCAPROF_ID , AlocXHor_qJunto.INDICE); )
    oC ( alocaprof_shoraaula( AlocXHor_qJunto.ALOCAPROF_ID , AlocXHor_qJunto.INDICE ); )
  )

  oC ( alocaprof_shoraaula( p_AlocaProf_Id , p_O_Numero ); )

)
