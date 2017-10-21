select
  to_char(HoraProva.Data,'dd/mm/yyyy')||' - '||To_Char(HoraProva.Data,'hh24:mi')||' - '||Sala_gsRecognize(HoraProva.Sala_id)||' - '||HoraProva.duracao||' min '||decode(HoraProva.WPessoa_Id,null,'',' - '||WPessoa_gsRecognize(HoraProva.WPessoa_Id))||' - '||HoraProva_gsQtdAluEsp(HoraProva.Id)||' - '||Campus_gsRecognize(HoraProva.Campus_Id) as Recognize,
  to_char(HoraProva.Data,'dd/mm/yyyy')  as Data,
  to_char(HoraProva.Data,'day')         as Dia,
  to_char(HoraProva.Data,'hh24:mi')     as Hora,
  Sala_gsRecognize(HoraProva.Sala_Id)   as Sala,
  Decode(to_char(Duracao),null,to_char(Duracao),to_char(Duracao) || ' min') as Duracao,
  WPessoa_gsRecognize(WPessoa_Id)       as Professor,
  HoraProva.Id       as Id,
  HoraProva.Sala_Id  as Sala_Id,
  Facul_gsRecognize(HoraProva.Facul_Id) as Facul,
  HoraProva.Facul_Id as Facul_Id,
  PLetivo_gsRecognize(CriAvalPDt.PLetivo_Id)      as AnoLetivo,
  CriAvalPDt_gsRecognize(HoraProva.CriAvalPDt_Id) as CriAvalPDt
from
  HoraProva,
  CriAvalPDt
where
  CriAvalPDt.Id = HoraProva.CriAvalPDt_Id
and
  ( 
    p_Campus_Id is null
    or
    HoraProva.Campus_Id = nvl ( p_Campus_Id ,0)
  )
and
  HoraProva.Facul_Id = nvl( p_Facul_Id ,0) 
and
  HoraProva.CriAvalPDt_Id = nvl( p_CriAvalPDt_Id ,0)
order by 
  HoraProva.Data