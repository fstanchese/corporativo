(
select
  CurrXDisc_gsRetCodDisc(GradAlu.CurrXDisc_Id) || ' - ' || CurrXDisc_gsRetDisc(GradAlu.CurrXDisc_Id)    as Disc,
  WPessoa_gsRecognize(WPessoa_ProfResp_Id)     as ProfResp,
  WPessoa_ProfResp_Id                          as ProfResp_Id,
  TurmaOfe_gsRecognize(GradAlu.TurmaOfe_Id)    as Turma,
  GradAlu.N1,
  GradAlu.N2,
  GradAlu.N4
from
  GradAlu,
  TOXCD
where
  GradAlu.TurmaOfe_Id = TOXCD.TurmaOfe_Id
and
  GradAlu.CurrXDisc_Id = TOXCD.CurrXDisc_Id
and
  GradAlu.Id = p_Disc_Selecao_Id_GradAlu
)
union
(
select
  CurrXDisc_gsRetCodDisc(GradAlu.CurrXDisc_Id) || ' - ' || CurrXDisc_gsRetDisc(GradAlu.CurrXDisc_Id)    as Disc,
  WPessoa_gsRecognize(WPessoa_ProfResp_Id)     as ProfResp,
  WPessoa_ProfResp_Id                          as ProfResp_Id,
  TurmaOfe_gsRecognize(GradAlu.TurmaOfe_Id)    as Turma,
  GradAlu.N1,
  GradAlu.N2,
  GradAlu.N4  
from
  GradAlu,
  TOXCD
where
  TOXCD.CurrXDisc_Id is null
and
  TOXCD.TurmaOfe_Id = GradAlu.TurmaOfe_Id
and
  GradAlu.Id = p_Disc_Selecao_Id_GradAlu
)
