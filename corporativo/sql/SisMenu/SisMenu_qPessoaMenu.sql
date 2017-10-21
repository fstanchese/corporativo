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
	SisMenu_Pai_Id = p_SisMenu_Pai_Id 
and 
	SisMenu.WPessoa_Id = p_WPessoa_Id 
order by
	SisMenu.Nome, IndexGui.ProcName