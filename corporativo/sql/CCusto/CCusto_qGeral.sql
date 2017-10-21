SELECT
  CCusto.*,
  lpad('_______________',(Level*3)-3)||CCusto_gsRecognize(id) AS RECOGNIZE
FROM
  ( 
    SELECT 
      CCusto.*, 
      substr('0000000000'||trim(CCusto.Codigo),-10)     AS Codigo_Filho,
      substr('0000000000'||trim(CCusto_Pai.Codigo),-10) AS Codigo_Pai
    FROM 
      CCusto,
      ( SELECT Id,Codigo FROM CCusto ) CCusto_Pai
    WHERE
      CCusto.CCusto_Pai_Id = CCusto_Pai.Id (+)
    ORder by
      Codigo_Pai,Codigo_Filho
  ) CCusto
start with Codigo_Pai = '0000000000'
connect by 
  Codigo_Pai = PRIOR Codigo_Filho