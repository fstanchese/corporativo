select sum(QTDE) as TOTAL from (
(
select 
  sum(count(horario_id)) as QTDE
from 
  TOXCD,HoraAula,CurrXDisc 
where 
  p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino 
and
  HoraAula.DivTurma_id is null
and 
  CurrXDisc.Id = TOXCD.CurrXDisc_Id 
and 
  TOXCD.Id = HoraAula.TOXCD_Id 
and 
  TOXCD.TurmaOfe_Id = nvl( p_TurmaOfe_Id ,0)
group by Horario_Id,toxcd_id
)
union
(
select 
  sum(count(distinct horario_id)) as QTDE
from 
  TOXCD,HoraAula,CurrXDisc 
where 
  p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino 
and
  HoraAula.DivTurma_id is not null
and 
  CurrXDisc.Id = TOXCD.CurrXDisc_Id 
and 
  TOXCD.Id = HoraAula.TOXCD_Id 
and 
  TOXCD.TurmaOfe_Id = nvl( p_TurmaOfe_Id , 0)
group by Horario_Id
)
) 
