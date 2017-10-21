SELECT
  Id,
  Nome,
  NrCiclos,
  Ciclo_Id,
  Durac_gsRecognize(Id) AS recognize
FROM
  Durac
ORDER BY
  Nome