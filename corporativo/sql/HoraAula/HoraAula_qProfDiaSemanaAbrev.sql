select
  Semana.Nome,
  Semana.Numero 
from
  HoraAula,
  Horario,
  Semana 
where
  (
    HoraAula.TOXCD_Id = nvl( p_TOXCD_Id ,0)
  or
    p_TOXCD_Id is null
  )
and
  Horario.Semana_Id = Semana.Id 
and
  HoraAula.Horario_Id = Horario.Id 
and
  nvl ( HoraAula.AulaTi_Id , 13300000000001 ) = p_AulaTi_Id
and
  ( ( p_O_Data between horaaula.dtinicio and horaaula.dttermino ) or ( p_O_Data is null ) )
and
  ( HoraAula.DivTurma_Id = p_DivTurma_Id or p_DivTurma_Id is null )
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
group by 
  Semana.Nome,Semana.Numero 
order by 
  Semana.Numero