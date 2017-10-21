(
select
  TOXCD.Id                                                                 as Id,
  TOXCD_gsRetCodDisc(TOXCD.Id) || ' - ' || toxcd_gsretdisciplina(toxcd.id) as Recognize,
  TOXCD_gsRetCodDisc(TOXCD.Id)                                             as DiscRecognize,
  TOXCD.CurrXDisc_Id                                                       as CurrXDisc_Id,
  DiscCat.Estagio                                                          as Estagio,
  toxcd_gsretdisciplina(toxcd.id)                                          as NomeDisc,
  CurrXDisc.NotaTi_Id                                                      as NotaTi_Id,
  wpessoa_gsrecognize(TOXCD.WPessoa_ProfResp_Id)                           as ProfResp
from
  TOXCD,
  CurrXDisc,
  DiscCat
where
  DiscCat.Id (+) = CurrXDisc.DiscCat_Id
and
  CurrXDisc.Id = TOXCD.CurrXDisc_Id
and
  TOXCD.TurmaOfe_Id = nvl( p_TurmaOfe_Id ,0) 
)
union
(
select
  TOXCD.Id                                                                 as Id,
  TOXCD_gsRetCodDisc(TOXCD.Id) || ' - ' || toxcd_gsretdisciplina(toxcd.id) as Recognize,
  TOXCD_gsRetCodDisc(TOXCD.Id)                                             as DiscRecognize,
  TOXCD.CurrXDisc_Id                                                       as CurrXDisc_Id,
  'off'                                                                    as Estagio,
  toxcd_gsretdisciplina(toxcd.id)                                          as NomeDisc,
  null                                                                     as NotaTi_Id,
  wpessoa_gsrecognize(TOXCD.WPessoa_ProfResp_Id)                           as ProfResp
from
  TOXCD,
  TurmaOfe
where
  TurmaOfe.DiscEsp_Id is not null
and
  TOXCD.TurmaOfe_Id = TurmaOfe.Id
and
  TOXCD.TurmaOfe_Id = nvl( p_TurmaOfe_Id ,0) 
)
order by Estagio,Recognize