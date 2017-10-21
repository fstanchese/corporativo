(
select
  shortName(WPessoa.Nome,25) as Nome,
  WPessoa.Codigo             as Codigo,
  WPessoa.Id                 as WPessoa_Id,
  WPessoa_gsRecognize(TOXCD.WPessoa_ProfResp_Id) as Professor,
  GradAlu.TurmaOfe_Id,
  GradAlu.CurrXDisc_Id,
  TOXCD_gsRetCodDisc(TOXCD.Id) as Disc,
  GradAlu.N1,
  GradAlu.N2,
  GradAlu.N3,
  GradAlu.N4,
  GradAlu.N5,
  GradAlu.N6,
  State.Nick as Situacao
from
  State,
  GradAlu,
  WPessoa,
  TOXCD,
  TurmaOfe,
  CurrOfe
where
  State.Id = GradAlu.State_Id
and
  GradAlu.State_Id not in ( 3000000003002,3000000003003,3000000003009,3000000003010)
and
  WPessoa.Id = GradAlu.WPessoa_Id
and
  TOXCD.Turmaofe_Id = GradAlu.TurmaOfe_Id
and
  TOXCD.CurrXDisc_Id = GradAlu.CurrXDisc_Id  
and
  GradAlu.TurmaOfe_Id = TurmaOfe.Id
and
  (
    p_CurrXDisc_Id is null
      or
    GradAlu.CurrXDisc_Id = nvl( p_CurrXDisc_Id ,0)
  )
and
  (
    p_TurmaOfe_Id is null
      or
    GradAlu.TurmaOfe_Id = nvl( p_TurmaOfe_Id ,0)
  )
and
  (
    p_WPessoa_Id is null
      or
    TOXCD.WPessoa_ProfResp_Id = nvl( p_WPessoa_Id ,0)
  )
and
  TurmaOfe.CurrOfe_Id = CurrOfe.Id
and
  CurrOfe.PLetivo_Id = p_PLetivo_Id 
)
union
(
select
  shortName(WPessoa.Nome,25) as Nome,
  WPessoa.Codigo             as Codigo,
  WPessoa.Id                 as WPessoa_Id,
  WPessoa_gsRecognize(TOXCD.WPessoa_ProfResp_Id) as Professor,
  GradAlu.TurmaOfe_Id,
  GradAlu.CurrXDisc_Id,
  TOXCD_gsRetCodDisc(TOXCD.Id) as Disc,
  GradAlu.N1,
  GradAlu.N2,
  GradAlu.N3,
  GradAlu.N4,
  GradAlu.N5,
  GradAlu.N6,
  State.Nick as Situacao
from
  State,
  GradAlu,
  WPessoa,
  TOXCD,
  TurmaOfe,
  DiscEsp
where
  State.Id = GradAlu.State_Id
and
  GradAlu.State_Id not in ( 3000000003002,3000000003003,3000000003009,3000000003010)
and
  WPessoa.Id = GradAlu.WPessoa_Id
and
  TOXCD.CurrXDisc_Id is null
and
  TOXCD.Turmaofe_Id = GradAlu.TurmaOfe_Id
and
  GradAlu.TurmaOfe_Id = TurmaOfe.Id
and
  (
    p_TurmaOfe_Id is null
      or
    GradAlu.TurmaOfe_Id = nvl( p_TurmaOfe_Id ,0)
  )
and
  (
    p_WPessoa_Id is null
      or
    TOXCD.WPessoa_ProfResp_Id = nvl( p_WPessoa_Id ,0)
  )
and
  TurmaOfe.DiscEsp_Id = DiscEsp.Id
and
  DiscEsp.PLetivo_Id = p_PLetivo_Id
)
order by 4,5,7,1
