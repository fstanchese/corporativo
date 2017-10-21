select
  ColacaoGrau.*,
  ColacaoGrau_gsRecognize(ColacaoGrau.Id)||decode(localizacao,null,'',' - '||Localizacao)||' no dia '||DtColacao||' às '||Horario as Recognize
from
  ColacaoGrau
where
  (
    p_ColacaoGrauTi_Id is null
    or
    ColacaoGrauTi_Id = nvl ( p_ColacaoGrauTi_Id , 0 )  
  )   
and
  ColacaoGrau.Campus_Id = nvl ( p_Campus_Id , 0 )
and
  ColacaoGrau.PLetivo_Id = nvl( p_PLetivo_Id , 0 )  
order by DtColacao,Recognize
