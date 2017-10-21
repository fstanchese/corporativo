select
  HoraAula.WPessoa_Prof1_Id,
  HoraAula.WPessoa_Prof2_Id,
  HoraAula.WPessoa_Prof3_Id,
  HoraAula.WPessoa_Prof4_Id,
  HoraAula.AulaTi_Id,
  HoraAula.DivTurma_Id
from
  HoraAula
where
  p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
and
  HoraAula.TOXCD_Id = nvl( p_TOXCD_Id ,0)
group by HoraAula.AulaTi_Id,HoraAula.DivTurma_Id,HoraAula.WPessoa_Prof1_Id,HoraAula.WPessoa_Prof2_Id,HoraAula.WPessoa_Prof3_Id,HoraAula.WPessoa_Prof4_Id
order by 5,6