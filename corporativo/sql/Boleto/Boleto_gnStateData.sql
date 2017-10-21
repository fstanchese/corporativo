create or replace function usjt.Boleto_gnStateData
(
p_Boleto_Id                    in number  default(null),
p_O_Data                       in date  default(null),
p_Boleto_Considerar            in varchar2  default(null)
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
  upper(col) = 'STATE_BASE_ID'
and
  to_date(boletohi.dt) >= to_date( p_O_Data )
and
  boletohi.Boleto_id = p_Boleto_Id
order by boletohi.dt;

BoletoHi_qBoleto_Id cBoletoHi_qBoleto_Id%rowtype;


------------------------------------------------

cursor cRecebimento_qBoleto_Id
(
p_Boleto_id						in number
)  is
select 
  to_Date(recebimento.dt)					as dtbaixa,
  to_Date(recebimento.dtpagto)				as dtpagto,
  nvl(recebimento.baixamti_id,0) 			as baixam,
  nvl(recebimento.parcel_origem_id,0) 		as parcel,
  nvl(recebimento.cnab_origem_id,0)			as banco,
  nvl(recebimento.postobanc_origem_id,0) 	as posto,
  nvl(recebimento.boleto_origem_id,0) 		as BoletoOrigem
from 
  recebimento
where
  recebimento.boleto_id= p_Boleto_Id;
  
Recebimento_qBoleto_Id cRecebimento_qBoleto_Id%rowtype;
  

------------------------------------------------

v_d_data                       date;
v_n15_State                    number(15);
v_n15_ret                      number(15);
v_n01_achou                    number(01);

--------------------------------------------
begin
  
  v_d_data := to_date ( p_O_Data );
  if ( p_O_Data is null ) then
    v_d_data := to_date (sysdate);
  end if;
  
  open cBoleto_qIdPadrao(p_Boleto_Id); fetch cBoleto_qIdPadrao into Boleto_qIdPadrao; close cBoleto_qIdPadrao;
  if ( to_date(Boleto_qIdPadrao.dt) > v_d_data ) then
    v_n15_State := 3000000000001;
    v_n15_ret := 3000000000001;
  else  
    v_n15_State := Boleto_qIdPadrao.State_Base_Id;
    v_n15_ret := Boleto_qIdPadrao.State_Base_Id;
  end if;

  v_n01_achou := 0;
  
  for BoletoHi_qBoleto_Id in cBoletoHi_qBoleto_Id( p_Boleto_Id, v_d_data )  
  loop	
    if ( v_d_data = BoletoHi_qBoleto_Id.data ) then
      v_n15_State := BoletoHi_qBoleto_Id.new;
      v_n15_ret := BoletoHi_qBoleto_Id.new;
      v_n01_Achou := 1;
	else
	  if ( v_n01_Achou = 0 ) then
        v_n15_State := BoletoHi_qBoleto_Id.old;
        v_n15_ret := BoletoHi_qBoleto_Id.old;
        v_n01_Achou := 1;
      end if;		
    end if;
  end loop;
  
  if ( v_n15_State = 3000000000003 or v_n15_State = 3000000000007 ) then
    if ( Upper ( p_Boleto_Considerar ) = 'CONSIDERAR_ABERTO' ) then
      v_n15_State := 3000000000006;
    end if;
    if ( Upper ( p_Boleto_Considerar ) = 'CONSIDERAR_QUITADO' ) then
      v_n15_ret := 3000000000004;
    end if;
  else
    open cRecebimento_qBoleto_Id(p_Boleto_Id); fetch cRecebimento_qBoleto_Id into Recebimento_qBoleto_Id; close cRecebimento_qBoleto_Id;  
    if ( ( Recebimento_qBoleto_Id.banco is not null or Recebimento_qBoleto_Id.parcel is not null or Recebimento_qBoleto_Id.posto is not null ) and Recebimento_qBoleto_Id.dtpagto > v_d_data ) then
	    v_n15_State := 3000000000006;
    else
	  if ( ( Recebimento_qBoleto_Id.baixam is not null or Recebimento_qBoleto_Id.BoletoOrigem is not null ) and Recebimento_qBoleto_Id.dtbaixa > v_d_data ) then
	    v_n15_State := 3000000000006;	  
	  end if;
	end if;  
  end if;
  
  if ( v_n15_State = 3000000000006 ) then
    if ( Feriado_gnDiaUtil(Boleto_qIdPadrao.DtVencto) >= v_d_data ) then
      v_n15_ret := 3000000000005;
    else
      v_n15_ret := 3000000000002;
    end if;
  end if;
  return v_n15_ret;
--
--
end;
--



create public synonym boleto_gnstatedata for usjt.boleto_gnstatedata