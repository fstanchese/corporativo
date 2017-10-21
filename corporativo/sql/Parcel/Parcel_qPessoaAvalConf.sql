select
  distinct(id) as Id,
  WPessoa_Id,
  to_char(Id  - 104400000000000,'0000000') as Num_Parcel
from
  Parcel
where
  Parcel.WPessoa_Id = p_WPessoa_Id
or
  Parcel.WPessoa_Confessor_Id = p_WPessoa_Id
or
  Parcel.WPessoa_Avalista_Id = p_WPessoa_Id
order by
  Id
