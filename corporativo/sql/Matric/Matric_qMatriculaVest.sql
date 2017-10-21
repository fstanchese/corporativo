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
  turmaofe_gsretpletivo(matric.turmaofe_id)||' - '||turmaofe_gsRetCodTurma(Matric.TurmaOfe_id)||' - '||state_gsrecognize(matric.state_id)||' - '||to_char(matric.dt,'dd/mm/yyyy')||' - '||curso.nome||' - '||WPleito_gsRecognize(VestChama.WPleito_Id) as recognize,
  to_char (turma.id-6700000000000, '00000') as turmaSequencia,
  wpessoa.codigo || to_char (pletivo.final+50, 'mmyy') as carteirinhaCodebar,
  to_char (pletivo.final+50, 'Mon/yyyy') as carteirinhaValidade,
  nvl(matric.data,trunc(sysdate)) as datax,
  matric.state_id        as state_id
from
  vestchama,
  vestcla,
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
  VestChama.Id = VestCla.VestChama_Id
and
  VestCla.Matric_Id = Matric.Id
and 
  Matric.State_Id in ( 3000000002000,3000000002001, 3000000002002 )
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
  (
    p_CurrOfe_Vest is null
    or
    (
      CurrOfe.Vest = p_CurrOfe_Vest
    or
      CurrOfe.Id = 6800000003830
    )
  )
and
  CurrOfe.PLetivo_Id = nvl ( p_PLetivo_Id , 0 )
and
  Matric.MatricTi_Id = 8300000000001 
and
  matric.wpessoa_id = nvl( p_WPessoa_Id ,0 )
order by recognize desc