SELECT
  Modalidade.Id as Id,
  Modalidade.Nome as Recognize
FROM
  Modalidade
WHERE
  Modalidade.Id = nvl ( p_Modalidade_Id , 0 )