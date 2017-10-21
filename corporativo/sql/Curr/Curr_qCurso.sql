select   
  CURR.*,  
  lpad(' ',(Level*3)-3)||CURR_gsRecognize(Curr.Id) as Recognize,
  Curr_gsRecognize(CURR.Curr_Pai_Id) as PaiRecognize, 
  Durac_gsRecognize(CURR.Durac_Id)  as Durac_Recognize, 
  PLetivo_gsRecognize(CURR.pletivo_inicial_id) as Ano_Inicio, 
  Titulo_gsRecognize(CURR.Titulo_Id) as Titulo, 
  nvl(PLetivo_gsRecognize(CURR.PLetivo_Final_Id),' - ') as Ano_Final, 
  replace(lpad(' ',(level*3)-3),' ','&nbsp')||Curr_gsRecognize(CURR.Id) as Recognize_Show 
from   
 ( select curr.* from curr where Curso_Id = nvl( p_Curso_Id ,0) order by pletivo_inicial_id desc ) CURR
WHERE
 curr.codigo like '%2014'   
Start with CURR.Id in ( select Curr.Id from Curr where Curr.Curr_Pai_Id is null ) connect by  CURR.Curr_Pai_Id = PRIOR CURR.Id
