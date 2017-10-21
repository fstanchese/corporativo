select
  matric.id                                                        as id,
  wpessoa.codigo                                                   as codigo,
  nvl(matric.data,trunc(sysdate))                                  as datax,
  PLetivo.Id                                                       as PLetivo_Id,
  Matric.MatricTi_Id                                               as MatricTi_Id,
  Matric.DtState                                                   as DtState,
  matric.data                                                      as data_matricula,
  Pletivo.Nome||' - '||DiscEspTi_gsRecognize(DiscEsp.DiscEspTi_id) as recognize
FROM  
  matric,
  turmaofe,
  wpessoa,
  discesp,
  PLetivo
where
  not exists (
             select 
               matric.id
             from
               matric,
               currofe,
               turmaofe
             where
               Matric.State_Id >= 3000000002002
             and
               MATRIC.MATRICTI_ID = 8300000000001
             and
               MATRIC.TURMAOFE_ID=TURMAOFE.ID
             and
               TURMAOFE.CURROFE_ID=CURROFE.ID
             and
               Matric.WPessoa_Id = WPessoa.Id
             and
               CURROFE.PLETIVO_ID = discesp.Pletivo_Id              
           )
and
  PLetivo.Id = DiscEsp.PLetivo_Id
and
  discesp.discespti_id = 17800000000003
and
  wpessoa.id = matric.wpessoa_id
and
  discesp.id = turmaofe.discesp_id
and
  turmaofe.id = matric.turmaofe_id
and
  Matric.State_Id >= 3000000002002
and
  Matric.WPessoa_Id = nvl ( p_WPessoa_Id , 0 )
order by recognize desc 

