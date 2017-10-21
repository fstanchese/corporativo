select
  GradAlu.Id        as id,
  Disc.Nome         as recognize,
  DuracXCi.NomeHTML as NomeHTML,
  currxdisc_gnChTotal(gradalu.currxdisc_id, p_PLetivo_Id , GradAlu.Id ) as ChAnual,
  Disc.Nome         as NomeDisc,
  DiscCat.Nome      as NomeCat,
  GradAlu.State_Id  as State_Id
from
  gradalu,
  currxdisc,
  DiscCat,
  disc,
  turmaofe,
  currofe,
  duracxci
where
  duracxci.id (+)= currxdisc.duracxci_id
and
  gradalu.turmaofe_id = turmaofe.id
and
  turmaofe.currofe_id = currofe.id
and
  currxdisc.disc_id = disc.id
and
  DiscCat.Estagio = 'on'
and
  CurrXDisc.DiscCat_Id = DiscCat.Id
and
  gradalu.currxdisc_id = currxdisc.id
and
  GradAlu.State_Id <> 3000000003002
and
  currofe.pletivo_id = nvl( p_PLetivo_Id ,0)
and
  gradalu.wpessoa_id = nvl( p_WPessoa_Id  ,0)
union
select
  GradAlu.Id        as id,
  Disc.Nome         as recognize,
  DuracXCi.NomeHTML as NomeHTML,
  currxdisc_gnChTotal(gradalu.currxdisc_id, p_PLetivo_Id , GradAlu.Id ) as ChAnual,
  Disc.Nome         as NomeDisc,
  DiscCat.Nome      as NomeCat,
  GradAlu.State_Id  as State_Id
from
  gradalu,
  currxdisc,
  DiscCat,
  disc,
  turmaofe,
  discEsp,
  duracxci
where
  duracxci.id (+)= currxdisc.duracxci_id
and
  gradalu.turmaofe_id = turmaofe.id
and
  turmaofe.discEsp_id = discEsp.id
and
  currxdisc.disc_id = disc.id
and
  DiscCat.Estagio = 'on'
and
  CurrXDisc.DiscCat_Id = DiscCat.Id
and
  GradAlu.State_Id <> 3000000003002
and
  gradalu.currxdisc_id = currxdisc.id
and
  discEsp.pletivo_id = nvl( p_PLetivo_Id ,0)
and
  gradalu.wpessoa_id = nvl( p_WPessoa_Id ,0)
