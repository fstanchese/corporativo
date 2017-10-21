select  
  turmaofe.turma_id                     as turma_id,
  toxcd.id                              as toxcd_id,
  alocaprof.aulati_id                   as aulati_id,
  alocaprof.divTurma_id                 as divturma_id,
  alocaprof.currxdisc_id                as currxdisc_id  
from
  curso,
  alocaprof,
  turma,
  toxcd,
  turmaofe,
  currofe,
  currxdisc,
  disc
where
  disc.id=currxdisc.disc_id
and
  alocaprof.currxdisc_id=currxdisc.id
and
  alocaprof.aulati_id=13300000000002
and
  turma.curso_id=curso.id
and
  TurmaOfe.CurrOfe_Id = CurrOfe.Id
and
  TOXCD.CurrXDisc_Id = AlocaProf.CurrXDisc_Id
and
  TurmaOfe.Turma_Id = AlocaProf.Turma_Id
and
  TOXCD.TurmaOfe_Id = TurmaOfe.Id
and
  alocaprof.turma_id = turma.Id
and
  alocaprof.state_id=3000000037001
and
  currofe.pletivo_id = nvl ( p_PLetivo_Id , 0 )
and
  alocaprof.pletivo_id = nvl ( p_PLetivo_Id , 0 ) 
order by curso.nome,turma.codigo,disc.codigo,alocaprof.divturma_id
