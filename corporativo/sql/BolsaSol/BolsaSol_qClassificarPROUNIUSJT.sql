select
  CurrOfe.Id,
  WPessoa_Id,
  WPessoa_gnIdade(WPessoa_Id,sysdate) as Idade,
  enemobj,
  enemred
from
  BolsaSol,
  CurrOfe,
  Curr
where
  CurrOfe.Curr_Id = Curr.Id
and
  BolsaSol.CurrOfe_Id = CurrOfe.Id
and
  State_Id = p_State_Id
and
  CESJProcSel_Id = p_CESJProcSel_Id
order by 
  CurrOfe.Campus_Id desc,CurrOfe.Id desc, EnemObj desc,EnemRed desc,WPessoa_gnIdade(WPessoa_Id,sysdate) desc
