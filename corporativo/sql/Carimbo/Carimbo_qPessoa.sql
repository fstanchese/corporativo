SELECT
  Carimbo.*,
  Carimbo_gsRecognize(Id) AS Recognize  
FROM
  Carimbo
WHERE
  WPessoa_Id = nvl( p_WPessoa_Id ,0)
