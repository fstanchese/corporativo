select
  gradalu.*,
  turmaofe_gnRetCursoNivel(gradalu.turmaofe_id)         as cursonivel,  
  turmaofe_gnRetPLetivo(gradalu.turmaofe_id)            as pletivoid,
  turmaofe_gsRetPLetivo(gradalu.turmaofe_id)            as pletivo,
  gradaluti_gsrecognize(gradalu.gradaluti_id)           as gradaluti,
  currxdisc_gsrecognize(gradalu.currxdisc_id)           as currxdisc_gsrecognize,
  currxdisc_gsRetCodDisc(gradalu.currxdisc_id)          as disc,
  turmaofe_gsRetCodTurma(gradalu.turmaofe_id)           as turma,
  state_gsRecognize(gradalu.state_id)                   as situacao,
  gradalu_gsRetNotasHtml(gradalu.id,gradalu.criaval_id) as notas,
  gradalu.F13                                           as faltas,
  currxdisc.disccat_id
from
  currxdisc,
  gradalu
where
  currxdisc.id=gradalu.currxdisc_id
and
  GradAlu.State_Id <> 3000000003002
and
  gradalu.matric_id in ( select id from matric start with matric.id = nvl( p_Matric_Id ,0) connect by matric.matric_pai_id = prior matric.id ) 
order by
  cursonivel,pletivo,notati_id,disc
