select
  FaltaAbono.*,
  FaltaAbono_gsRecognize(Id) as Recognize 
from
  FaltaAbono
where
  WPessoa_Id = nvl( p_FaltaAbono_WPessoa_Id ,0)
order by
  DtInicio,DtFinal, Recognize