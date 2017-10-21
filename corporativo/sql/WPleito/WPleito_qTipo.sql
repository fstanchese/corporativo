SELECT
	id, 
	nome as recognize
FROM 
	wpleito
WHERE 
	VestTi_Id = p_VestTi_Id
ORDER by
	id desc 