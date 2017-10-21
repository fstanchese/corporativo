SELECT
  Carimbo.*,
  WPessoa_gsRecognize(Carimbo.WPessoa_Id) AS WPessoa_Recognize
FROM
  Carimbo
WHERE
  Carimbo.id = nvl ( p_Carimbo_Id , 0 ) 