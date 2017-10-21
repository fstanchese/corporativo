select
  TOXCD_gsRetDisciplina(toxcd_id)||' - '||to_char(Data,'dd/mm/yyyy')||' - '||To_Char(Data,'hh24:mi')||' - '||Sala_gsRecognize(sala_id)||' - '||DivTurma_gsRecognize(divturma_id)||' - '||duracao||' min '||decode(wpessoa_id,null,'',' - '||wpessoa_gsrecognize(wpessoa_id)) as Recognize,
  to_char(HoraProva.Data,'dd/mm/yyyy') as DATA,
  to_char(HoraProva.Data,'day') as DIA,
  TOXCD_gsRetCodDisc(toxcd.id) as DISCIPLINA, 
  to_char(HoraProva.Data,'hh24:mi') as HORA,
  Sala_gsRecognize(HoraProva.Sala_Id) as SALA,
  DivTurma_gsRecognize(HoraProva.DivTurma_Id) as DIVTURMA,
  Decode(to_char(Duracao),null,to_char(Duracao),to_char(Duracao) || ' min') as DURACAO,
  WPessoa_gsRecognize(WPessoa_Id) as PROFESSOR,
  horaprova.id as ID
from
  HoraProva,
  TOXCD
where  
  HoraProva.TOXCD_Id = TOXCD.Id
and
  TOXCD.TurmaOfe_Id = nvl( p_TurmaOfe_Id ,0)
and
  HoraProva.CriAvalPDt_Id = nvl( p_CriAvalPDt_Id ,0)
order by 
  HoraProva.Data,1

