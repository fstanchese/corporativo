select
  to_char(HoraProva.Data,'dd/mm/yyyy')||' - '||To_Char(HoraProva.Data,'hh24:mi')||' - '||Sala_gsRecognize(HoraProva.Sala_id)||' - '||HoraProva.duracao||' min '||decode(HoraProva.WPessoa_Id,null,'',' - '||WPessoa_gsRecognize(HoraProva.WPessoa_Id))||' - '||HoraProva_gsQtdAluEsp(HoraProva.Id) as Recognize,
  to_char(HoraProva.Data,'dd/mm/yyyy') as Data,
  to_char(HoraProva.Data,'day') as Dia,
  to_char(HoraProva.Data,'hh24:mi') as Hora,
  Sala_gsRecognize(HoraProva.Sala_Id) as Sala,
  Decode(to_char(Duracao),null,to_char(Duracao),to_char(Duracao) || ' min') as Duracao,
  WPessoa_gsRecognize(WPessoa_Id) as Professor,
  HoraProva.Id as Id,
  HoraProva.Sala_Id as Sala_Id  
from
  HoraProva  
where
  HoraProva.EspForaPrazo is null 
and
  nvl(HoraProva.Id,0) not in ( Select nvl(GradAlu.HoraProva_Esp_Id,0) from GradAlu where GradAlu.WPessoa_Id = nvl( p_WPessoa_Id ,0) )
and
  nvl(HoraProva.Id,0) not in ( Select HoraProva_Id from HPXDisc )
and
  HoraProva.Campus_Id = nvl ( p_Campus_Id ,0)
and
  HoraProva.Facul_Id = nvl( p_Facul_Id ,0)
and
  HoraProva.CriAvalPDt_Id = nvl( p_CriAvalPDt_Id ,0)
order by 
  HoraProva.Data