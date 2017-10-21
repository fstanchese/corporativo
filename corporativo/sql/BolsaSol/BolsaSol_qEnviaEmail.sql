select 
  email1  
from
  bolsasol,
  wpessoa
where 
  WPessoa.Email1 is not null
and
  WPessoa.Id = BolsaSol.WPessoa_Id
and
  bolsasol.id not in (select bolsasol_id from bolsasolxbsa)
and
  State_Id = 3000000012006
and
  cesjprocsel_id = 120700000000050 

