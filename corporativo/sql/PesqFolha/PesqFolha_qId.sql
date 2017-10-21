select
  PesqFolha.*,
  trim(SubStr(PesqFolha_gsAcertaResp(SubStr(PesqFolha.Conteudo,29,1)),1,3)) as Resp29 
from
  PesqFolha
where
  PesqFolha.Id = nvl ( p_PesqFolha_Id , 0 )