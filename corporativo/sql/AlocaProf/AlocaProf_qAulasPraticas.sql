select
  Turma.Codigo as CodTurma,
  Disc.Codigo  as CodDisc,
  Disc.Nome    as NomeDisc,
  DivTurma_gsRecognize(AlocaProf.DivTurma_Id) as DivTurma,
  AlocaProf.CurrXDisc_Id as CurrXDisc_Id,
  Professor_gsRecognize(Professor_01_Id) as Professor
from
  alocaprof,
  turma,
  currxdisc,
  disc,
  toxcd,
  turmaofe,
  currofe,
  horaaula
where 
  horaaula.divturma_id=alocaprof.divturma_id
and
  horaaula.toxcd_id=toxcd.id
and
  TurmaOfe.CurrOfe_Id = CurrOfe.Id
and
  TOXCD.CurrXDisc_Id = AlocaProf.CurrXDisc_Id
and
  TurmaOfe.Turma_Id = AlocaProf.Turma_Id
and
  TOXCD.TurmaOfe_Id = TurmaOfe.Id
and
  alocaprof.divturma_id is not null
and
  disc.id = currxdisc.disc_id
and
  currxdisc.id=alocaprof.currxdisc_id
and
  turma.id=alocaprof.turma_id
and
  alocaprof.aulati_id=13300000000002
and
  alocaprof.state_id=3000000037001
and
  alocaprof.turma_id = nvl ( p_Turma_Id , 0 )
and
  alocaprof.pletivo_id = nvl ( p_PLetivo_Id , 0 )
and
  currofe.pletivo_id = nvl ( p_PLetivo_Id , 0 )
group by Turma.Codigo,Disc.Codigo,Disc.Nome,AlocaProf.DivTurma_Id,AlocaProf.CurrXDisc_Id,Professor_01_Id
order by 1,2,4

