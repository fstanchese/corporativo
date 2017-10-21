Select 
  MatricHi.Dt,
  To_Char(MatricHi.Dt, 'mm')       as Mes,
  To_Char(MatricHi.Dt, 'yyyy')     as Ano,
  to_char(MatricHi.Dt, 'dd')       as Dia,
  to_char(MatricHi.Dt, 'yyyymmdd') as DtCompara
from 
  MatricHi 
where 
  Matric_Id = p_Matric_Id
and 
  upper(col)='STATE_ID' 
and 
  to_number(new) = p_State_Id
order by MatricHi.Dt $v_desc