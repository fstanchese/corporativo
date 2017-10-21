SELECT
  Durac.*
FROM
  Durac
WHERE
  Durac.Ciclo_Id = nvl( p_Ciclo_Id ,0)
ORDER BY 
  Nome
