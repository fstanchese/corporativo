select
  GradAlu.Id                           as GradAlu_Id, 
  CurrXDisc_gsRetCodDisc(CurrXDisc_Id) as CodDisc,
  CurrXDisc_gsRetDisc(CurrXDisc_Id)    as NomeDisc,
  TurmaOfe_gsRetCodTurma(TurmaOfe_Id)  as Turma,
  WPessoa.Nome, 
  shortname(WPessoa.Nome,27)           as NomeReduz,
  WPessoa.Codigo,
  GradAlu.CurrXDisc_Id                 as CurrXDisc_Id,
  GradAlu.TurmaOfe_Id                  as TurmaOfe_Id
from
  WPessoa,
  GradAlu
where
  (
    GradAlu.WPessoa_Id = p_WPessoa_Id 
  or
    p_WPessoa_Id is null
  )
and
  WPessoa.Id = GradAlu.WPessoa_Id
and
  GradAlu.State_Id in ( 3000000003001,3000000003004,3000000003005,3000000003006,3000000003007,3000000003008 )
and
  GradAlu.HoraProva_Esp_Id = nvl( p_HoraProva_Id ,0)
order by Nome


