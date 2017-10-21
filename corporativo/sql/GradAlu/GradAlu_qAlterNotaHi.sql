select
  to_char(dt,'dd/mm/yyyy hh24:mi:ss') || ' - ' || GradAluHi.us || ' - ' || GradAluHi.old || ' -> ' || GradAluHi.new || decode(GradAluMot_Id,null,'',' - '|| GradAluMot_gsRecognize(GradAluMot_Id)) as Recognize,
  GradAluHi.dt  as Data,
  to_char(dt,'dd/mm/yyyy hh24:mi:ss') as DTFORMATADO,
  GradAluHi.us  as Usuario,
  GradAluHi.old as Anterior,
  GradAluHi.new as Atual
from
  GradAluHi
where
  Upper(GradAluHi.col) = '$v_s003_Prova'
and
  GradAluHi.Old is not null
and
  GradAluHi.GradAlu_Id = nvl( p_GradAlu_Id ,0)
order by GradAluHi.dt