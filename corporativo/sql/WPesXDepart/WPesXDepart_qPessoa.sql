SELECT 
  WPesXDepart.Depart_Id as Depart_Id, 
  Depart.Nome           as Depart 
FROM
  WPesXDepart,
  WPessoa, 
  Depart 
WHERE
  WPesXDepart.DtTermino is null
AND 
  WPessoa.Id = WPesXDepart.WPessoa_Id 
AND
  UPPER(wpessoa.usuario) = UPPER( p_WPessoa_Usuario ) 
AND
  Depart.Id = WPesXDepart.Depart_Id