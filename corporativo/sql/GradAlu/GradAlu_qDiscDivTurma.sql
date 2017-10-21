
(
select 
  gradalu.id                  as id,
  Disc_gsRecognize(disc.id)   as recognize
from
  gradalu,
  currxdisc,
  disc,
  turmaofe,
  TOXCD,
  currofe
where
  gradalu.state_id not in (3000000003002,3000000003003,3000000003009,3000000003010)
and
  gradalu.turmaofe_id = turmaofe.id
and
(
  TOXCD.CriDivTur_Teoria_Id is not null
or
  TOXCD.CriDivTur_Pratica_Id is not null
or
  TOXCD.CriDivTur_Lab_Id is not null
)
and
  TOXCD.CurrXDisc_Id = CurrXDisc.Id
and
  TOXCD.TurmaOfe_Id = TurmaOfe.Id
and
  turmaofe.currofe_id = currofe.id
and
  currxdisc.disc_id = disc.id
and
  gradalu.currxdisc_id = currxdisc.id
and
  currofe.pletivo_id = nvl( p_PLetivo_Id ,0)
and
  gradalu.wpessoa_id = nvl( p_WPessoa_Id ,0)
)
union
(
select 
  gradalu.id                  as id,
  Disc_gsRecognize(disc.id)   as recognize
from
  gradalu,
  currxdisc,
  disc,
  turmaofe,
  TOXCD,
  discEsp
where
  gradalu.state_id not in (3000000003002,3000000003003,3000000003009,3000000003010)
and
  gradalu.turmaofe_id = turmaofe.id
and
(
  TOXCD.CriDivTur_Teoria_Id is not null
or
  TOXCD.CriDivTur_Pratica_Id is not null
or
  TOXCD.CriDivTur_Lab_Id is not null
)
and
  TOXCD.CurrXDisc_Id = CurrXDisc.Id
and
  TOXCD.TurmaOfe_Id = TurmaOfe.Id
and
  turmaofe.discEsp_id = discEsp.id
and
  currxdisc.disc_id = disc.id
and
  gradalu.currxdisc_id = currxdisc.id
and
  discEsp.pletivo_id = nvl( p_PLetivo_Id ,0)
and
  gradalu.wpessoa_id = nvl( p_WPessoa_Id ,0)
)
