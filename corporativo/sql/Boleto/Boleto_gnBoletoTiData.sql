create or replace function usjt.Boleto_gnBoletoTiData
(
p_Boleto_Id                    in number  default(null),
p_O_Data                       in date  default(null),
p_BoletoTi_Id                  in number  default(null)
) return number is


---------------------------------------------
cursor cBoleto_qIdPadrao
(
p_Boleto_Id                    in number  
)  is
select
  Boleto.*
from
  Boleto
where
  Boleto.Id = nvl( p_Boleto_Id ,0);

Boleto_qIdPadrao cBoleto_qIdPadrao%rowtype;

----------------------------------------------

cursor cBoletoHi_qBoleto_Id
(
p_Boleto_Id						in number,
p_O_Data 						in date
) is

select
  Old								as Old,
  New								as New,
  to_Date(boletohi.dt)				as Data
from
  boletohi
where
  upper(col) = 'BOLETOTI_ID'
and
  to_date(boletohi.dt) >= to_date( p_O_Data )
and
  boletohi.Boleto_id = p_Boleto_Id
order by boletohi.dt;

BoletoHi_qBoleto_Id cBoletoHi_qBoleto_Id%rowtype;


------------------------------------------------

v_d_data                       date;
v_n15_ret                      number(15);
v_n01_achou                    number(01);

--------------------------------------------
begin
  
  v_d_data := to_date ( p_O_Data );
  if ( p_O_Data is null ) then
    v_d_data := to_date (sysdate);
  end if;
  
  v_n15_ret := p_BoletoTi_Id;

  if ( v_n15_ret is null ) then
    open cBoleto_qIdPadrao(p_Boleto_Id); fetch cBoleto_qIdPadrao into Boleto_qIdPadrao; close cBoleto_qIdPadrao;
    v_n15_ret := Boleto_qIdPadrao.BoletoTi_Id;
  end if;

  v_n01_achou := 0;
  
  for BoletoHi_qBoleto_Id in cBoletoHi_qBoleto_Id( p_Boleto_Id, v_d_data )  
  loop	
    if ( v_d_data = BoletoHi_qBoleto_Id.data ) then
      v_n15_ret := BoletoHi_qBoleto_Id.new;
      v_n01_Achou := 1;
	else
	  if ( v_n01_Achou = 0 ) then
        v_n15_ret := BoletoHi_qBoleto_Id.old;
        v_n01_Achou := 1;
      end if;		
    end if;
  end loop;
  
  if ( v_n15_ret = 92200000000012 ) then
    v_n15_ret := Boleto_gnBoletoTi( p_Boleto_Id , v_n15_ret ); 
  end if;
  
  return v_n15_ret;
--
--
end;
--



create public synonym boleto_gnboletotidata for usjt.boleto_gnboletotidata