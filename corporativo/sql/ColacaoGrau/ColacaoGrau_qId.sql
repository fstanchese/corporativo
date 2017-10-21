select
  ColacaoGrau.*,
  ColacaoGrau_gsRecognize(ColacaoGrau.Id) as Recognize,
  WPessoa_gsRecognize(WPessoa_Pres_Id) as Presidente
from
  ColacaoGrau  
where
  ColacaoGrau.Id = nvl( p_ColacaoGrau_Id , 0 )

