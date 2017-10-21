select
  Curr.CODINEP
from
  horaaula,
  horario,
  toxcd,
  CurrXDisc,
  Curr
where
  CurrXDisc.Curr_Id = Curr.Id
and
  TOXCD.CurrXDisc_Id = CurrXDisc.Id
and
  horaaula.toxcd_id = toxcd.id
and
  horario.id = horaaula.horario_id
and
  p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
and
(
  WPessoa_Prof1_Id = nvl( p_WPessoa_Id ,0)
  or
  WPessoa_Prof2_Id = nvl( p_WPessoa_Id ,0)
  or
  WPessoa_Prof3_Id = nvl( p_WPessoa_Id ,0)
  or
  WPessoa_Prof4_Id = nvl( p_WPessoa_Id ,0)
)
group by Curr.CODINEP
