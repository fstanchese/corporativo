SELECT
  Depart.*, 
  lpad('_______________',(Level*3)-3)||Depart_gsRecognize(Id) AS RECOGNIZE
FROM 
  ( 
    SELECT 
      Depart.*, 
      Depart_gsRecognize(Id)||'0'            AS RECOGNIZE_FILHO, 
      Depart_gsRecognize(Depart_Pai_Id)||'0' AS RECOGNIZE_PAI 
    FROM 
      Depart 
    ORDER BY 
      RECOGNIZE_PAI,RECOGNIZE_FILHO 
  ) Depart 
start WITH RECOGNIZE_PAI = '0' 
connect BY 
  RECOGNIZE_PAI = PRIOR RECOGNIZE_FILHO 