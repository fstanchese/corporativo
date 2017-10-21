(
select
  matric.id                                             as id,
  wpessoa.codigo                                        as codigo,
  Upper (wpessoa.nome)                                  as nome,
  Upper (curso.nome)                                    as curso,
  shortname(curso.nome,40)                               as cursoabrev,
  wpessoa.dtnascto                                      as dtnascto,
  wpessoa.rgrne                                         as rgrne,
  wpessoa.pai                                           as pai,
  wpessoa.mae                                           as mae,
  wpessoa.foneres                                       as foneres,
  wpessoa.fonecom                                       as fonecom,  
  wpessoa.lograd_id                                     as lograd_id,
  wpessoa.endernum                                      as endernum,
  wpessoa.email1                                        as email,
  turmaofe_gsretcodturma(matric.turmaofe_id)            as turma,
  lograd_gsRecognize(wpessoa.lograd_id)                 as endereco,
  to_char (matric.carteirinhaVia, '0')                  as carteirinhaVia,
  turmaofe_gsretpletivo(matric.turmaofe_id)||' - '||duracxci.nome||' - '||state_gsrecognize(matric.state_id)||' - '||curso.nome as recognize,
  to_char (turma.id-6700000000000, '00000')             as turmaSequencia,
  wpessoa.codigo || to_char (pletivo.final+50, 'mmyy')  as carteirinhaCodebar,
  to_char (pletivo.final+50, 'Mon/yyyy')                as carteirinhaValidade,
  nvl(matric.data,trunc(sysdate))                       as datax,
  matric.state_id                                       as state_id,
  state_gsrecognize(matric.state_id)                    as situacao,
  substr(turmaofe_gsretpletivo(matric.turmaofe_id),1,4) as Anopletivo,
  Curso.Nome                                            as Curso_Nome,
  Matric.DtState                                        as DtState,
  turmaofe_gsretpletivo(matric.turmaofe_id)             as ano,
  Matric.MatricTi_Id                                    as MatricTi_Id,
  Campus_gsRecognize(Turma.Campus_Id)                   as Campus_Recognize,
  matric.data                                           as data,
  Curso.Id                                              as Curso_Id,
  PLetivo.Id                                            as PLetivo_Id,
  Turma.Campus_Id                                       as Campus_Id,
  turmaofe_gsretpletivo(matric.turmaofe_id)             as pletivo,
  matric.data                                           as data_matricula,
  shortname(Curr.CurrNomeHist,80)                       as CurrNomeHistReduz
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
  Matric_gnEstudando( Matric.Id, p_O_Data ) = 1
and
  (
    CurrOfe.PLetivo_Id = nvl ( p_PLetivo_Id , 0 )
  or
    p_PLetivo_Id is null 
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
  (
    Matric.MatricTi_Id = nvl ( p_MatricTi_Id , 0 )
  or
    p_MatricTi_Id is null
  )
and
  matric.wpessoa_id = nvl( p_WPessoa_Id ,0)
)
union
(
select
  matric.id                                             as id,
  wpessoa.codigo                                        as codigo,
  Upper (wpessoa.nome)                                  as nome,
  Upper (curso.nome)                                    as curso,
  shortname(curso.nome,40)                               as cursoabrev,
  wpessoa.dtnascto                                      as dtnascto,
  wpessoa.rgrne                                         as rgrne,
  wpessoa.pai                                           as pai,
  wpessoa.mae                                           as mae,
  wpessoa.foneres                                       as foneres,
  wpessoa.fonecom                                       as fonecom,  
  wpessoa.lograd_id                                     as lograd_id,
  wpessoa.endernum                                      as endernum,
  wpessoa.email1                                        as email,
  turmaofe_gsretcodturma(matric.turmaofe_id)            as turma,
  lograd_gsRecognize(wpessoa.lograd_id)                 as endereco,
  to_char (matric.carteirinhaVia, '0')                  as carteirinhaVia,
  turmaofe_gsretpletivo(matric.turmaofe_id)||' - '||turma.codigo||' - '||state_gsrecognize(matric.state_id)||' - '||curso.nome as recognize,
  to_char (turma.id-6700000000000, '00000')             as turmaSequencia,
  wpessoa.codigo || to_char (pletivo.final+50, 'mmyy')  as carteirinhaCodebar,
  to_char (pletivo.final+50, 'Mon/yyyy')                as carteirinhaValidade,
  nvl(matric.data,trunc(sysdate))                       as datax,
  matric.state_id                                       as state_id,
  state_gsrecognize(matric.state_id)                    as situacao,
  substr(turmaofe_gsretpletivo(matric.turmaofe_id),1,4) as Anopletivo,
  Curso.Nome                                            as Curso_Nome,
  Matric.DtState                                        as DtState,
  turmaofe_gsretpletivo(matric.turmaofe_id)             as ano,
  Matric.MatricTi_Id                                    as MatricTi_Id,
  Campus_gsRecognize(Turma.Campus_Id)                   as Campus_Recognize,
  matric.data                                           as data,
  Curso.Id                                              as Curso_Id,
  PLetivo.Id                                            as PLetivo_Id,
  Turma.Campus_Id                                       as Campus_Id,
  turmaofe_gsretpletivo(matric.turmaofe_id)             as pletivo,
  matric.data                                           as data_matricula,
  null                                                  as CurrNomeHistReduz
from
  pletivo,
  duracxci,
  turma,
  curso,
  discesp,
  turmaofe,
  matric,
  wpessoa
where
  Matric_gnEstudando( Matric.Id, p_O_Data ) = 1
and
  (
    DiscEsp.PLetivo_Id = nvl ( p_PLetivo_Id , 0 )
  or
    p_PLetivo_Id is null 
  )
and
  discesp.pletivo_id = pletivo.id
and
  turma.duracxci_id = duracxci.id (+)
and
  curso.id = turma.curso_Id
and
  turmaofe.turma_id = turma.id
and
  turmaofe.discesp_id = discesp.id
and
  matric.turmaofe_id = turmaofe.id
and
  wpessoa.id = matric.wpessoa_id
and
  (
    Matric.MatricTi_Id = nvl ( p_MatricTi_Id , 0 )
  or
    p_MatricTi_Id is null
  )
and
  matric.wpessoa_id = nvl( p_WPessoa_Id ,0)
)
order by recognize desc