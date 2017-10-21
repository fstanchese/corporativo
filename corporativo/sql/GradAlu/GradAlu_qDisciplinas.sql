(
select 
  gradalu.id                 as id,
  disc_gsRecognize(Disc.Id)  as recognize,
  GradAlu.N1,
  GradAlu.N2,
  GradAlu.N4,
  gradalu.n5,
  gradalu.state_id
from
  toxcd,
  gradalu,
  currxdisc,
  disc,
  turmaofe,
  currofe
where
  toxcd.currxdisc_id = gradalu.currxdisc_id
and
  toxcd.turmaofe_id = gradalu.turmaofe_id
and
  gradalu.state_id not in (3000000003002,3000000003010)
and
  gradalu.turmaofe_id = turmaofe.id
and
  turmaofe.currofe_id = currofe.id
and
  currxdisc.disc_id = disc.id
and
  gradalu.currxdisc_id = currxdisc.id
and
  (
    p_WPessoa_ProfResp_Id is null
    or
    toxcd.wpessoa_profresp_id = nvl( p_WPessoa_ProfResp_Id , 0 )
  )
and
  currofe.pletivo_id = nvl( p_PLetivo_Id ,0)
and
  gradalu.wpessoa_id = nvl( p_WPessoa_Id ,0)
)
union
(
select 
  gradalu.id                as id,
  Disc_gsRecognize(Disc.Id) as recognize,
  GradAlu.N1,
  GradAlu.N2,
  GradAlu.N4,
  gradalu.n5,
  gradalu.state_id
from
  toxcd,
  gradalu,
  currxdisc,
  disc,
  turmaofe,
  discEsp
where
  toxcd.turmaofe_id = gradalu.turmaofe_id
and
  toxcd.currxdisc_id is null
and
  gradalu.state_id not in (3000000003002,3000000003010)
and
  gradalu.turmaofe_id = turmaofe.id
and
  turmaofe.discEsp_id = discEsp.id
and
  currxdisc.disc_id = disc.id
and
  gradalu.currxdisc_id = currxdisc.id
and
  (
    p_WPessoa_ProfResp_Id is null
    or
    toxcd.wpessoa_profresp_id = nvl( p_WPessoa_ProfResp_Id , 0 )
  )
and
  discEsp.pletivo_id = nvl( p_PLetivo_Id ,0)
and
  gradalu.wpessoa_id = nvl( p_WPessoa_Id ,0)
)
