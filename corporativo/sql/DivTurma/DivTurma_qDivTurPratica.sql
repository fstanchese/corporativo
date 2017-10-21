select
  DivTurma.Id,
  DivTurma_gsRecognize(Id)||' - '||GradAlu_gnRetQtdeDiv(  p_TOXCD_Id , DivTurma.Id ) as Recognize 
from
  DivTurma
where
  DivTurma.Numero < = (select DivPratica from TOXCD where Id = nvl( p_TOXCD_Id ,0) )
order by 2
