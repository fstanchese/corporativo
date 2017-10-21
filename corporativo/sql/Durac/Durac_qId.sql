SELECT
  Id,
  Nome,
  NrCiclos,
  Ciclo_Id,
  Durac_gsRecognize(Id) AS recognize
FROM
  Durac
WHERE
  Id = nvl( p_Durac_Id ,0)