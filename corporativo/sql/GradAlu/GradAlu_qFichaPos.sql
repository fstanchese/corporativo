select
  toxcd.dtinicio                    as Inicio,
  toxcd.dttermino                   as Termino,
  currxdisc_gsretdisc(currxdisc.id) as Disciplina,
  currxdisc.id                      as CurrXDisc_Id,
  gradalu.id                        as GradAlu_Id
from
  toxcd,
  ( select * from gradalu where gradalu.wpessoa_id = nvl ( p_WPessoa_Id , 0 ) ) GRADALU,
  ( select * from currxdisc where curr_id = nvl ( p_Curr_Id , 0 ) ) CURRXDISC
where
  currxdisc.id = gradalu.currxdisc_id 
and
  toxcd.turmaofe_id = gradalu.turmaofe_id
and
  toxcd.currxdisc_id = gradalu.currxdisc_id
and
  gradalu.state_id <> 3000000003002
group by currxdisc.id,gradalu.id,toxcd.dtinicio,toxcd.dttermino
order by 1,2 desc

