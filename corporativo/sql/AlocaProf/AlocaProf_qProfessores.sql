select 
  AlocaProf.*,
  AulaTi_gsRecognize(AulaTi_Id)||' - '||shortname(Professor_gsRecognize(AlocaProf.Professor_01_Id),26)||Decode(AlocaProf.Professor_02_Id,null,'',' - '||Professor_gsRecognize(AlocaProf.Professor_02_Id))||Decode(AlocaProf.Professor_03_Id,null,'',' - '||Professor_gsRecognize(AlocaProf.Professor_03_id))||Decode(DivTurma_Id,null,'',' - '||DivTurma_gsRecognize(DivTurma_Id))||' - '||Decode(State_Id,3000000037001,State_gsRecognize(State_Id),'<font style="color:red">'||State_gsRecognize(State_Id)||'</font>')|| ' -  Última Atualização : ' || to_Char(nvl(AlocaProf.LUPD,AlocaProf.Dt),'dd/mm/yyyy') || ' - ' || ' Usuário: ' || to_Char(AlocaProf.Us)  as recognize,
  shortname(Professor_gsRecognize(AlocaProf.Professor_01_Id),26) as Prof1,
  shortname(Professor_gsRecognize(AlocaProf.Professor_02_Id),26) as Prof2,
  shortname(Professor_gsRecognize(AlocaProf.Professor_03_Id),26) as Prof3,
  shortname(Professor_gsRecognize(AlocaProf.Professor_04_Id),26) as Prof4,
  shortname(Professor_gsRecognize(AlocaProf.Professor_05_Id),26) as Prof5,
  shortname(Professor_gsRecognize(AlocaProf.Professor_06_Id),26) as Prof6,
  divturma_gsrecognize(alocaprof.divturma_id) as divturma,
  substr(AulaTi_gsRecognize(AulaTi_Id),1,1) as aulati
from
  AlocaProf
where
  (
    p_State_Id is null
    or
    AlocaProf.State_Id = nvl ( p_State_Id , 0 )
  )
and
  AlocaProf.Turma_Id = nvl ( p_Turma_Id , 0 )
and
  AlocaProf.CurrXDisc_Id = nvl ( p_CurrXDisc_Id , 0 )
and
  AlocaProf.PLetivo_Id = nvl ( p_PLetivo_Id , 0 )
order by AulaTi_Id,DivTurma_Id