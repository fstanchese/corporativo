select 
  Turmaofe_gsRetPLetivo( TurmaOfe_Id ) as PLetivo,
  case Matric.State_Id
    when 3000000002002 then 'M'
    when 3000000002003 then 'R'
    when 3000000002004 then 'D'
    when 3000000002005 then 'T'
    when 3000000002006 then 'TR'
    when 3000000002007 then 'X'
    when 3000000002008 then 'X'
    when 3000000002009 then 'X'
    when 3000000002010 then 'A'
    when 3000000002011 then 'R'
    when 3000000002012 then 'C'
  end			        as State,
  decode(Matric.MatricTi_Id,8300000000001,'A','X') as TipoMatric
from
  Matric
where
  nvl(TurmaOfe_gnRetCursoNivel( TurmaOfe_Id ),0) in ( 6200000000001,6200000000010,6200000000003,0 )
and
  Matric.MatricTi_Id in ( 8300000000001,8300000000002 )
and
  ( (Matric.State_Id > 3000000002001 and Matric.State_Id < 3000000002013) and Matric.State_Id not in (3000000002007,3000000002008,3000000002009) )
and
  Matric.WPessoa_Id = nvl ( p_WPessoa_Id ,0 )
order by PLetivo Desc,TipoMatric
