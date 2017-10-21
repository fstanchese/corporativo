select 
  AlocaProf.Id as Id,
  Disc.Codigo||' - '||ShortName(Disc.Nome,45)||' - '||DivTurma_gsRecognize(DivTurma_Id)||' - '||AulaTi_gsRecognize(AulaTi_Id)||' - '||Turma_gsRecognize( alocaprof.Turma_Id ) as Recognize
from
  AlocaProf,
  CurrXDisc,
  Disc,
  Turma
where
  Turma.Id = AlocaProf.Turma_Id
and
  CurrXDisc.Disc_Id = Disc.Id
and
  CurrXDisc.Id = AlocaProf.CurrXDisc_Id
and
  AlocaProf.Turma_Id = nvl ( p_Turma_Junto_Id , 0) 
and
  AlocaProf.PLetivo_Id = nvl ( p_PLetivo_Id , 0 )
order by Disc.Codigo,DivTurma_Id
