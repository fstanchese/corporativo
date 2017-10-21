select
  numero
from
  saasenha 
where
  chamar is null 
order by  
  decode(prioridade,'on',1,'',2),SAASenha.DT,SAASenha.numero
for update of chamar
