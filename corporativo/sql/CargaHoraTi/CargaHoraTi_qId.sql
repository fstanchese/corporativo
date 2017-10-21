SELECT
  CargaHoraTi.*,
  CargaHoraTi.Nome as Recognize 
FROM
  CargaHoraTi
WHERE
  CargaHoraTi.Id = nvl( p_CargaHoraTi_Id ,0)