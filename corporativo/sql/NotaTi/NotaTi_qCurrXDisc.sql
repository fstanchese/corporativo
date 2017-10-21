SELECT
	NotaTi.Id,
	NotaTi.Nome as Recognize 
FROM
	NotaTi
WHERE 
	NotaTi.Id = 12300000000001
  	or
	NotaTi.Id = 12300000000004
ORDER BY
	Recognize
