select
  currxdisc_gsRetCodDisc(gradnet.currxdisc_id)                    as Disc,
  turmaofe_gsRetCodTurma(gradnet.turmaofe_id)                     as Turma,
  PLetivo_gsRecognize(turmaofe_gnRetPLetivo(gradnet.turmaofe_id)) as PeriodoLetivo,
  divturma_gsrecognize(gradnet.divturma_teoria_id)  || ' ' ||
  divturma_gsrecognize(gradnet.divturma_pratica_id) || ' ' ||
  divturma_gsrecognize(gradnet.divturma_lab_id)                   as Div,
  Matric_Id                                                       as m_id,
  Matric_Id                                                       as Matric_Id,
  WPessoa_Id                                                      as WPessoa_Id,
  WPessoa_gnCodigo(WPessoa_Id)                                    as Codigo,
  N1,
  N2,
  N3,
  N4,
  N5,
  F13,
  GradNet.Id,
  currxdisc_gnCursoNivel ( gradnet.currxdisc_id )                 as CursoNivel_Id,
  curso_gsrecognize( matric_gnretcurso( matric_id ) )             as Curso,
  State.Nick                                                      as Situacao
from
  Gradnet,
  State
where
  GradNet.State_Id = State.Id
and
  GradNet.State_Id != 3000000003002
order by wpessoa_id,m_id, turma, disc