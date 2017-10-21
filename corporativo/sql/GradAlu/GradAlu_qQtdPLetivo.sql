select
  count(*) as qtd,
  to_char(gradaluhi.dt,'YYYY') as ano,
  curr.mneumonico as grupo
from
  gradalu,
  currxdisc,
  curr,
  matric,
  gradaluhi
where
  currxdisc.curr_id=curr.id
and
  gradalu.currxdisc_id=currxdisc.id
and
  gradalu.matric_id = matric.id
and
  trim(nvl(gradaluhi.old,'S/N')) = 'S/N'
and
  UPPER(trim(gradaluhi.col)) in ('N1','N2','N3','N4','N5','N6')
and
  gradalu.id = gradaluhi.gradalu_id
and
  gradalu.wpessoa_id = nvl ( p_WPessoa_Id , 0 )
group by to_char(gradaluhi.dt,'YYYY'),curr.mneumonico
order by 2