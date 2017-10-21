SELECT
  Depart.*,
  WPessoa_gsRecognize(WPessoa_Id) AS WPessoa_Label
FROM
  Depart
WHERE
  Id = nvl( p_Depart_Id ,0)