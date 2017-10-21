select
  AlocXHor.Id as Id,
  AlocXHor_gsRecognize(AlocXHor.Id) as Recognize,
  Decode(AlocXHor.Indice,1,Professor_gsRecognize(AlocaProf.Professor_01_Id),2,Professor_gsRecognize(AlocaProf.Professor_02_Id),3,Professor_gsRecognize(AlocaProf.Professor_03_Id),4,Professor_gsRecognize(AlocaProf.Professor_04_Id),5,Professor_gsRecognize(AlocaProf.Professor_05_Id),6,Professor_gsRecognize(AlocaProf.Professor_06_Id)) as Professor
from
  AlocXHor,
  AlocaProf
where
  AlocXHor.AlocaProf_Id = AlocaProf.Id
and
  AlocXHor.AlocaProf_Id = nvl ( p_AlocXHor_AlocaProf_Junto_Id , 0 )
and
  AlocXHor.Indice = nvl ( p_O_Numero , 0 )
order by 2