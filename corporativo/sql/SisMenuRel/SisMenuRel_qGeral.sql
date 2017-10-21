select
  SisMenuRel.*,
  IndexGui_gsRecognize(SisMenuRel.IndexGUI_Id)      as IndexGUI_Rec,
  IndexGui_gsRecognize(SisMenuRel.IndexGUI_Link_Id) as IndexGUIRel_Rec
FROM
  SisMenuRel
  order by IndexGui_Rec
  