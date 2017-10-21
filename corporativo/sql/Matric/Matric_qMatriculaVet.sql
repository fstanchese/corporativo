select
  matric.id              as id,
  wpessoa.codigo         as codigo,
  Upper (wpessoa.nome)   as nome,
  Upper (curso.nome)     as curso,
  wpessoa.dtnascto       as dtnascto,
  wpessoa.rgrne          as rgrne,
  wpessoa.pai            as pai,
  wpessoa.mae            as mae,
  wpessoa.foneres        as foneres,
  wpessoa.fonecom        as fonecom,  
  wpessoa.lograd_id      as lograd_id,
  wpessoa.endernum       as endernum,
  wpessoa.email1         as email,
  lograd_gsRecognize(wpessoa.lograd_id) as endereco,
  to_char (matric.carteirinhaVia, '0') as carteirinhaVia,
  turmaofe_gsretpletivo(matric.turmaofe_id)||' - '||curr.codigo||' - '||turmaofe_gsRetCodTurma(Matric.TurmaOfe_id)||' - '||state_gsrecognize(matric.state_id)||' - '||curso.nome as recognize,
  to_char (turma.id-6700000000000, '00000') as turmaSequencia,
  wpessoa.codigo || to_char (pletivo.final+50, 'mmyy') as carteirinhaCodebar,
  to_char (pletivo.final+50, 'Mon/yyyy') as carteirinhaValidade,
  nvl(matric.data,trunc(sysdate)) as datax,
  matric.state_id        as state_id,
  state_gsrecognize(matric.state_id) as situacao,
  curr.id as curr_id,
  duracxci.sequencia as serie,
  curso.id as curso_id
from
  pletivo,
  duracxci,
  turma,
  curr,
  curso,
  currofe,
  turmaofe,
  matric,
  wpessoa
where 
  Matric.State_Id not in ( 3000000002000,3000000002004,3000000002006,3000000002008,3000000002013 )
and
  (  
     p_Ciclo_Id is null
     or
     PLetivo.Ciclo_Id = nvl ( p_Ciclo_Id , 0 )
  )
and
  currofe.pletivo_id = pletivo.id
and
  turma.duracxci_id = duracxci.id (+)
and
  turmaofe.turma_id = turma.id
and
  curr.curso_id = curso.id
and
  currofe.curr_id = curr.id
and
  turmaofe.currofe_id = currofe.id
and
  matric.turmaofe_id = turmaofe.id
and
  wpessoa.id = matric.wpessoa_id
and
  CurrOfe.PLetivo_Id >= nvl ( p_PLetivo_Id , 0 )
and
  Matric.MatricTi_Id = 8300000000001 
and
  matric.wpessoa_id = nvl( p_WPessoa_Id ,0 )
order by recognize desc