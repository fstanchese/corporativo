

select 
  Consulta.* 
from 
(
  select
    Sub.*, rownum rnum 
  from
    (
      select
        rownum as numero,
        id,
        nvl(Num,WOcorr_gnNumOcorrencia(ID)) as num,
        solicitacao,
        state_gsRecognize(state_id) as SITUACAO,
        wocorrass_gsRecognize(wocorrass_id) as ASSUNTO,
        to_char(solicitacao,'dd/mm/yyyy') as SOLICITACAO_Format,
        WOcorr_gsRecognize(id) as Recognize 
      from
        wocorr 
      where
        wpessoa_id = nvl( p_WPessoa_Id ,0) 
      order by 
        to_char(solicitacao,'yyyymmdd') desc, rowid 
    ) Sub 
) Consulta
where
  rnum between p_NumeroI and p_NumeroT 
order by
  rnum
