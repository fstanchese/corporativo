select 
 	SisMenu.Id,
 	SisMenu.Nome,
 	IndexGui.GUIName,
 	IndexGui.ProcName 
from
	SisMenu,
	IndexGui 
where 
	SisMenu.IndexGui_Id = IndexGui.Id (+) 
and 
	SisMenu_Pai_Id is null 
and 
	SisMenu.Raiz = 'off' 
and 
	SisMenu.WPessoa_Id = p_WPessoa_Id 
order by
	SisMenu.Nome, IndexGui.ProcName
