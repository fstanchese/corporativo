select
  count(*) as Quantidade
from
  LPreFolha,
  LPre,
  HoraAula
where
  LPreFolha.LPre_Id = LPre.Id
and
  LPre.PLetivoP_Id = nvl( p_PLetivoP_Id ,0)
and
  nvl(HoraAula.AulaTi_Id,0) = nvl( p_AulaTi_Id ,0)
and
 (
   nvl(HoraAula.DivTurma_Id,0) = nvl( p_DivTurma_Id ,0)
    or
   p_DivTurma_Id is null
 )
and
  LPre.HoraAula_Id = HoraAula.Id
and
  HoraAula.TOXCD_Id = nvl( p_TOXCD_Id ,0)
group by 
  LPre.WPessoa_Prof1_Id,LPre.WPessoa_Prof2_Id,LPre.WPessoa_Prof3_Id,LPre.WPessoa_Prof4_Id