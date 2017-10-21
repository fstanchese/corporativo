create or replace trigger usjt.saldotrbd
before delete on saldo
for each row 
begin
  if ( :old.dtsaldo is not null ) then
      raise_application_error ( -20001, 'Saldo de fechamento n�o pode ser exclu�do.' );
  end if;
end;
/