select
  RecCurso.*,
  Campus_gsRecognize(Campus_Id)||decode(Habilitacao,null,'',' - Habilitação em '||Habilitacao)||decode(modalidade_id,null,'',' - '||Modalidade_gsRecognize(Modalidade_Id))||' - '||RecCurso.Reconhecimento as Recognize,
  RecCurso.NomeDiplAnverso||' - '||Campus_gsRecognize(Campus_Id)||' - '||decode(modalidade_id,null,'',' - '||Modalidade_gsRecognize(Modalidade_Id))||' - '||RecCurso.Reconhecimento as Extra,
  Campus_gsRecognize(Campus_Id)||decode(Habilitacao,null,'',' - Habilitação em '||Habilitacao)||decode(modalidade_id,null,'',' - '||Modalidade_gsRecognize(Modalidade_Id))||' - '||RecCurso.Reconhecimento as NomeCompleto
from
  RecCurso
where
  RecCurso.Curso_Id = nvl ( p_Curso_Id , 0 )
order by Habilitacao,dtDOU desc,campus_id,modalidade_id
