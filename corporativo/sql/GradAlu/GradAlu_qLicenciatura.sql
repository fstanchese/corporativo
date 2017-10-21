select   
  GradAlu.Id                                  as Id,
  CurrXDisc_gsRecognize(CurrXDisc_Id)         as Recognize,
  TurmaOfe_gsretcodturma(GradAlu.TurmaOfe_Id) as Turma,
  Disc.Codigo                                 as CodDisc,
  State_gsrecognize(gradalu.state_id)         as Situacao,
  gradalu.state_id                            as state_id,
  gradalu.matric_id                           as matric_id,
  matric.data                                 as datax
from
  matric,
  gradalu,
  currxdisc,
  disc,
  turmaofe,
  discEsp
where
  gradalu.matric_id = matric.id
and
  gradalu.turmaofe_id = turmaofe.id
and
  turmaofe.discEsp_id = discEsp.id
and
  currxdisc.disc_id = disc.id
and
  gradalu.currxdisc_id = currxdisc.id
and
  discesp.discespti_id = 17800000000003
and 
  (
    discEsp.pletivo_id = nvl( p_PLetivo_Id ,0)
    or
    p_PLetivo_Id is null
  )
and
  gradalu.wpessoa_id = nvl( p_WPessoa_Id ,0)
order by gradalu.id 