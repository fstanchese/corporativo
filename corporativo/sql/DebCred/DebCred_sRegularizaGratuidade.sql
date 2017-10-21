create or replace procedure ( p_boleto_id in number default(null), p_Data  in date default(null)) is 

cursor cDebCred_ItensBolsa ( p_boleto_id in number,  p_Data in date)
is

select 
 	id,
 	valor,
 	bolsavalor,
	bolsavalor - valor as diferenca
from
	(
  	Select 
	  	debcred.Id as id, 
    	debcredbolsa.id as debcredbolsa_id, 
	    nvl(debcred.valor,  pagtop.valor) as valor,
    	debcredbolsa.bolsavalor as bolsavalor
  	from 
    	pagtop,
	    debcred,
    	(select
	  		debcred_credbolsa_id as id, 
    		Sum(debcred.valor) *-1 as bolsaValor
    	from
	  	 	debcred
    	where
      		debcred.valor < 0
	    and
  	 		debcred_gnretstatedata(debcred.id, p_Data, debcred.dt, debcred.state_id)=3000000016002
    	and
	  	 	boleto_destino_id = p_boleto_id
    	group by 
	    	debcred_credbolsa_id
    	) debcredbolsa
  	where
    	pagtop.id (+) = debcred.pagtop_id
  	and 
 		debcred_gnretstatedata(debcred.id, p_Data, debcred.dt, debcred.state_id)=3000000016002
  	and
		debcred.id = debcredBolsa.id
	)
where
	bolsavalor <> valor
	
DebCred_ItensBolsa cDebCred_ItensBolsa%rowtype;

---------------------------------------------------------

cursor cBolsa_Alterar ( p_DebCred_Id  in number )
is

select 
  id,
  valor,
from
  debcred
where
  state_id=3000000016002
and
  debcred.debcred_credbolsa_id = p_DebCred_Id;
  
Bolsa_Alterar cBolsa_Alterar%rowtype;


-----------------------------------------------------------

v_n12v2_ValorItem   number(12,2);
v_d_data            date;


v_d_data := to_date(p_O_Data);
if (v_d_data is null) then
  v_d_data := to_date(sysdate);
end if;


while cDebCred_ItensBolsa ( p_boleto_id, v_d_data ); fetch cDebCred_ItensBolsa into DebCred_ItensBolsa; close cDebCred_ItensBolsa;







 
