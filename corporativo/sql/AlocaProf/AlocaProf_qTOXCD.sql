select
  toxcd.id as toxcd_id
from
  AlocaProf,
  CurrOfe,
  TurmaOfe,
  toxcd
where
  TurmaOfe.CurrOfe_Id = CurrOfe.Id
and
  TOXCD.CurrXDisc_Id = AlocaProf.CurrXDisc_Id
and
  TurmaOfe.Turma_Id = AlocaProf.Turma_Id
and
  TOXCD.TurmaOfe_Id = TurmaOfe.Id
and
  toxcd.currxdisc_Id = nvl ( p_CurrXDisc_Id , 0 )
and
  TurmaOfe.Turma_Id = nvl ( p_Turma_Id , 0 )
and
  CurrOfe.Pletivo_Id = nvl ( p_PLetivo_Id , 0 )
union
select
  toxcd.id as toxcd_id
from
  DiscEsp,
  TurmaOfe,
  toxcd
where
  TurmaOfe.DiscEsp_Id = DiscEsp.Id
and
  TOXCD.TurmaOfe_Id = TurmaOfe.Id
and
  TurmaOfe.Turma_Id = nvl ( p_Turma_Id , 0 )
and
  DiscEsp.Pletivo_Id = nvl ( p_PLetivo_Id , 0 )
