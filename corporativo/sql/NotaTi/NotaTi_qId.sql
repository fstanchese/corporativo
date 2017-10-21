SELECT
	NotaTi.Id,
	NotaTi.Nome as Recognize 
FROM
	NotaTi
WHERE
	NotaTi.id = nvl ( p_NotaTi_Id , 0 )