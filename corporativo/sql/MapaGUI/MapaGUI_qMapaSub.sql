select
	MapaGUI.*
from
	MapaGUI,
	IndexGUI
where
	IndexGUI.Id = MapaGUI.IndexGUI_Id
and
	MapaGUI.MapaSub_Id = p_MapaSub_Id
order by
	IndexGUI.GUIDescription