SELECT
	CAMesa_gsRecognize(CAMesa_Id) as mesa,
	CAAssunto_gsRecognize(CAAssunto_Id) as assunto,
caassxcamesa.*
	
FROM
caassxcamesa

ORDER BY mesa, assunto