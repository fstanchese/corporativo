select
  TOXCD_gsRetCodDisc(TOXCD_Id)||' - '||to_char(Data,'dd/mm/yyyy')||' - '||To_Char(Data,'hh24:mi')||' - '||Sala_gsRecognize(Sala_Id)||' - '||DivTurma_gsRecognize(DivTurma_Id)||' - '||duracao||' min '||decode(WPessoa_Id,null,'',' - '||WPessoa_gsRecognize(WPessoa_Id)) as Recognize,
  to_char(HoraProva.Data,'dd/mm/yyyy') as DATA,
  to_char(HoraProva.Data,'day')        as DIA,
  TOXCD_gsRetCodDisc(TOXCD.Id)         as DISCIPLINA,
  to_char(HoraProva.Data,'hh24:mi')    as HORA,
  Sala_gsRecognize(HoraProva.Sala_Id)  as SALA,
  Decode(to_char(Duracao),null,to_char(Duracao),to_char(Duracao) || ' min') as DURACAO,
  WPessoa_gsRecognize(WPessoa_Id)      as PROFESSOR,
  HoraProva.Id as ID
from
  HoraProva,
  TOXCD
where
  HoraProva.TOXCD_Id = TOXCD.Id
and
  HoraProva.Facul_Id = nvl( p_Facul_Id ,0)
and
  HoraProva.CriAvalPDt_Id = nvl( p_CriAvalPDt_Id ,0)
order by
  HoraProva.Data