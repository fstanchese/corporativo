select
  AlocaProf.*,
  AulaTi_gsRecognize(AlocaProf.AulaTi_Id) as TipoAula,
  Turma.Periodo_Id as Periodo_Id,
  professor_gsrecognize(professor_01_id) as professor_01_id_r,
  professor_gsrecognize(professor_02_id) as professor_02_id_r,
  professor_gsrecognize(professor_03_id) as professor_03_id_r,
  professor_gsrecognize(professor_04_id) as professor_04_id_r,
  professor_gsrecognize(professor_05_id) as professor_05_id_r,
  professor_gsrecognize(professor_06_id) as professor_06_id_r,
  Turma_gsRecognize(Turma_Id)||' - '||CurrXDisc_gsRetCodDisc(CurrXDisc_Id)||Decode(DivTurma_Id,null,'',' - '||DivTurma_gsRecognize(DivTurma_Id)) as Recognize
from
  AlocaProf,
  Turma
where
  AlocaProf.Turma_Id = Turma.Id
and
  AlocaProf.Id = nvl ( p_AlocaProf_Id , 0 ) 

