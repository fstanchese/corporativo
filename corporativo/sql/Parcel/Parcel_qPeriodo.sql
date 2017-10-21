select
  To_Char(Parcel.Dt, 'dd/mm/yyyy')       as Data_Format,
  Parcel.Id                              as Parcel_Id,
  Parcel.Wpessoa_Id                      as WPessoa_Id,
  WPessoa_gsRecognize(Parcel.Wpessoa_Id) as Pessoa_Recognize,
  WPessoa_gnCodigo(Parcel.Wpessoa_Id)    as Pessoa_Codigo,
  State_gsRecognize(Parcel.State_Id)     as State_Recognize
from
  parcel
where
  trunc(parcel.dt) between nvl( p_O_Data1 , sysdate ) and nvl ( p_O_Data2 , sysdate )
