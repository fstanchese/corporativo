select 
  wpessoa_gsrecognize(wpessoa.id)         as Professor,
  Class_gsRecognize(wpessoa.class_id)     as ProfClass,
  RegTrab_gsRecognize(wpessoa.regtrab_id) as Regime,
  wpessoa.id                              as WPessoa_Id
from 
  wpessoa,
  admissao
where 
  (  
  Admissao.Demissao > p_O_Data  
  or   
  Admissao.Demissao is null  
  )  
and  
  Admissao.WPessoa_Id (+) = WPessoa.Id  
and
  wpessoa.docente='on'
order by wpessoa.nome

