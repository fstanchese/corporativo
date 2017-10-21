(
select
  gradalu.*,
  turmaofe_gnRetCursoNivel(gradalu.turmaofe_id)                   as CursoNivel,  
  turmaofe_gnRetPLetivo(gradalu.turmaofe_id)                      as PLetivoId,
  PLetivo_gsRecognize(turmaofe_gnRetPLetivo(gradalu.turmaofe_id)) as Pletivo,
  gradaluti_gsrecognize(gradalu.gradaluti_id)                     as GradAluTi,
  currxdisc_gsrecognize(gradalu.currxdisc_id)                     as CurrXDisc_gsRecognize,
  currxdisc_gsRetCodDisc(gradalu.currxdisc_id)                    as Disc,
  turmaofe_gsRetCodTurma(gradalu.turmaofe_id)                     as Turma,
  divturma_gsrecognize(gradalu.divturma_teoria_id)  || ' ' ||
  divturma_gsrecognize(gradalu.divturma_pratica_id) || ' ' ||
  divturma_gsrecognize(gradalu.divturma_lab_id)                   as Div,
  state.nick                                                      as Situacao,
  Gradalu_gsRetNotasHtml(gradalu.id,gradalu.criaval_id)           as Notas,
  currxdisc_gnChTotal(gradalu.currxdisc_id, p_PLetivo_Id , GradAlu.Id )   as ChAnual,
  currxdisc_gnChLimite(gradalu.currxdisc_id, p_PLetivo_Id , GradAlu.Id )  as Limite,
  currxdisc_gsRetCodDisc(gradalu.currxdisc_id)||' - '||turmaofe_gsRetCodTurma(gradalu.turmaofe_id) ||' - '|| state.nick  as Recognize,
  matric.id as m_id,
  currxdisc_gnCursoNivel ( gradalu.currxdisc_id ) as CursoNivel_Id,
  curso_gsrecognize( matric_gnretcurso( matric.id ) ) as Curso,
  turmaofe_gnretturmati(gradalu.turmaofe_id) as TurmaTi_Id
from
  GradAlu,
  Matric,
  State,
  CurrOfe,
  TurmaOfe
where
  Matric.State_Id > 3000000002001
and
  GradAlu.State_Id = State.Id
and
  Matric.Id = GradAlu.Matric_Id
and
  GradAlu.State_Id != 3000000003002
and
  Matric.MatricTi_Id <= 8300000000002
and
  GradAlu.WPessoa_Id = nvl( p_WPessoa_Id , 0 )
and
  GradAlu.TurmaOfe_Id = TurmaOfe.Id
and
  TurmaOfe.CurrOfe_Id = CurrOfe.Id
and
  CurrOfe.PLetivo_Id = nvl ( p_PLetivo_Id , 0 )
)
union
(
select
  gradalu.*,
  turmaofe_gnRetCursoNivel(gradalu.turmaofe_id)                   as CursoNivel,  
  turmaofe_gnRetPLetivo(gradalu.turmaofe_id)                      as PLetivoId,
  PLetivo_gsRecognize(turmaofe_gnRetPLetivo(gradalu.turmaofe_id)) as PLetivo,
  gradaluti_gsrecognize(gradalu.gradaluti_id)                     as GradAluTi,
  currxdisc_gsrecognize(gradalu.currxdisc_id)                     as CurrXDisc_gsRecognize,
  currxdisc_gsRetCodDisc(gradalu.currxdisc_id)                    as Disc,
  turmaofe_gsRetCodTurma(gradalu.turmaofe_id)                     as Turma,
  divturma_gsrecognize(gradalu.divturma_teoria_id)  || ' ' ||
  divturma_gsrecognize(gradalu.divturma_pratica_id) || ' ' ||
  divturma_gsrecognize(gradalu.divturma_lab_id)                   as Div,
  state.nick                                                      as Situacao,
  Gradalu_gsRetNotasHtml(gradalu.id,gradalu.criaval_id)           as Notas,
  currxdisc_gnChTotal(gradalu.currxdisc_id, p_PLetivo_Id , GradAlu.Id )        as ChAnual,
  currxdisc_gnChLimite(gradalu.currxdisc_id, p_PLetivo_Id , GradAlu.Id )  as Limite,
  currxdisc_gsRetCodDisc(gradalu.currxdisc_id)||' - '||turmaofe_gsRetCodTurma(gradalu.turmaofe_id) ||' - '|| state.nick as recognize,
  matric.id as m_id,
  currxdisc_gnCursoNivel ( gradalu.currxdisc_id ) as CursoNivel_Id,
  curso_gsrecognize( matric_gnretcurso( matric.id ) ) as Curso,
  turmaofe_gnretturmati(gradalu.turmaofe_id) as TurmaTi_Id
from
  GradAlu,
  Matric,
  State,
  DiscEsp,
  TurmaOfe
where
  Matric.State_Id > 3000000002001
and
  GradAlu.State_Id = State.Id
and
  Matric.Id = GradAlu.Matric_Id
and
  GradAlu.State_Id != 3000000003002
and
  Matric.MatricTi_Id = 8300000000002
and
  GradAlu.WPessoa_Id = nvl( p_WPessoa_Id , 0 )
and
  GradAlu.TurmaOfe_Id = TurmaOfe.Id
and
  TurmaOfe.DiscEsp_Id = DiscEsp.Id
and
  DiscEsp.PLetivo_Id = nvl ( p_PLetivo_Id , 0 )
)
order by cursonivel, m_id, turma, disc
