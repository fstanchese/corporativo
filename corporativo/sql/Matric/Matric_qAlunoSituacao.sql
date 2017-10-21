select
  MATRIC.*
from
  (
     select
       Matric.State_Id                           as State_Id,
       TurmaOfe_gnRetPLetivo(Matric.TurmaOfe_Id) as PLetivo_Id,
       TurmaOfe_gnRetDiscEsp(Matric.TurmaOfe_Id) as DiscEsp_Id,
       MatricTi_Id                               as MatricTi_Id
     from
       Matric
     where
       ( 
         Matric.State_Id > 3000000002001 
         and 
         Matric.State_Id != 3000000002013 
       )
     and
       Matric.WPessoa_Id = nvl( p_WPessoa_Id ,0 )
  ) MATRIC,
  DiscEsp
where
  DiscEsp.Id (+)= MATRIC.DiscEsp_Id
and
  (  
   ( DiscEspTi_Id Is null and MatricTi_Id <> 8300000000002 )
   or
   ( DiscEsp.DiscEspTi_Id is not null and DiscEsp.DiscEspTi_Id = 17800000000003 )
  )
order by Matric.PLetivo_Id Desc,Matric.MatricTi_Id

