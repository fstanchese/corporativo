(
select
  TOXCD_gsRetTurma(TOXCD.Id)   as Turma,
  TOXCD_gsRetCodDisc(TOXCD.Id) as CodDisc,
  TOXCD.WPessoa_ProfResp_Id    as WPessoa_Id
from
  TOXCD,
  TurmaOfe,
  CurrOfe
where
  TOXCD.WPessoa_ProfResp_Id is not null
and
  TurmaOfe.CurrOfe_Id = CurrOfe.Id
and
  TOXCD.TurmaOfe_Id = TurmaOfe.Id
and
  CurrOfe.PLetivo_Id = nvl ( p_PLetivo_Id , 0)
)
union
(
select
  TOXCD_gsRetTurma(TOXCD.Id)   as Turma,
  TOXCD_gsRetCodDisc(TOXCD.Id) as CodDisc,
  TOXCD.WPessoa_ProfResp_Id    as WPessoa_Id
from
  TOXCD,
  TurmaOfe,
  DiscEsp  
where
  TOXCD.WPessoa_ProfResp_Id is not null
and
  DiscEsp.Id = TurmaOfe.DiscEsp_Id
and
  TOXCD.TurmaOfe_Id = TurmaOfe.Id
and
  DiscEsp.PLetivo_Id = nvl ( p_PLetivo_Id , 0)
)
order by 1,2  