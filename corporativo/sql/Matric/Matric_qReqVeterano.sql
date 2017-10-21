select
  WPessoa.Codigo as RA,
  initcap(WPessoa.Nome) as NomeAluno,
  CurrNomeHist || DECODE(CurrNivelDesc,NULL,NULL,' - '||CurrNivelDesc) as NomeCurso,
  WPessoa.Id as WPessoa_Id,
  null as ProUni,
  null as PU,
  null as percentural,
  tempeschab.curr_id as curr_eschab_id,
  curr.id as curr_pai_id,
  ' - '||Periodo_gsRecognize(Turma.Periodo_Id) as Periodo,
  duracxci.sequencia as serie,
  currofe.campus_id as campus_Id,
  ' - '||campus_gsrecognize(currofe.campus_Id) as campus,
  1 as prioridade
from
  wpessoa,
  curr,
  duracxci,
  turma,
  matric,
  turmaofe,
  currofe,
  tempeschab
where
  tempeschab.matric_id (+) = matric.id
and
  wpessoa.id=matric.wpessoa_id
and
  duracxci.id=turma.duracxci_id
and
  turma.id=turmaofe.turma_id
and
  (
    matric.state_id in ( 3000000002002,3000000002005,3000000002010,3000000002011 )
    or
    ( matric.state_id = 3000000002012 and curr_gnproximaserie( Curr.Id , DuracXCi.Sequencia ) is not null )
  )
and
  matricti_id=8300000000001
and
  turmaofe.id=matric.turmaofe_id
and
  curr.id = currofe.curr_id
and
  currofe.id=turmaofe.currofe_id
and
  currofe.pletivo_id=7200000000082
and
  (
     p_WPessoa_Id is null
     or
     Matric.wpessoa_id = nvl( p_WPessoa_Id ,0)
   )
union
select
  WPessoa.Codigo as RA,
  initcap(WPessoa.Nome) as NomeAluno,
  CurrNomeHist || DECODE(CurrNivelDesc,NULL,NULL,' - '||CurrNivelDesc) as NomeCurso,
  WPessoa.Id as WPessoa_Id,
  'PROUNI' as ProUni,
  tempprouni.percentual||'P' as PU,
  tempprouni.percentual,
  tempeschab.curr_id as curr_eschab_id,
  curr.id as curr_pai_id,
  ' - '||Periodo_gsRecognize(Turma.Periodo_Id) as Periodo,
  duracxci.sequencia as serie,
  currofe.campus_id as campus_Id,
  ' - '||campus_gsrecognize(currofe.campus_Id) as campus,
  1 as prioridade
from
  wpessoa,
  curr,
  duracxci,
  turma,
  matric,
  turmaofe,
  currofe,
  tempprouni,
  tempeschab
where
  (
    ( (matric.state_id in ( 3000000002002,3000000002005,3000000002010,3000000002011,3000000002012 )) )
    or
    matric.state_id = 3000000002005
  )
and
  tempeschab.matric_id (+) = matric.id
and
  wpessoa.id=matric.wpessoa_id
and
  tempprouni.dttermino>sysdate
and
  tempprouni.pletivo_id=7200000000083
and
  matric.wpessoa_id=tempprouni.wpessoa_id
and
  duracxci.id=turma.duracxci_id
and
  turma.id=turmaofe.turma_id
and
  matricti_id=8300000000001
and
  turmaofe.id=matric.turmaofe_id
and
  curr.id = currofe.curr_id
and
  currofe.id=turmaofe.currofe_id
and
  currofe.pletivo_id=7200000000082
and
  (
     p_WPessoa_Id is null
     or
     Matric.wpessoa_id = nvl( p_WPessoa_Id ,0)
   )
union
(
select
  WPessoa.Codigo as RA,
  initcap(WPessoa.Nome) as NomeAluno,
  CurrNomeHist || DECODE(CurrNivelDesc,NULL,NULL,' - '||CurrNivelDesc) as NomeCurso,
  WPessoa.Id as WPessoa_Id,
  null as ProUni,
  null as PU,
  null as percentural,
  null as curr_eschab_id,
  curr.id as curr_pai_id,
  ' - '||Periodo_gsRecognize(Turma.Periodo_Id) as Periodo,
  duracxci.sequencia as serie,
  currofe.campus_id as campus_Id,
  ' - '||campus_gsrecognize(currofe.campus_Id) as campus,
  0 as prioridade
from
  wpessoa,
  curr,
  duracxci,
  turma,
  turmaofe,
  currofe,
  coordpr
where
  duracxci.id=turma.duracxci_id
and
  turma.id=turmaofe.turma_id
and
  turmaofe.id=coordpr.turmaofe_destino_id
and
  curr.id = currofe.curr_id
and
  currofe.id=coordpr.currofe_id
and
  wpessoa.id=coordpr.wpessoa_Id
and
  coordpr.state_id=3000000004004
and
  CoordPr.PLetivo_Id = 7200000000083
and
  (
     p_WPessoa_Id is null
     or
     CoordPr.WPessoa_Id = nvl( p_WPessoa_Id ,0)
  )
)
order by 14,12,7,3,2