select
  GradAlu.*,
  DivTurma_gsRecognize(DivTurma_Teoria_Id)               as DivTurma_Teoria_Recognize,
  DivTurma_gsRecognize(DivTurma_Pratica_Id)              as DivTurma_Pratica_Recognize,
  DivTurma_gsRecognize(DivTurma_Lab_Id)                  as DivTurma_Lab_Recognize,
  TurmaOfe_gsRetCodTurma(TurmaOfe_Id)                    as Turma,
  CurrXDisc_gsRetCodDisc(CurrXDisc_Id)                   as Disc,
  CurrXDisc.Disc_Id                                      as Disc_Id,
  CurrXDisc_gsRetDisc(CurrXDisc_Id)                      as Disciplina,
  TurmaOfe_gnRetTurmaTi(TurmaOfe_Id)                     as TurmaTi_Id,
  Curr.Curso_Id                                          as Curso_Id,
  TurmaOfe_gnRetPLetivo(GradAlu.TurmaOfe_Id)             as PLetivo_Id,
  PLetivo_gsRetNome(TurmaOfe_gnRetPLetivo(GradAlu.TurmaOfe_Id))    as PLetivo_Recognize, 
  Curr.Codigo                                            as Curr_Codigo,
  upper(substr(State_gsRecognize(GradAlu.State_Id),1,3)) as State_Abreviado,
  State_gsRecognize(GradAlu.State_Id)                    as Situacao, 
  TurmaOfe_gsRetPLetivo(GradAlu.TurmaOfe_Id)             as PeriodoLetivo,
  Curr.Id                                                as Curr_Id,
  CurrXDisc.NotaTi_Id                                    as NotaTi_Id,
  CurrXDisc_gnSerie(CurrXDisc.Id)                        as Serie,
  currxdisc_gnChTotal(gradalu.currxdisc_id, GradAlu_gnRetPLetivo(GradAlu.Id) , GradAlu.Id )   as ChAnual
from
  Curr,
  CurrXDisc,
  GradAlu
where
  Curr.Id = CurrXDisc.Curr_Id
and
  CurrXDisc.Id = GradAlu.CurrXDisc_Id  
and
  GradAlu.id = nvl( p_GradAlu_Id ,0)
