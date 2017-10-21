(
select
  matric.*,
  currofe.pletivo_id, 
  curr.id                                                       as curr_id,
  curr.currnomevest                                             as nomevest,
  duracxci.sequencia                                            as serie,
  duracxci.nome                                                 as serieNome,
  curso.id                                                      as curso_id,
  cursoNivel.id                                                 as cursoNivel_id,
  curr.mneumonico                                               as mneumonico,
  turmaofe_gsrecognize(matric.turmaofe_id)||' - '||campus.nome  as turmaofe,
  turmaofe_gsretcodturma(matric.turmaofe_id)                    as turma,
  matric_gsRecognize(matric.id)                                 as recognize,
  curr_gnretduracao(curr.id)                                    as duracao,
  wpessoa_gsRecognize(matric.wpessoa_id)                        as wpessoa_id_r,
  state_gsrecognize(matric.state_id)                            as situacao,
  CurrOfe.Id                                                    as CurrOfe_Id,
  Curso.nome                                                    as curso,
  substr(periodo_gsrecognize(turma.periodo_id),1,30)            as periodo,
  Campus.Id                                                     as Campus_Id,
  Turma.Periodo_Id                                              as Periodo_Id,
  Curr.Titulo_Id                                                as Titulo_Id,
  wpessoa_gsRecognize(matric.wpessoa_id)                        as NomeAluno,
  WPessoa.Codigo                                                as RA,
  Campus_gsRecognize(Campus.Id)                                 as Campus_Recognize,
  pletivo.nome                                                  as pletivo,
  shortname(Curr.CurrNomeHist,80)                               as Curso_Recognize,
  DuracXCi.Sequencia                                            as DuracXCi_Sequencia,
  Turma.Codigo                                                  as Turma_Recognize,
  to_char(Matric.DtState,'DD-MM-YYYY')                          as DTSTATEMK,
  to_char(Matric.Data,'DD-MM-YYYY')                             as DataMk,
  to_char(Matric.Rematricula,'DD-MM-YYYY')                      as RemaMk,
  curso.facul_id                                                as facul_id
from
  pletivo,
  cursoNivel,
  curso,
  duracxci,
  campus,
  turma,
  curr,
  currofe,
  turmaofe,
  matric,
  wpessoa
where
  pletivo.id = currofe.pletivo_id
and
  matric.wpessoa_id=wpessoa.id
and
  campus.id=turma.campus_id
and
  curso.cursoNivel_id = cursoNivel.id
and
  turma.curso_id = curso.id
and
  turma.duracxci_id = duracxci.id (+)
and
  turmaofe.turma_id = turma.id
and
  currofe.curr_id = curr.id
and
  turmaofe.currofe_id = currofe.id
and
  matric.turmaofe_id = turmaofe.id
and
  matric.id = nvl( p_Matric_Id ,0)
)
union
(
select
  matric.*,
  discesp.pletivo_id,
  null                                                as curr_id,
  null                                                as nomevest,
  null                                                as serie,
  null                                                as serieNome,
  null                                                as curso_id,
  null                                                as cursoNivel_id,
  null                                                as mneumonico,
  turmaofe_gsrecognize(matric.turmaofe_id)            as turmaofe,
  turmaofe_gsretcodturma(matric.turmaofe_id)          as turma,
  matric_gsRecognize(matric.id)                       as recognize,
  null                                                as duracao,
  wpessoa_gsRecognize(matric.wpessoa_id)              as wpessoa_id_r,
  state_gsrecognize(matric.state_id)                  as situacao,
  null                                                as CurrOfe_Id,
  null                                                as curso,
  substr(periodo_gsrecognize(turma.periodo_id),1,30)  as periodo,
  null                                                as Campus_Id,
  null                                                as Periodo_Id,
  null                                                as Titulo_Id,
  wpessoa_gsRecognize(matric.wpessoa_id)              as NomeAluno,
  WPessoa.Codigo                                      as RA,
  null                                                as Campus_Recognize,
  pletivo.nome                                        as pletivo,
  null                                                as Curso_Recognize,
  null                                                as DuracXCi_Sequencia,
  Turma.Codigo                                        as Turma_Recognize,
  to_char(Matric.DtState,'DD-MM-YYYY')                as DTSTATEMK,
  to_char(Matric.Data,'DD-MM-YYYY')                   as DataMk,
  to_char(Matric.Rematricula,'DD-MM-YYYY')            as RemaMk,
  discesp.facul_id                                    as facul_id
from 
  pletivo,
  turma,
  discesp,
  turmaofe,
  matric,
  wpessoa
where
  pletivo.id = discesp.pletivo_id
and
  matric.wpessoa_id=wpessoa.id
and 
  turmaofe.turma_id = turma.id
and
  turmaofe.discesp_id = discesp.id
and
  matric.turmaofe_id = turmaofe.id
and
  matric.id = nvl( p_Matric_Id ,0)
)
