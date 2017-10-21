select
  turmaofe_gsretcodturma(toxcd.turmaofe_id)  as turma,
  currxdisc_gsretcoddisc(toxcd.currxdisc_id) as coddisc,
  divturma_gsrecognize(horaaula.divturma_id)         as divisao,
  toxcd.turmaofe_id,
  toxcd.currxdisc_id,
  horaaula.divturma_id,
  turmaofe_gsretcodturma(toxcd.turmaofe_id)||decode(toxcd.currxdisc_id,null,'',' - '||currxdisc_gsretcoddisc(toxcd.currxdisc_id))||decode(horaaula.divturma_id,null,'',' - '||divturma_gsrecognize(horaaula.divturma_id)) as recognize  
from
  toxcd,
  horaaula
where
  trunc(sysdate) between horaaula.dtinicio and horaaula.dttermino
and
  horaaula.toxcd_id=toxcd.id
and
  (
  horaaula.wpessoa_prof1_id = nvl ( p_WPessoa_Id , 0 )
  or
  horaaula.wpessoa_prof2_id = nvl ( p_WPessoa_Id , 0 )
  or
  horaaula.wpessoa_prof3_id = nvl ( p_WPessoa_Id , 0 )
  or
  horaaula.wpessoa_prof4_id = nvl ( p_WPessoa_Id , 0 )
  )
group by toxcd.turmaofe_id,toxcd.currxdisc_id,horaaula.divturma_id
order by 1,2,3
